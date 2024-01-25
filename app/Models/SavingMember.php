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
        'approved_by',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function approval()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
    public function _saving()
    {
        return $this->hasOne(Saving::class, 'id', 'saving_id');
    }
}
