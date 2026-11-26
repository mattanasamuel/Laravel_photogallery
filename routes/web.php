<?php

use App\Http\Controllers\AlbumsController;
use App\Http\Controllers\PhotosController;
use App\Http\Controllers\ProfileController;
use App\Models\Album;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::view('/', 'homepage');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('albums', AlbumsController::class)->withoutMiddlewareFor(['index', 'show'], 'auth');//->middleware('auth'); //mappa le rotte in automatico, aggiunge il middleware
    Route::resource('photos', PhotosController::class);

});

require __DIR__.'/auth.php';

Route::get('users', function(){
    return User::with('albums')->paginate(5); //suddividere in pagine il json
});

Route::get('usersnoalbum', function(){
    $usersnoalbum = DB::table('users as u')
        ->leftJoin('albums as a', 'u.id', '=', 'a.user_id')
        ->select('u.id', 'u.email', 'u.name')
        ->whereRaw('album_name IS NULL')
        ->get();
    return $usersnoalbum;
});

Route::get('/albums/{album}/images', [AlbumsController::class, 'getImages'])->name('albums.images');

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


