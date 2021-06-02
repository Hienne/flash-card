<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Eloquents\SubjectRepository;
use App\Repositories\Eloquents\CardRepository;
use App\Repositories\Eloquents\FolderRepository;
use App\Repositories\Eloquents\RecentlySubjectRepository;
use App\Repositories\Eloquents\SharedSubjectRepository;

class SharedSubjectController extends Controller
{

    protected $subjectRepository;
    protected $cardRepository;
    protected $sharedSubjectRepository;

    public function __construct(
            SubjectRepository $subjectRepository,
            CardRepository $cardRepository,
            SharedSubjectRepository $sharedSubRepository
        ) 
    {
        $this->subjectRepository = $subjectRepository;
        $this->cardRepository = $cardRepository;
        $this->sharedSubjectRepository = $sharedSubRepository;
    }

    public function index() {
        $user = Auth::user();

        $folders = $this->folderRepository->getFolderByUser($user->id);
        $subjects = $this->subjectRepository->getSubjectByUser($user->id);

        return view('pages.library.library', compact('subjects', 'folders'));
    }

    public function create(Request $req) {
        $subject = $this->subjectRepository->getSubjectById($req->subject_id);

        $this->subjectRepository->updateStatus($subject->id);

        return redirect()->route('subject', ['id' => $req->subject_id]);
    }

    public function subjectSearcher(Request $request)
    {
        $keyword = $request->subject_keyword;

        $sharedSubjects = $this->subjectRepository->getSearchSharedSubject($keyword);

        return view('pages.subject.shared_subject', compact('sharedSubjects'));
    }
}
