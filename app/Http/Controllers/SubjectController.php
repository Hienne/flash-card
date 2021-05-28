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
        $cards = $this->cardRepository->getCardBySubject($id);
        $expiryCards = $this->cardRepository->getExpiryCardBySubject($id);

        $recentSub['subject_id'] = $id;
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
            [
                'subject_title.required' => "Vui lòng nhập tiêu đề để tạo học phần",
                'card_fronts.*.min' => "BẠN CẦN HAI THẺ ĐỂ TẠO MỘT HỌC PHẦN",
                'card_backs.*.min' => "BẠN CẦN HAI THẺ ĐỂ TẠO MỘT HỌC PHẦN",
            ]
        );

        $subjectFol = $request->subject_folder;

        if ($subjectFol == null) 
        {
            $subjectFol = 1;
        }

        $subject['user_id'] = Auth::user()->id;
        $subject['folder_id'] = $subjectFol;
        $subject['name'] = $request->subject_title;
        $subject['description'] = $request->subject_des;

        $newSubject = $this->subjectRepository->create($subject);

        for($i = 0; $i < count($request->card_fronts); $i++)
        {
            $card['subject_id'] = $newSubject->id;
            $card['front'] = $request->card_fronts[$i];
            $card['back'] = $request->card_backs[$i];
            $card['front_content'] = strip_tags($request->card_fronts[$i], 'p');
            $card['back_content'] = strip_tags($request->card_backs[$i], 'p');
            $card['num_of_study'] = 0;
            $card['level_of_card'] = 1;
            $card['expiry_date'] = Carbon::now();

            $this->cardRepository->create($card);
        }

        return redirect()->route('subject', ['id' => $newSubject->id]); 
    }

    public function delete(Request $request) {
        $this->cardRepository->deleteBySubject($request->subjectId);
        $this->subjectRepository->delete($request->subjectId);
        $test = $this->recentSubRepository->delete($request->subjectId);

        return redirect()->route("home");
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
    
}
