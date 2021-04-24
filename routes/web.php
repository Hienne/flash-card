<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\LibraryController;





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

Route::get('/dashboard', [RegisterController::class, 'dashboard'])->name('dashboard');

/*************Auth************/
Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register');


/*************Home************/
Route::get('/home', [HomeController::class, 'index'])->name('home');


/*************Subject************/
Route::get('/subject/{id}', [SubjectController::class, 'index'])->name('subject');
Route::get('/subject', [SubjectController::class, 'createIndex'])->name('subject.createIndex');
Route::post('/subject', [SubjectController::class, 'create'])->name('subject.create');

/*************Library************/
Route::get('/library', [LibraryController::class, 'index'])->name('library');
Route::get('/library/search_subject', [LibraryController::class, 'subjectSearcher'])->name('library.search_subject');
Route::get('/library/search_folder', [LibraryController::class, 'folderSearcher'])->name('library.search_folder');

/*************Test************/
Route::get('/', function () {
    return view('pages.subject.subject_creater');
});
