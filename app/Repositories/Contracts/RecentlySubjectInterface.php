<?php

namespace App\Repositories\Contracts;

interface RecentlySubjectInterface
{
    public function getList();

    public function create($recentSub);

    public function delete($recentSubId);
}