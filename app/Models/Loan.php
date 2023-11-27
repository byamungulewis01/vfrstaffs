<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;
    protected $fillable = [
        'loan',
        'interest',
        'installement',
        'comment',
        'loan_status',
        'status',
        'user_id',
        'loan_type',
    ];

    public function user()
     {
         return $this->belongsTo(User::class);
     }
    public function loan_setting()
     {
         return $this->belongsTo(LoanSetting::class,'loan_type');
     }
    public function loan_pays()
    {
         return $this->hasMany(LoanPay::class);
    }
    // loan pays approved

}
