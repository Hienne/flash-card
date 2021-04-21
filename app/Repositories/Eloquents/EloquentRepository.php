<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\RepositoryInterface;

abstract class EloquentRepository implements RepositoryInterface 
{
    protected $_model;

    public function __construct()
    {
        $this->setModel();
    }

    abstract public function getModel();

    public function setModel()
    {
        $this->_model = app()->make($this->getModel());
    }

    public function getAll()
    {
        return $this->_model::all();
    }

    public function find($id) 
    {
        $result = $this->_model->find($id);

        return $result;
    }
}