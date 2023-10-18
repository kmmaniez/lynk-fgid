<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    use HasFactory;
    protected $with = ['users'];

    protected $fillable = [
        'user_id',
        'bank_name',
        'bank_number',
        'bank_account_name',
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
