<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\SharedSubjectInterface;
use App\Repositories\Eloquents\SharedSubjectRepository;

class SharedSubjectRepository extends EloquentRepository implements SharedSubjectInterface {
    const PAGINATE = 5;
    
    public function getModel()
    {
        return \App\Models\SharedSubject::class;
    }

    public function test() {
        return $this->_model->all();
    }

    public function getSearchSubject($keyword)
    {

        return $this->_model->where('name', 'LIKE', '%' .$keyword .'%')
        // ->take(1)->get();
        ->paginate(self::PAGINATE);
    }

    public function create($subject)
    {
        return $this->_model->create($subject);
    }
}