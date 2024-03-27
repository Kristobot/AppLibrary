<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Copy extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'copy_status_id'
    ];

    protected $attributes = [
        'copy_status_id' => 1
    ];

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(CopyStatus::class, 'copy_status_id');
    }

    public function loans(): BelongsToMany
    {
        return $this->belongsToMany(Loan::class)
                    ->withTimestamps();
    }

    public function scopeGetAvailable($query)
    {
        return $query->where('copy_status_id', 1);
    }
}
