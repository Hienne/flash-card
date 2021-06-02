<?php

namespace App\Repositories\Contracts;

interface FolderInterface
{
    public function getFolderByUser($userId);

    public function getSearchFolder($keyword);

    public function getDefaultFolder($userId);

    public function create($folder);

    public function createDefaultFolder($user);

    public function update($folderId);
}