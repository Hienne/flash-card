<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Eloquents\FolderRepository;
use App\Repositories\Eloquents\SubjectRepository;
use App\Repositories\Eloquents\CardRepository;
use App\Repositories\Eloquents\RecentlySubjectRepository;


class HomeController extends Controller
{
    protected $folderRepository;
    protected $subjectRepository;
    protected $cardRepository;
    protected $recentSubRepository;

    public function __construct(
            FolderRepository $folderRepository,
            SubjectRepository $subjectRepository,
            CardRepository $cardRepository,
            RecentlySubjectRepository $recentlySubjectRepository
        ) 
    {
        $this->folderRepository = $folderRepository;
        $this->subjectRepository = $subjectRepository;
        $this->cardRepository = $cardRepository;
        $this->recentSubRepository = $recentlySubjectRepository;
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

        $recentSub = [];
        foreach($this->recentSubRepository->getListByUser($user->id) as $item) {
            array_push($recentSub, $this->subjectRepository->getSubjectById($item->subject_id));
        }

        return view('pages.home', compact('expiryCardsByFolder', 'recentSub', 'user'));
    }
}
