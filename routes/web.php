<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\StudyingController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\SharedSubjectController;
use App\Http\Controllers\TestController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/dashboard', [RegisterController::class, 'dashboard'])->name('dashboard');

/*************Auth************/
Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login');

//login google
Route::get('auth/redirect', [SocialAuthController::class, 'redirectToProvider'])->name('login.google');
Route::get('auth/callback/google', [SocialAuthController::class, 'handleProviderCallback']);

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register');


/*************Home************/
Route::get('/home', [HomeController::class, 'index'])->name('home');


/*************Subject************/
Route::get('/subject/{id}', [SubjectController::class, 'index'])->name('subject');
Route::get('/subject', [SubjectController::class, 'createIndex'])->name('subject.createIndex');
Route::post('/subject', [SubjectController::class, 'create'])->name('subject.create');
Route::post('/subject/delete', [SubjectController::class, 'delete'])->name('subject.delete');
Route::get('/subject/update/{id}', [SubjectController::class, 'updateIndex'])->name('subject.updateIndex');
Route::post('/subject/update/{id}', [SubjectController::class, 'update'])->name('subject.update');

Route::put('/subject/card/update/{id}', [SubjectController::class, 'updateCardOfSubject'])->name('subject.card.update');
Route::post('/subject/card/delete', [SubjectController::class, 'deleteCardOfSubject'])->name('subject.card.delete');


/*************Folder************/
Route::post('/folder', [FolderController::class, 'create'])->name('folder.create');
Route::post('/folder/delete', [FolderController::class, 'delete'])->name('folder.delete');


/*************Library************/
Route::get('/library', [LibraryController::class, 'index'])->name('library');
Route::get('/library/search_subject', [LibraryController::class, 'subjectSearcher'])->name('library.search_subject');
Route::get('/library/search_folder', [LibraryController::class, 'folderSearcher'])->name('library.search_folder');

/*************Studying************/
Route::get('/subject/studying/{id}', [StudyingController::class, 'studyingIndex'])->name('studying');
Route::post('/subject/studying', [StudyingController::class, 'updateStudyingCard'])->name('studying.updateStudyingCard');

/*************exam************/
Route::get('/subject/exam/{id}', [StudyingController::class, 'exam'])->name('studying.exam');

/*************writing************/
Route::get('/subject/writing/{id}', [StudyingController::class, 'writing'])->name('studying.writing');

/*************listening************/
Route::get('/subject/listening/{id}', [StudyingController::class, 'listening'])->name('studying.listening');


/*************Test************/
Route::get('/test', [TestController::class, 'index']);
Route::post('/images', [ImageController::class, 'store'])->name('images.store');
Route::get('/storage/{folder}/{fileName}', [ImageController::class, 'image']);



Route::get('/', function () {
    return view('pages.guest');
});

/*************Language************/
Route::get('locale/{locale}', function ($locale){
    Session::put('locale', $locale);
    return redirect()->back();
});

/*************Shared_subject************/
Route::post('/shared_subject', [SharedSubjectController::class, 'create'])->name('sharedSub.create');
Route::get('/shared_subject/search', [SharedSubjectController::class, 'subjectSearcher'])->name('shared_subject.search');
Route::post('/shared_subject/add', [SubjectController::class, 'add'])->name('shared_subject.add');



