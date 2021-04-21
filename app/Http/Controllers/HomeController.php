<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Eloquents\FolderRepository;
use App\Repositories\Eloquents\SubjectRepository;


class HomeController extends Controller
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

        return view('pages.home');
    }
}
