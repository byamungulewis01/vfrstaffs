<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavingMember extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'saving_id',
        'amount',
        'comment',
        'status',
        'type',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function _saving()
    {
        return $this->hasOne(Saving::class, 'id','saving_id');
    }
}
