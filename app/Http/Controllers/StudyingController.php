<?php

namespace App\Http\Controllers;

use App\Repositories\Eloquents\SubjectRepository;
use App\Repositories\Eloquents\CardRepository;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Card;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;


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
        // $cards = $this->cardRepository->getExpiryCardBySubject($id);
        $cardsContent = $this->cardRepository->getCardBySubject($id);
        $cardsContentForTranslate = $this->cardRepository->getRandomCard($id);
        $cardsContentForMatching = $this->cardRepository->getRandomCard($id);
        $cardsContentForSelection = $this->cardRepository->getRandomCard($id);
        $cardsContentForChoofal = $this->cardRepository->getRandomCard($id);

        $cards = array();
        $cardsForTranslate = collect();
        $cardsForMatching = collect();
        $cardsForSelection = collect();
        $cardsForChoofal = collect();

        $index = 0;
        foreach($cardsContent as $card) {
            array_push($cards, $card);
            $cards[$index]->front = strip_tags($cards[$index]->front, 'p');
            $cards[$index]->back = strip_tags($cards[$index]->back, 'p');
            $index++;
            if($index > 10) {
                break;
            }
        }

        // dd($cards);


        for ($i = 0; $i < count($cardsContentForTranslate); $i++) {
            $cardsForTranslate[$i] = $cardsContentForTranslate[$i];
            $cardsForTranslate[$i]->front = strip_tags($cardsForTranslate[$i]->front, 'p');
            $cardsForTranslate[$i]->back = strip_tags($cardsForTranslate[$i]->back, 'p');

            $cardsForSelection[$i] = $cardsContentForSelection[$i];
            $cardsForSelection[$i]->front = strip_tags($cardsForSelection[$i]->front, 'p');
            $cardsForSelection[$i]->back = strip_tags($cardsForSelection[$i]->back, 'p');

            $cardsForMatching[$i] = $cardsContentForMatching[$i];
            $cardsForMatching[$i]->front = strip_tags($cardsForMatching[$i]->front, 'p');
            $cardsForMatching[$i]->back = strip_tags($cardsForMatching[$i]->back, 'p');

            $cardsForChoofal[$i] = $cardsContentForChoofal[$i];
            $cardsForChoofal[$i]->front = strip_tags($cardsForChoofal[$i]->front, 'p');
            $cardsForChoofal[$i]->back = strip_tags($cardsForChoofal[$i]->back, 'p');
        }


        $answersForMatching = [];
        $answersForSelection = [];
        $cardsRandom = [];

        
        return view('pages.studying.exam', compact('cards', 'cardsRandom', 'cardsForTranslate', 'cardsForMatching', 'answersForSelection', 'answersForMatching', 'cardsForSelection', 'cardsForChoofal')); 
    }

    public function writing($id) {
        $cards = $this->cardRepository->getCardBySubject($id);
        $numOfCard = count($cards);
        $subjectId = $id;

        return view('pages.studying.writing', compact('cards', 'numOfCard', 'subjectId'));
    }

    public function listening($id) {
        $cards = $this->cardRepository->getCardBySubject($id);
        $numOfCard = count($cards);
        $subjectId = $id;

        return view('pages.studying.listening', compact('cards', 'numOfCard', 'subjectId'));
    }
}
