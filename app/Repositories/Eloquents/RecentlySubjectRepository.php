<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\RecentlySubjectInterface;
use App\Repositories\Eloquents\RecentlySubjectRepository;

class RecentlySubjectRepository extends EloquentRepository implements RecentlySubjectInterface {
    
    public function getModel()
    {
        return \App\Models\RecentlySubject::class;
    }

    public function getList() {
        $allSubjects = $this->_model->all();

        if (count($allSubjects) > 4) {
            return $allSubjects->take(-4)->reverse();
        }

        return $allSubjects;
    }

    public function create($recentSub) {
        $lastRecentSubject = $this->_model->all()->last();

        if ($recentSub['subject_id'] != $lastRecentSubject->subject_id) {
            return $this->_model->create($recentSub);
        }
    }

    public function delete($recentSubId) {
        $deletedSubjects = $this->_model->all()->where('subject_id', '==', $recentSubId);


        foreach($deletedSubjects as $recentSubject) {
            $recentSubject->delete();
        }
        
        return $deletedSubjects;
    }
    
}