<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Eloquents\SubjectRepository;
use App\Repositories\Eloquents\CardRepository;
use App\Repositories\Eloquents\FolderRepository;
use App\Repositories\Eloquents\RecentlySubjectRepository;
use App\Models\Subject;
use App\Models\RecentlySubject;
use App\Models\Card;
use Carbon\Carbon;


class SubjectController extends Controller
{

    protected $folderRepository;
    protected $subjectRepository;
    protected $cardRepository;
    protected $recentSubRepository;

    public function __construct(
            FolderRepository $folderRepository,
            SubjectRepository $subjectRepository,
            CardRepository $cardRepository,
            RecentlySubjectRepository $recentSubRepository
        ) 
    {
        $this->folderRepository = $folderRepository;
        $this->subjectRepository = $subjectRepository;
        $this->cardRepository = $cardRepository;
        $this->recentSubRepository = $recentSubRepository;
    }

    public function index($id) {
        $user = Auth::user();

        $subject = $this->subjectRepository->getSubjectById($id);

        if($subject->user_id != $user->id && $subject->shared_status == false) {
            return redirect()->route('home')->with('alert', 'open'); 
        }

        $cards = $this->cardRepository->getCardBySubject($id);
        
        $expiryCards = $this->cardRepository->getExpiryCardBySubject($id);

        $recentSub['subject_id'] = $id;
        $recentSub['user_id'] = $user->id;
        $this->recentSubRepository->create($recentSub);

        return view('pages.subject', compact('user', 'subject', 'cards', 'expiryCards'));
    }

    public function createIndex() {
        return view('pages.subject.subject_creater');
    }

    public function create(Request $request) {

        $this->validate($request, 
            [
                'subject_title' => 'required',
                'card_fronts.*' => 'min:2',
                'card_backs.*' => 'min:2'
            ],
        );

        $subjectFol = $request->subject_folder;

        if ($subjectFol == null) 
        {
            $subjectFol = $this->folderRepository->getDefaultFolder(Auth::user()->id)->id;
        }
        
        $subject['user_id'] = Auth::user()->id;
        $subject['maker'] = Auth::user()->name;
        $subject['folder_id'] = $subjectFol;
        $subject['name'] = $request->subject_title;
        $subject['shared_status'] = 0;
        $subject['description'] = $request->subject_des;

        $newSubject = $this->subjectRepository->create($subject);

        for($i = 0; $i < count($request->card_fronts); $i++)
        {
            $card['subject_id'] = $newSubject->id;
            $card['front'] = $request->card_fronts[$i];
            $card['back'] = $request->card_backs[$i];
            $card['num_of_study'] = 0;
            $card['level_of_card'] = 1;
            $card['expiry_date'] = Carbon::now();

            $this->cardRepository->create($card);
        }

        // dd($newSubject->shared_status);

        return redirect()->route('subject', ['id' => $newSubject->id])->with('popup', 'open'); 
    }

    public function delete(Request $request) {
        $this->cardRepository->deleteBySubject($request->subjectId);
        $this->subjectRepository->delete($request->subjectId);
        $test = $this->recentSubRepository->delete($request->subjectId);

        return redirect()->route("home");
    }

    // public function update(Request $request) {

    //     $test = $this->validate($request, 
    //         [
    //             'subject_title' => 'required',
    //         ],
    //     );

    //     $subject = new Subject();
    //     $subject->id = $request->subjectId;
    //     $subject->name = $request->subject_title;
    //     $subject->description = $request->subject_des;

    //     $this->subjectRepository->update($subject);

    //     return redirect()->back();
    // }

    public function updateIndex($id) {
        $subject = $this->subjectRepository->getSubjectById($id);

        return view('pages.subject.subject_update', compact('subject'));
    }

    public function update(Request $request, $id) {
        $this->validate($request, 
            [
                'subject_title' => 'required',
                'card_fronts.*' => 'min:2',
                'card_backs.*' => 'min:2'
            ],
        );        

        $subject = $this->subjectRepository->getSubjectById($id);
        $cards = $subject->cards;

        // dd($request);
        // dd(in_array(116, $request->card_id));

        for($i = 0; $i < count($request->card_fronts); $i++)
        {
            if (isset($request->card_id[$i])) {
                $cardEdited = $cards->find($request->card_id[$i]);

                if ($cardEdited->front != $request->card_fronts[$i] || $cardEdited->back != $request->card_backs[$i]) {
                    $cardUpdate = new Card();
                    $cardUpdate->id = $request->card_id[$i];
                    $cardUpdate->back = $request->card_backs[$i];
                    $cardUpdate->front = $request->card_fronts[$i];

                    $this->cardRepository->editCard($cardUpdate);
                }
            }
            else {
                $card['subject_id'] = $id;
                $card['front'] = $request->card_fronts[$i];
                $card['back'] = $request->card_backs[$i];
                $card['num_of_study'] = 0;
                $card['level_of_card'] = 1;
                $card['expiry_date'] = Carbon::now();
    
                $this->cardRepository->create($card);
            }
        }

        foreach($cards as $card) {
            if (!in_array($card->id,$request->card_id)) {
                $this->cardRepository->delete($cards[$i]->id);
            }
        }

        $subjectFol = $request->subject_folder;

        if ($subjectFol == null) 
        {
            $subjectFol = $this->folderRepository->getDefaultFolder(Auth::user()->id)->id;
        }
        
        $subjectUpdate = new Subject();
        $subjectUpdate->id = $id;
        $subjectUpdate->name = $request->subject_title;
        $subjectUpdate->description = $request->subject_des;
        $subjectUpdate->folder_id = $request->subject_folder;

        $this->subjectRepository->update($subjectUpdate);

        return redirect()->route('subject', ['id' => $id]); 
    }

    public function deleteCardOfSubject(Request $request)
    {
        $subjectId = $this->cardRepository->getSubjectIdByCard($request->cardDeleteId);

        $this->cardRepository->delete($request->cardDeleteId);
        
        $cards = $this->cardRepository->getCardBySubject($subjectId);

        if ($cards->count() == 0) {
            $this->subjectRepository->delete($subjectId);
            $this->recentSubRepository->delete($subjectId);
            return redirect()->route("home");
        }

        else {
            return redirect()->back();
        }
    }

    public function updateCardOfSubject($id, Request $request) {
        $this->validate($request, 
            [
                'front' => 'required',
                'back' => 'required'
            ],
            [
                'front' => "Vui lòng nhập định nghĩa",
                'back' => "Vui lòng nhập thuật ngữ",
            ]
        );

        $cardEdited = new Card();
        $cardEdited->id = $id;
        $cardEdited->back = $request->back;
        $cardEdited->front = $request->front;

        $this->cardRepository->editCard($cardEdited);

        return redirect()->back();
    }

    public function add(Request $request) {
        $subject = $this->subjectRepository->getSubjectById($request->subjectId);

        $subjectToAdd['user_id'] = Auth::user()->id;
        $subjectToAdd['maker'] = $subject->user->name;
        $subjectToAdd['folder_id'] = 1;
        $subjectToAdd['name'] = $subject->name;
        $subjectToAdd['shared_status'] = $subject->shared_status;
        $subjectToAdd['description'] = $subject->description;

        $newSubject = $this->subjectRepository->create($subjectToAdd);

        for($i = 0; $i < count($subject->cards); $i++)
        {
            $card['subject_id'] = $newSubject->id;
            $card['front'] = $subject->cards[$i]->front;
            $card['back'] = $subject->cards[$i]->front;
            $card['num_of_study'] = 0;
            $card['level_of_card'] = 1;
            $card['expiry_date'] = Carbon::now();

            $this->cardRepository->create($card);
        }

        return redirect()->route('subject', ['id' => $newSubject->id]); 
    }
    
}
