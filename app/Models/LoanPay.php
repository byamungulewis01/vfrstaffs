<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LoanPay extends Model
{
    use HasFactory;
    protected $fillable = [
        'amount',
        'interest',
        'comment',
        'status', //requested,approved and rejected,
        'loan_id',
        'approved_by',

    ];
    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }
    public function approval()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
