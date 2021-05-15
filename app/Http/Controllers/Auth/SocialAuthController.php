<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Socialite, Auth, Redirect, Session, URL;
use App\Models\User;
use App\Repositories\Eloquents\FolderRepository;

class SocialAuthController extends Controller
{
    protected $folderRepository;

    public function __construct(
        FolderRepository $folderRepository) 
    {
        $this->folderRepository = $folderRepository;
    }

    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }  

    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect('/login');
        }

        $existingUser = User::where('email', $user->email)->first();
        
        if($existingUser){
            auth()->login($existingUser, true);
        } else {
            $newUser                  = new User;
            $newUser->name            = $user->name;
            $newUser->email           = $user->email;
            $newUser->google_id       = $user->id;
            $newUser->save();
            $this->folderRepository->createDefaultFolder($newUser);
            auth()->login($newUser, true);
        }
        return redirect()->to('/home');
    }
}
