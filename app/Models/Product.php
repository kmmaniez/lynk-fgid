<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $with = ['users'];

    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'thumbnail',
        'images',
        'description',
        'url',
        'min_price',
        'max_price',
        'messages',
        'CTA',
        'layout',
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
