<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'admin_id',
        'description',
        'price',
        'photo_url',
        'display_start',
        'display_end',
        'status',
        'stock'
    ];

    protected $casts = [
        'display_start' => 'datetime',
        'display_end' => 'datetime',
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
