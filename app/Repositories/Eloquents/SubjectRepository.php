<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\SubjectInterface;
use App\Repositories\Eloquents\SubjectRepository;

class SubjectRepository extends EloquentRepository implements SubjectInterface {
    const PAGINATE = 5;
    
    public function getModel()
    {
        return \App\Models\Subject::class;
    }

    public function getSubjectById($id) 
    {
        return $this->_model->where('id', $id)->first();
    }

    public function getSubjectByUser($userId)
    {
        return $this->_model->where('user_id', $userId)->paginate(self::PAGINATE);
        // return $this->_model->all()->where('user_id', $userId)->paginate(self::PAGINATE);
    }

    public function getSubjectByFolder($folderId)
    {
        return $this->_model->all()->where('folder_id', $folderId);
    }

    public function getSearchSubject($keyword)
    {
        return $this->_model->where('name', 'LIKE', '%' .$keyword .'%')->paginate(self::PAGINATE);
    }

    public function create($subject)
    {
        return $this->_model->create($subject);
    }

    public function delete($id)
    {
        return $this->_model->where('id', $id)->delete();
    }

    public function update($subjectId)
    {
        
    }

    public function getRecently() {
        
    }
}