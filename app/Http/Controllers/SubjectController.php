<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Eloquents\SubjectRepository;
use App\Repositories\Eloquents\CardRepository;
use App\Repositories\Eloquents\FolderRepository;


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

        $subjects = $this->subjectRepository->getSubjectById($id);
        $cards = $this->cardRepository->getCardBySubject($id);


        return view('pages.subject', compact('user', 'subjects', 'cards'));
    }

    public function createIndex() {
        return view('pages.subject.subject_creater');
    }

    public function create(Request $request) {
        // dd($request->subject_title);
        // dd($request->subject_des);
        // dd($request->subject_folder);
        // dd(count($request->card_fronts));

        $this->validate($request, 
            [
                'subject_title' => 'required',
                'card_fronts.*' => 'min:2',
                'card_backs.*' => 'min:2'
            ],
            [
                'subject_title.required' => "Vui lòng nhập tiêu đề để tạo học phần",
                'card_fronts.min' => "BẠN CẦN HAI THẺ ĐỂ TẠO MỘT HỌC PHẦN",
                'card_backs.min' => "BẠN CẦN HAI THẺ ĐỂ TẠO MỘT HỌC PHẦN",
            ]

        );
    }
}
