<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Copy extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'copy_status_id'
    ];

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(CopyStatus::class,'copy_status_id');
    }

    public function loans(): BelongsToMany
    {
        return $this->belongsToMany(Loan::class)
                    ->withTimestamps();
    }

    public function scopeAvailable($query)
    {
        return $query->where('copy_status_id', 1);
    }
}
