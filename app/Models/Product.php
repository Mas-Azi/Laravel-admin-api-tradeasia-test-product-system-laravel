<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',              // JSON: {"en": "...", "id": "..."}
        'hs_code',
        'cas_number',
        'image',
        'description',       // JSON
        'application',       // JSON
        'meta_title',        // JSON
        'meta_keyword',      // JSON
        'meta_description',  // JSON
    ];

    /**
     * Cast JSON fields menjadi array otomatis
     */
    protected $casts = [
        'name' => 'array',
        'description' => 'array',
        'application' => 'array',
        'meta_title' => 'array',
        'meta_keyword' => 'array',
        'meta_description' => 'array',
    ];
}
