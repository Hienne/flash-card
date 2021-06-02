<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\FolderInterface;
use App\Repositories\Eloquents\FolderRepository;

class FolderRepository extends EloquentRepository implements FolderInterface {
    const PAGINATE = 5;
    
    public function getModel()
    {
        return \App\Models\Folder::class;
    }

    public function getFolderByUser($userId)
    {
        // return $this->_model->all()->where('user_id', $userId)->except(1);
        return $this->_model->where('user_id', $userId)->whereNotIn('id', [1])->paginate(self::PAGINATE);
    }

    public function getSearchFolder($keyword)
    {
        return $this->_model->where('name', 'LIKE', '%' .$keyword .'%')->get();
                    // ->paginate(self::PAGINATE);
    }

    public function getDefaultFolder($userId)
    {
        return $this->_model->all()->where('user_id', $userId)->where('name', '==', 'Default')->first();
    }

    public function create($folder) 
    {   
        return $this->_model->create($folder);
    }

    public function createDefaultFolder($user)
    {
        $user->folders()->create([
            'name'=> 'Default',
            'description' => 'Default Folder'
        ]);
    }

    public function update($folderId)
    {

    }
}