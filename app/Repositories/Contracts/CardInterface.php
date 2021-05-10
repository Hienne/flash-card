<?php

namespace App\Repositories\Contracts;

interface CardInterface
{
    public function getCardByUser($userId);

    public function getCardBySubject($subjectId);

    public function getSubjectIdByCard($cardId);

    public function getExpiryCardBySubject($subjectId);

    public function getRandomCard($subjectId);

    public function create($card);

    public function delete($cardId);

    public function deleteBySubject($subjectId);

    public function update($cardId, $request);
}