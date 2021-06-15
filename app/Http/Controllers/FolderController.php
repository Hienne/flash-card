<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Eloquents\FolderRepository;

class FolderController extends Controller
{
    protected $folderRepository;

    public function __construct(
            FolderRepository $folderRepository,
        ) 
    {
        $this->folderRepository = $folderRepository;
    }

    public function create(Request $request) {
        
        $folder['name'] = $request->folder_title;
        $folder['description'] = $request->folder_des;
        $folder['user_id'] = Auth::user()->id;

        $this->folderRepository->create($folder);

        return back();
    }

    public function delete(Request $request) {

        dd($request->folderId);
        $this->folderRepository->detele($request->folderId);

        return redirect()->back();
    }
}
