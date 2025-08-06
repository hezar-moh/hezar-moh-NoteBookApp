<?php

use App\Http\Controllers\NoteController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('index');
});

Route::get('/showRegister',function(){
    return view('register');
})->name('showregister');


Route::get('/loginView',function(){
    return view('login');
});

Route::get('/home', [UserController::class,'aloneNotes'] );

Route::post('/register', [UserController::class,'register'])->name('register'); // you can't go to /register in url, coz this isn't get method where you can get the view.  

Route::post('/loginCheck',[UserController::class,'login'])->name('login');  

Route::post('/logout', [UserController::class, 'logout'])->middleware('auth'); //now we can see that both register, login& logout are using post method

Route::get('/viewCreate', function() {
    return view('createNote');
});


Route::post('/createNote', [NoteController::class, 'createNote'])->middleware('auth');

Route::get('edit-note/{note}', [NoteController::class, 'showEditScreen'])->name('edit')->middleware('auth');
Route::put('edit-note/{note}', [NoteController::class, 'updateNote'])->name('edit')->middleware('auth');
Route::delete('delete-note/{note}', [NoteController::class, 'deletenote'])->name('delete')->middleware('auth');
