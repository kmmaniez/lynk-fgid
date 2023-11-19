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
        'recommend_price',
        'messages',
        'cta_text',
        'layout',
    ];

    protected $casts = [
        'type' => ProductTypeEnum::class,
        'cta_text' => CtaEnum::class,
        'layout' => LayoutEnum::class,
        'min_price' => 'integer',
        'recommend_price' => 'integer',
        'images' => 'array',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'products_id','id');
    }

    public function payouts()
    {
        return $this->belongsTo(Payout::class, 'id', 'product_id');
    }
}
