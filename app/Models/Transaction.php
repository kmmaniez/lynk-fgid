<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $with = ['products'];

    protected $fillable = [
        'product_id',
        'duitku_order_id',
        'total_item',
        'total_price',
        'customer_info',
        'payment_method',
        'payment_status',
        'payment_url',
        'transaction_created',
        'transaction_finished',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
