<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payout extends Model
{
    use HasFactory;
    protected $with = ['products'];

    protected $fillable = [
        'transactions_id',
        'product_id',
        'total_item',
        'total_price',
        'is_payout',
    ];


    protected $casts = [
        'total_item' => 'integer',
        'total_price' => 'integer',
        'is_payout' => 'boolean'
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'id','product_id');
    }
}
