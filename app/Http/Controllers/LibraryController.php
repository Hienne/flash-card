<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Eloquents\FolderRepository;
use App\Repositories\Eloquents\SubjectRepository;

class LibraryController extends Controller
{

    protected $folderRepository;
    protected $subjectRepository;

    public function __construct(
            FolderRepository $folderRepository,
            SubjectRepository $subjectRepository
        ) 
    {
        $this->folderRepository = $folderRepository;
        $this->subjectRepository = $subjectRepository;
    }
    
    public function index() 
    {
        $user = Auth::user();

        $folders = $this->folderRepository->getFolderByUser($user->id);
        $subjects = $this->subjectRepository->getSubjectByUser($user->id);

        return view('pages.library.library', compact('subjects', 'folders'));
    }

    public function subjectSearcher(Request $request)
    {
        $user = Auth::user();
        
        $folders = $this->folderRepository->getFolderByUser($user->id);

        $keyword = $request->subject_keyword;

        $subjects = $this->subjectRepository->getSearchSubject($keyword);

        return view('pages.library.library', compact('subjects', 'folders'));
    }

    public function folderSearcher(Request $request)
    {
        $user = Auth::user();
        
        $subjects = $this->subjectRepository->getSubjectByUser($user->id);
        

        $keyword = $request->folder_keyword;

        $folders = $this->folderRepository->getSearchFolder($keyword);

        return view('pages.library.library', compact('subjects', 'folders'));
    }
}
