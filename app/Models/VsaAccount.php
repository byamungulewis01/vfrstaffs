<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VsaAccount extends Model
{
    use HasFactory;
    protected $fillable = [
        'amount',
        'type',
        'user_id',
        'source',
        'comment',
        'saving_by',
    ];
}
