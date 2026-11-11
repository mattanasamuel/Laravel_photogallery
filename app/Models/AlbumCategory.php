<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class AlbumCategory extends Model
{
    /** @use HasFactory<\Database\Factories\AlbumCategoryFactory> */
    use HasFactory;
    protected $table = 'album_category'; //questo model deve leggere e scrivere esclusivamente nella tabella category, ignora la convenzione con i nomi plurali per le pivot

    public function album()
    {
        return $this->belongsTo(Album::class, 'album_id'); //la singola entità album appartiene alla colonna album_id della pivot che punta a un elemento della classe Album
    } //in questo caso sarebbe anche possibile sottintendere album_id poichè rispetta la sintassi standard

    public function category()
    {
        return $this->belongsTo(AlbumCategories::class, 'album_category_id'); //idem
    }

}
