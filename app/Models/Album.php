<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $album_name
 * @property string $album_thumb
 * @property string $description
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\AlbumCategory> $categories
 * @property-read int|null $categories_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Photo> $photos
 * @property-read int|null $photos_count
 * @property-read \App\Models\User $users
 * @method static \Database\Factories\AlbumFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Album newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Album newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Album onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Album query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Album whereAlbumName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Album whereAlbumThumb($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Album whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Album whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Album whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Album whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Album whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Album whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Album withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Album withoutTrashed()
 * @mixin \Eloquent
 */
class Album extends Model
{
    /** @use HasFactory<\Database\Factories\AlbumFactory> */
    use HasFactory;
    use SoftDeletes; //aggiungo i trait dei metodi che intendo usare
    //protected $table = 'albums'; //superflui, rispettano la notazione standard, non c'è bisogno di ridichiarare
    //protected $primaryKey = 'id';
    protected $fillable = ['album_name', 'description', 'user_id', 'album_thumb'];
    protected $guarded = ['id'];
    public function categories (): BelongsToMany
    {
        return $this->belongsToMany(AlbumCategory::class, 'album_category', 'album_id', 'album_category_id'); //le relazione many to many devono essere dichiarate manualmente?
    }

    public function users():BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function photos():HasMany
    {
        return $this->hasMany(Photo::class, 'album_id', 'id');
    }

    public function getPathAttribute(){
        $url = $this->album_thumb;
        if(!str_starts_with($url, 'http')){
            $url = 'storage/' . $url;
        }
        return $url;
    }

}
