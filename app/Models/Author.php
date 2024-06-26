<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Author extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'last_name',
        'country_id'
    ];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }

    public function scopeGetByCountry($query, string $country)
    {
        return $query->whereHas('country', function($query) use ($country){
            $query->where('name', $country);
        });
    }
}
