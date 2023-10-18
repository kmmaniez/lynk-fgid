<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'total_item',
        'customer_email',
        'payment_options',
        'payment_status',
        'date_transaction',
    ];
}
