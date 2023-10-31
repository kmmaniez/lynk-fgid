<?php

namespace App\Models;

use App\Enums\CtaEnum;
use App\Enums\LayoutEnum;
use App\Enums\ProductTypeEnum;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, HasUlids;
    protected $with = ['users','transactions'];

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
        'cta_text' => CtaEnum::class,
        'layout' => LayoutEnum::class,
        'min_price' => 'integer',
        'max_price' => 'integer',
        'images' => 'array',
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return $this->belongsTo(Transaction::class);
    }
}
