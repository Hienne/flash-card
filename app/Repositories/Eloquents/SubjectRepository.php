<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\SubjectInterface;
use App\Repositories\Eloquents\SubjectRepository;
use App\Models\Subject;


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
    }

    public function getSubjectByFolder($folderId)
    {
        return $this->_model->all()->where('folder_id', $folderId);
    }

    public function getSearchSubject($keyword)
    {
        return $this->_model->where('name', 'LIKE', '%' .$keyword .'%')->paginate(self::PAGINATE);
    }

    public function getSearchSharedSubject($keyword)
    {
        $sharedSubjects = $this->_model->where('shared_status', true);
        
        return $sharedSubjects->where('name', 'LIKE', '%' .$keyword .'%')
                                ->orWhere('description', 'LIKE', '%' .$keyword .'%')
                                ->paginate(self::PAGINATE);
    }

    public function create($subject)
    {
        return $this->_model->create($subject);
    }

    public function delete($id)
    {
        return $this->_model->where('id', $id)->delete();
    }

    public function update($subjectUpdate)
    {
        $subject = Subject::find($subjectUpdate->id);
        $subject->name = $subjectUpdate->name;
        $subject->description = $subjectUpdate->description;
        $subject->folder_id = $subjectUpdate->folder_id;

        $subject->save();
    }

    public function updateStatus($subjectId)
    {
        $subject = Subject::find($subjectId);
        $subject->shared_status = !$subject->shared_status;
        $subject->save();
    }

    public function getRecently() {
        
    }
}