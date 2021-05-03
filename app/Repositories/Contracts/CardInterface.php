<?php

namespace App\Repositories\Contracts;

interface CardInterface
{
    public function getCardByUser($userId);

    public function getCardBySubject($subjectId);

    public function getRandomCard($subjectId);

    public function create($card);

    public function update($cardId, $request);
}