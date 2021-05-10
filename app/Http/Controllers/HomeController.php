<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Eloquents\FolderRepository;
use App\Repositories\Eloquents\SubjectRepository;
use App\Repositories\Eloquents\CardRepository;


class HomeController extends Controller
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

    public function index()
    {
        $user = Auth::user();

        $folders = $this->folderRepository->getFolderByUser($user->id);
        $subjects = $this->subjectRepository->getSubjectByUser($user->id);

        $expiryCardsByFolder = array();

        foreach ($folders as $folder) {
            $subjectsByFolder = $this->subjectRepository->getSubjectByFolder($folder->id);
            $numOfExpiryCard = 0;

            foreach ($subjectsByFolder as $subject) {
                $numOfExpiryCard += count($this->cardRepository->getExpiryCardBySubject($subject->id));
            }

            $expiryCardsByFolder[$folder->id] = $numOfExpiryCard;
        }

        return view('pages.home', compact('expiryCardsByFolder'));
    }
}
