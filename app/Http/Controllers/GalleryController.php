<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Photo;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(){
        //$albums = Album::latest()->paginate(50);
        #TODO capire come funziona la iggerloading
        $albums = Album::with('categories')->latest()->paginate(50);
        return view('public.albums')->with('albums', $albums);
    }

    public function showAlbumImages(Album $album){
        //dd($album);
        return view('public.images', [
            'images'=> Photo::where('album_id', $album->id)->get(),
            'album' => $album
        ]);
    }
}
