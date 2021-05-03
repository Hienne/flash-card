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
        return $this->_model->all()->where('user_id', $userId);
    }

    public function getCardBySubject($subjectId)
    {
        return $this->_model->all()->where('subject_id', $subjectId);
    }

    public function getRandomCard($subjectId) {
        return $this->_model->inRandomOrder()->take(20)->get();
    }

    public function create($card)
    {
        return $this->_model->create($card);
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
}