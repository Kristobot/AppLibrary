<?php

namespace App\Models;

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
        'published_year'
    ];

    public function copies(): HasMany
    {
        return $this->hasMany(Copy::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class)
                    ->withTimestamps();
    }

    public function scopeGetByAuthor($query, string $author)
    {
        return $query->whereHas('author', function($query) use($author){
            $query->whereAny([
                'name',
                'last_name'
            ],
            'LIKE',  '%'.$author.'%');
        });
    }

    public function scopeGetByGenre($query, string $genre)
    {
        return $query->whereHas('genres', function($query) use($genre){
            $query->where('name','LIKE','%'.$genre.'%');
        });
    }

    public function scopeFilterByGenreAndAuthor($query, ?string $author, ?string $genre)
    {
        return $query->where(function ($query) use ($author, $genre) {

            $query->when($author, function($query) use($author){
                $query->getByAuthor($author);
            });

            $query->when($genre, function($query) use($genre){
                $query->getByGenre($genre);
            });
        });
    }
}
