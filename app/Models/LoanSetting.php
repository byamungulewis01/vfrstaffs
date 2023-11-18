<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanSetting extends Model
{
    use HasFactory;
    protected $fillable = ['loan_id', 'name', 'rate', 'user_id'];
}
