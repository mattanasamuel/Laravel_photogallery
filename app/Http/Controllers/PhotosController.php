<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PhotosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sql = "SELECT * FROM photos p JOIN albums a on p.album_id = a.id  HAVING 1=1";
        $where = [];
        if($request->has('id')){
            $sql .= " AND id = :id";
            $where['id'] = $request->get('id');
        }
        if($request->has('album_name')){
            $sql .= " AND album_name = :album_name";
            $where['album_name'] = $request->get('album_name');
        }
        return DB::select($sql, $where);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Photo $photo)
    {
        return $photo;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Photo $photo)
    {
        return view('images.edit')->withPhoto($photo);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Photo $photo)
    {
        $data = $request->only(['name', 'description']);
        if($request->has('file_thumb')){
            $this->processFile($request, $photo);
        }
        $res = $photo->update($data);
        $message = 'Photo con id=' . $photo->id . ($res ? ' aggiornato' : ' non aggiornato');
        session()->flash('message', $message);
        session()->flash('message_code', (int)$res);
        return redirect()->route('albums.images', ['album' => $photo->album_id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Photo $photo)
    {
        $thumbnail = $photo->image_path;
        $res = (int)$photo->delete();
        if($res && $thumbnail){
            Storage::delete($photo->image_path);
        }
        return $res;
    }

    /**
     * @param Request $request
     * @param Photo $photo
     * @return void
     */
    public function processFile(Request $request, Photo $photo): void
    {
        $file = $request->file('file_thumb');
        $filename = $photo->id . '.' . $file->extension();
        //dd($filename);
        $thumbnail = $file->storeAs(config('filesystems.img_dir') . $photo->album_id, $filename, ['disk' => 'public']); //salva nel disco e restituisce il percorso
        //dd($thumbnail);
        $photo->image_path = $thumbnail;
        //dd($thumbnail);
    }
}
