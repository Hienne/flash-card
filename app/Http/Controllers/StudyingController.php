<?php

namespace App\Http\Controllers;

use App\Repositories\Eloquents\SubjectRepository;
use App\Repositories\Eloquents\CardRepository;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Card;
use Illuminate\Support\Arr;


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
        $cards = $this->cardRepository->getExpiryCardBySubject($id);
        $cardsForTranslate = $this->cardRepository->getRandomCard($id);
        $cardsForMatching = $this->cardRepository->getRandomCard($id);
        $cardsForSelection = $this->cardRepository->getRandomCard($id);
        $cardsForChoofal = $this->cardRepository->getRandomCard($id);

        // $answersForMatching[0] = $cardsForMatching->search($cardsForMatching->random());
        // $answersForMatching[1] = $cardsForMatching->search($cardsForMatching->random());

        // $answersForMatching[0] = 1;
        // $answersForMatching[1] = 2;
        // $answersForMatching[2] = 3;
        // $answersForMatching[3] = 4;

        // dd($answersForMatching);
        // $collection = collect([0=>1, 1=>"Hardik", 2=>"Admin"]);

        // $filtered = Arr::except($cardsForMatching, $answersForMatching);

        // dd($filtered);
        // dd($cardsForTranslate);
        // dd($cardsForMatching->except());
        // dd($cardsForMatching->except([0, 1]));

        
        return view('pages.studying.exam', compact('cards','cardsForTranslate', 'cardsForMatching', 'cardsForSelection', 'cardsForChoofal')); 
    }
}
