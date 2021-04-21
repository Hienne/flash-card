<?php

namespace App\Repositories\Contracts;

interface RepositoryInterface
{
    public function getAll();

    public function find($id);
}