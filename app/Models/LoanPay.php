<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoanPay extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'amount',
        'interest',
        'comment',
        'status', //requested,approved and rejected,
        'loan_id',
        'penalty',
        'isPartial',
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
