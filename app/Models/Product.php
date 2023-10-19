<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, HasUlids;
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

    // protected $casts = [
    //     'min_price' => 'integer',
    //     'min_price' => 'integer',
    // ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
