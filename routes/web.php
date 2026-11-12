<?php

use App\Http\Controllers\AlbumsController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::view('/', 'homepage');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

Route::get('users', function(){
    return User::with('albums')->paginate(5); //suddividere in pagine il json
});

//Route::get('/albums', [AlbumsController::class, 'index']);

Route::resource('albums', AlbumsController::class); //mappa le rotte in automatico
