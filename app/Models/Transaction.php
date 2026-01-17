<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'amount',
        'type',   // 'income' or 'expense'
        'source', // 'mpesa' or 'bank'
        'description',
        'date',
    ];  
}
