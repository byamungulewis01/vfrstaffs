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
        'p_loan',
        'p_interest',
        'remain_interest',
        'posted_by',
        'approved_date',
        'approved_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function posted()
    {
        return $this->belongsTo(User::class, 'posted_by');
    }
    public function approval()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
    public function loan_setting()
    {
        return $this->belongsTo(LoanSetting::class, 'loan_type');
    }
    public function loan_pays()
    {
        return $this->hasMany(LoanPay::class);
    }
    // loan pays approved

}
