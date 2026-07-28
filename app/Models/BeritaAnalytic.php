<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BeritaAnalytic extends Model
{
    protected $fillable = [
        'berita_id',
        'date',
        'views',
        'unique_views',
        'shares',
        'avg_reading_time',
        'referrers'
    ];

    protected $casts = [
        'date' => 'date',
        'views' => 'integer',
        'unique_views' => 'integer',
        'shares' => 'integer',
        'avg_reading_time' => 'decimal:2',
        'referrers' => 'array'
    ];

    public function berita(): BelongsTo
    {
        return $this->belongsTo(Berita::class);
    }
}