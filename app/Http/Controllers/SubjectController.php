<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Eloquents\SubjectRepository;
use App\Repositories\Eloquents\CardRepository;
use App\Repositories\Eloquents\FolderRepository;
use App\Models\Subject;
use App\Models\Card;
use Carbon\Carbon;


class SubjectController extends Controller
{

    protected $folderRepository;
    protected $subjectRepository;
    protected $cardRepository;

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
        $expiryCards = $this->cardRepository->getExpiryCardBySubject($id);

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
            $card['num_of_study'] = 0;
            $card['level_of_card'] = 1;
            $card['expiry_date'] = Carbon::now()->addDays();

            $this->cardRepository->create($card);
        }

        return redirect()->route('subject', ['id' => $newSubject->id]); 
    }

    
}
