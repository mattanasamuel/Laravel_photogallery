<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlbumsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    /*
    public function index(Request $request)
    {
        $sql = 'select * from albums';
        $where = '1=1';
        if($request->has('id')){
            $where .= ' AND id = ' . (int)$request->get('id');
        }
        if($request->has('album_name')){

            $where .= " AND album_name = '" . (string)$request->get('album_name') . "'";
        }
        $sql .= " WHERE " . $where;
        //dd($sql);
        return DB::select($sql); //facade DB per riferirmi alla classe database tramite facades/db
    } */
    /*
    public function index(Request $request) //passo array solo valori
    {
        $sql = 'select * from albums WHERE 1=1';
        $where = [];
        if($request->has('id')){
            $where['id'] = $request->get('id');
            $sql .= " AND id=?";
        }
        if($request->has('album_name')){

            $where['album_name'] = $request->get('album_name');
            $sql .= " AND album_name=?";
        }
        //dd($sql);
        return DB::select($sql, array_values($where)); //facade DB per riferirmi alla classe database tramite facades/db
    }
    */
    public function index(Request $request) //passo array chiave/valore, come si fa con PDO contro sqlinjection
    {
        $sql = 'select * from albums WHERE 1=1';
        $where = [];
        if($request->has('id')){
            $where['id'] = $request->get('id');
            $sql .= " AND id=:id";
        }
        if($request->has('album_name')){

            $where['album_name'] = $request->get('album_name');
            $sql .= " AND album_name=:album_name";
        }
        $sql .= ' ORDER BY updated_at ASC';
        //dd($sql);
        $albums = DB::select($sql, $where);
        return view('albums.index', ['albums' => $albums]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('albums.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $data = $request->only(['album_name', 'description']);
        $data['user_id'] = 1; //non gestiamo gli utenti
        $data['album_thumb'] = 'default';
        $query = 'insert into albums (album_name, description, user_id, album_thumb) values (:album_name, :description, :user_id, :album_thumb)';
        $message = 'album ' . $data['album_name'];
        $res = DB::insert($query, $data);

        $message .= $res ? ' created' : ' not created';
        session()->flash('message', $message);
        session()->flash('message_code', 1);
        return redirect()->route('albums.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Album $album)
    {
        return $album;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Album $album)
    {
        $album = DB::selectOne('SELECT * FROM albums WHERE id = :id', [':id' => $album->id]);
        return view('albums.edit', ['album' => $album]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Album $album) //ottiene album automaticamente, cerca un elemento album con l'id contenuto nell'uri
    {
        //dd($request->all());
        $data = $request->only(['album_name', 'description']); //nuovi dati, arrivano dalla richiesta, passati nel form
        $data['id'] = $album->id; //dato pk, arriva dall'elemento album "vecchio" trovato dal routing di laravel
        $query = 'UPDATE albums set album_name=:album_name, description=:description where id = :id';
        $res = DB::update($query, $data);
        $message = 'Album con id=' . $album->id;
        //dd($res);
        $message .= $res ? ' aggiornato' : ' non aggiornato';
        session()->flash('message', $message);
        session()->flash('message_code', (int)$res);
        return redirect()->route('albums.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $album):int
    {
        session()->flash('message', 'ciao');
        $sql = 'DELETE FROM albums WHERE id =:id';
        return DB::delete($sql, ['id' => $album]);
    }
}
