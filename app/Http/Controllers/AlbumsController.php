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
        //dd($sql);
        $albums = DB::select($sql, $where);
        return view('albums.index', ['albums' => $albums]);
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
    public function show(Album $album)
    {
        return $album;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Album $album)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Album $album)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $album):int
    {
        $sql = 'DELETE FROM albums WHERE id =:id';
        return DB::delete($sql, ['id' => $album]);
    }
}
