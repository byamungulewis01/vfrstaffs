<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VsaAccount extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'amount',
        'type',
        'user_id',
        'source',
        'comment',
        'saving_by',
        'tranking',
        'account_number',
        'isLoan',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
