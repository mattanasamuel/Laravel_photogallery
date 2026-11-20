<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PhotosController extends Controller
{
    protected $rules = [
        'album_id' => 'required|integer|exists:albums,id',
        'name' => 'required',
        'file_path' => 'required|image' //miraccomando, avevamo cambiato il nome dell'input per adattarlo alla riutilizzabilità nel componente
    ];
    protected $messages = [
        'album_id.required' => 'il campo album è obbligatorio',
        'description.required' => 'il campo descrizione è obbligatorio',
        'name.required' => 'il campo nome è obbligatorio',
        'file_path.required' => 'il campo immagine è obbligatorio',
    ];
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
    public function create(Request $request) //per la creazione dell'immagine riutilizziamo la vista per la modifica
    {
        $photo = new Photo();
        $album_id = $request->query('album_id');
        $album = $album_id ? Album::findOrFail($album_id) : new Album();
        $albums = $this->getAlbums();
        return view ('images.edit', compact('album', 'photo', 'albums'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request);
        $request->validate($this->rules, $this->messages);
        $album = $request->input('album_id');
        $photo = new Photo();
        $photo->name = $request->input('name');
        $photo->description = $request->input('description');
        $photo->album_id = $album;
        $this->processFile($request, $photo);
        $photo->save();
        return redirect()->route('albums.images', $photo->album);
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
        $album = $photo->album;
        $albums = $this->getAlbums();
        return view('images.edit', compact('photo', 'album', 'albums'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Photo $photo)
    {
        $data = $request->only(['name', 'description', 'album_id']);
        $photo->album_id = $data['album_id'];
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
        dd($request);
        $file = $request->file('file_path');
        $name = preg_replace('@[a-z]i@', '_', $photo->name);
        $filename =  $name . '.' . $file->extension();
        //dd($filename);
        $thumbnail = $file->storeAs(config('filesystems.img_dir') . $photo->album_id, $filename, ['disk' => 'public']); //salva nel disco e restituisce il percorso
        //dd($thumbnail);
        $photo->image_path = $thumbnail;
        //dd($thumbnail);
    }

    /**
     * @return Collection
     */
    public function getAlbums(): Collection
    {
        return Album::orderBy('album_name')->select(['id', 'album_name'])->get();
    }
}
