<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\SubjectInterface;
use App\Repositories\Eloquents\SubjectRepository;

class SubjectRepository extends EloquentRepository implements SubjectInterface {
    
    public function getModel()
    {
        return \App\Models\Subject::class;
    }

    public function getSubjectById($id) 
    {
        return $this->_model->all()->where('id', $id);
    }

    public function getSubjectByUser($userId)
    {
        return $this->_model->all()->where('user_id', $userId);
    }

    public function getSubjectByFolder($folderId)
    {
        return $this->_model->all()->where('folder_id', $folderId);
    }

    public function getSearchSubject($keyword)
    {
        return $this->_model->where('name', 'LIKE', '%' .$keyword .'%')->get();
                    // ->paginate(self::PAGINATE);
    }

    public function create($subject)
    {

    }

    public function update($subjectId)
    {

    }
}