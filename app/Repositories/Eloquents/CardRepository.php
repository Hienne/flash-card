<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\CardInterface;
use App\Repositories\Eloquents\CardRepository;

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

    public function create($card)
    {

    }

    public function update($cardId)
    {

    }
}