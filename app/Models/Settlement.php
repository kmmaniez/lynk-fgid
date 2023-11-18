<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settlement extends Model
{
    use HasFactory;
    protected $with = ['users'];

    protected $fillable = [
        'users_id',
        'payout_date',
        'payout_amount',
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
