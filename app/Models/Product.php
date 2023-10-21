<?php

namespace App\Models;

use App\Enums\ProductTypeEnum;
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
        'type',
        'slug',
        'thumbnail',
        'images',
        'description',
        'url',
        'min_price',
        'max_price',
        'messages',
        'cta_text',
        'layout',
    ];

    protected $casts = [
        'type' => ProductTypeEnum::class,
        'min_price' => 'integer',
        'max_price' => 'integer',
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
