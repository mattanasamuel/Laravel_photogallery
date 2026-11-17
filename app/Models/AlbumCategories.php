<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property string $category_name
 * @property string|null $description
 * @property int $user_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\AlbumCategory> $albums
 * @property-read int|null $albums_count
 * @method static \Database\Factories\AlbumCategoriesFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AlbumCategories newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AlbumCategories newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AlbumCategories query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AlbumCategories whereCategoryName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AlbumCategories whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AlbumCategories whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AlbumCategories whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AlbumCategories whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AlbumCategories whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AlbumCategories whereUserId($value)
 * @mixin \Eloquent
 */
class AlbumCategories extends Model
{
    /** @use HasFactory<\Database\Factories\AlbumCategoriesFactory> */
    use HasFactory;
    public function albums (): BelongsToMany
    {
        return $this->belongsToMany(AlbumCategory::class, 'album_category', 'album_category_id', 'album_id'); //la related pivot key indica la foreign key dell'altra tabella al di là della pivot
    }
}
