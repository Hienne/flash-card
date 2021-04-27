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

        $newSubject = Subject::create([
            'user_id' => Auth::user()->id,
            'folder_id' => $subjectFol,
            'name' => $request->subject_title,
            'description' => $request->subject_des
        ]);

        for($i = 0; $i < count($request->card_fronts); $i++)
        {
            Card::create([
                'subject_id' => $newSubject->id,
                'front' => $request->card_fronts[$i],
                'back' => $request->card_backs[$i],
                'expiry_date' => '2020-4-24'
            ]);
        }

        return redirect()->route('subject', ['id' => $newSubject->id]); 
    }

    public function studyingIndex($id) {

        $subject = $this->subjectRepository->getSubjectById($id);
        $cards = $this->cardRepository->getCardBySubject($id);

        return view('pages.card_study', compact('subject', 'cards'));
    }

    public function updateStudyingCard(Request $request) {
        dd($request);
    }
}
