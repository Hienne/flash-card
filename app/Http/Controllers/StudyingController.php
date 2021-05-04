<?php

namespace App\Http\Controllers;

use App\Repositories\Eloquents\SubjectRepository;
use App\Repositories\Eloquents\CardRepository;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Card;


class StudyingController extends Controller
{
    protected $subjectRepository;
    protected $cardRepository;

    public function __construct(
            SubjectRepository $subjectRepository,
            CardRepository $cardRepository
        ) 
    {
        $this->subjectRepository = $subjectRepository;
        $this->cardRepository = $cardRepository;
    }

    public function studyingIndex($id) {

        $subject = $this->subjectRepository->getSubjectById($id);
        $cards = $this->cardRepository->getExpiryCardBySubject($id);

        return view('pages.studying.card_study', compact('subject', 'cards'));
    }

    public function updateStudyingCard(Request $request) {
        $listRadio = $request->all();

        foreach( $listRadio as $key=>$item) {
            if ($key !== array_key_first($listRadio) && $key !== array_key_last($listRadio))
            {
                $this->cardRepository->update(substr($key, 11), $item);
            }
        }
        
        return redirect()->route('subject', ['id' => $request->subjectId]);
    }






    public function exam($id) {
        $cards = $this->cardRepository->getRandomCard($id);
        // dd($cards[0]);
        return view('pages.studying.exam', compact('cards')); 
    }
}
