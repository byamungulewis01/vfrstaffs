<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeExpence extends Model
{
    use HasFactory;
    protected $fillable = [
        'amount',
        'type',
        'status', //requested,approved and rejected,
        'user_id',
        'source',
        'comment',
    ];
}
