<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Eloquents\FolderRepository;

class RegisterController extends Controller
{
    protected $folderRepository;

    public function __construct(
        FolderRepository $folderRepository) 
    {
        $this->folderRepository = $folderRepository;
    }

    public function index() 
    {
        return view('auth.register');
    }

    public function store(Request $request) 
    {
        $user = $this->validate($request, [
            'name' => 'required|max:255',
            'date_of_birth' => 'required|date|date_format:Y-m-d',
            'email' => 'required|email|max:255',
            'password' => 'required|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'date_of_birth' => $request->date_of_birth,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        auth()->attempt($request->only('email', 'password'));

        $this->folderRepository->createDefaultFolder(auth()->user());

        return redirect()->route('home');
    }
}
