<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterPayoutDate extends Model
{
    use HasFactory;

    protected $fillable = [
        'initial_date'
    ];
}
