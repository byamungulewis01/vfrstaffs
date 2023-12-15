<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanTopup extends Model
{
    use HasFactory;
    protected $fillable = [
        'amount',
        'instrument',
        'type',
        'status', //requested,approved and rejected,
        'loan_id',
        'user_id',
    ];
    public function loan()
     {
         return $this->belongsTo(Loan::class);
     }
}
