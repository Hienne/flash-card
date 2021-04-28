<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Eloquents\SubjectRepository;
use App\Repositories\Eloquents\CardRepository;
use App\Repositories\Eloquents\FolderRepository;
use App\Models\Subject;
use App\Models\Card;


class SubjectController extends Controller
{

    protected $folderRepository;
    protected $subjectRepository;
    protected $CardRepository;

    public function __construct(
            FolderRepository $folderRepository,
            SubjectRepository $subjectRepository,
            CardRepository $cardRepository
        ) 
    {
        $this->folderRepository = $folderRepository;
        $this->subjectRepository = $subjectRepository;
        $this->cardRepository = $cardRepository;
    }

    public function index($id) {
        $user = Auth::user();

        $subject = $this->subjectRepository->getSubjectById($id);
        $cards = $this->cardRepository->getCardBySubject($id);

        return view('pages.subject', compact('user', 'subject', 'cards'));
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
            $card['expiry_date'] = '2020-4-24';

            $this->cardRepository->create($card);
        }

        return redirect()->route('subject', ['id' => $newSubject->id]); 
    }

    public function studyingIndex($id) {

        $subject = $this->subjectRepository->getSubjectById($id);
        $cards = $this->cardRepository->getCardBySubject($id);

        return view('pages.card_study', compact('subject', 'cards'));
    }

    public function updateStudyingCard(Request $request) {
        $listRadio = $request->all();
        $arr = array();

        foreach( $listRadio as $key=>$item) {
            if ($key !== array_key_first($listRadio))
            {
                $arr[substr($key,-1)] = $item;
                // array_push($arr, $item);
            }
        
            // array_push($arr, substr($key,-1));
            
        }

        dd($arr);
    }
}
