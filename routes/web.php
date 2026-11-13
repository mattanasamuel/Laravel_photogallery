<?php

use App\Http\Controllers\AlbumsController;
use App\Models\Album;
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

//tanto il metodo edit è già mappato dal controller resources
/*
Route::get('albums/{id}/edit', function($id){
    $album = DB::selectOne("SELECT * FROM albums WHERE ID = :id", [':id' => $id]); //ottengo facendo direttamente la query
    return view('albums.edit', ['album' => $album]);
}); */
/*
Route::get('albums/{id}/edit', function(Album $album){ //route automatica con il route model binding
    return view('albums.edit', compact('album')); per qualche motivo non sto simpatico al route model binding automatico
})->name('albums.edit'); */

//Route::get('/albums', [AlbumsController::class, 'index']);

Route::resource('albums', AlbumsController::class); //mappa le rotte in automatico
