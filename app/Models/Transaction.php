<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;

class Transaction extends Model
{
    use HasFactory, Prunable;
    protected $with = ['products'];
    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'duitku_order_id',
        'duitku_reference',
        'total_item',
        'total_price',
        'customer_info',
        'payment_method',
        'payment_status',
        'product_file_url',
        'transaction_url_views',
        'transaction_created',
        'transaction_finished',
    ];

    public function prunable()
    {
        return static::where('payment_status','expired');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'id','product_id');
    }
}
