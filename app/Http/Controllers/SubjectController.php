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
}
