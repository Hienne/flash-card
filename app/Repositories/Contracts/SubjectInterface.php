<?php

namespace App\Repositories\Contracts;

interface SubjectInterface
{
    public function getSubjectById($id);

    public function getSubjectByUser($userId);

    public function getSubjectByFolder($folderId);

    public function getSearchSubject($keyword);

    public function create($subject);

    public function update($subjectId);
}