<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'author_id',
        'title',
        'description',
        'published_year',
        'price'
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class)
                    ->withTimestamps();
    }

    public function Copies(): HasMany
    {
        return $this->hasMany(Copy::class);
    }

    public function scopeGetBookByGenre($query,string $genre = null)
    {
        return $query->whereHas('genres', function($query) use ($genre){
            $query->where('name', $genre);
        });
    }

    public function scopeGetBookByAuthor($query ,string $author = null)
    {
        return $query->whereHas('author', function($query) use ($author){
            $query->whereAny([
                'name',
                'last_name'
            ],'LIKE', '%'.$author.'%');
        });
    }
}
