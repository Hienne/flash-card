<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\CardInterface;
use App\Repositories\Eloquents\CardRepository;
use Carbon\Carbon;
use App\Models\Card;

class CardRepository extends EloquentRepository implements CardInterface {
    
    public function getModel()
    {
        return \App\Models\Card::class;
    }

    public function getCardByUser($userId)
    {
        //return a array
        return $this->_model->all()->where('user_id', $userId);
    }

    public function getCardBySubject($subjectId)
    {
        //return a array
        return $this->_model->all()->where('subject_id', $subjectId);
    }

    public function getSubjectIdByCard($cardId) {
        return $this->_model->find($cardId)->subject_id;
    }

    public function getExpiryCardBySubject($subjectId) {
        $cards = $this->_model->where('subject_id', $subjectId)->get();
        $expiryCards = array();

        foreach($cards as $card) {
            if(Carbon::create($card->expiry_date)->isToday() || Carbon::create($card->expiry_date)->isPast()) {
                array_push($expiryCards, $card);
            }
        }

        return $expiryCards;
    }

    public function getRandomCard($subjectId) {
        $cards = $this->_model->where('subject_id', $subjectId)->get();

        if (count($cards) < 5) {
            return $this->_model->where('subject_id', $subjectId)->inRandomOrder()->get();
        }

        //return a collection
        return $this->_model->where('subject_id', $subjectId)->inRandomOrder()->take(5)->get();
    }

    public function create($card)
    {
        return $this->_model->create($card);
    }

    public function delete($cardId) 
    {
        return $this->_model->where('id', $cardId)->delete();
    }

    public function deleteBySubject($subjectId) 
    {
        return $this->_model->where('subject_id', $subjectId)->delete();
    }

    public function update($cardId, $level_of_card)
    {
        $card = Card::find($cardId);

        $card->level_of_card = $level_of_card;

        if($level_of_card == 1) {
            $card->num_of_study = 1;
            $card->expiry_date = Carbon::now()->addDays();
        }
        else {
            $card->num_of_study += 1;
            $card->expiry_date = Carbon::create($card->expiry_date)->addDays($card->num_of_study * $level_of_card);
        }

        $card->save();    
    }

    public function editCard($cardEdited) {
        $card = Card::find($cardEdited->id);
        $card->back = $cardEdited->back;
        $card->front = $cardEdited->front;
        $card->num_of_study = 0;
        $card->level_of_card = 1;
        $card->expiry_date = Carbon::now()->addDays();

        $card->save();
    }
}