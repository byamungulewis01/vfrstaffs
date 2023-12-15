<?php

namespace App\Imports;

use App\Models\Loan;
use App\Models\User;
use App\Models\LoanSetting;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class LoansImport implements ToModel, WithValidation, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $member = User::where('regnumber', $row['regnumber'])->first();
        $loan = LoanSetting::findorfail($row['loan_type']);

        $tt = $row['loan'] * $loan->rate;
        $interest = ($tt / 100) * $row['installement'];
        return new Loan(
            [
                'user_id' => $member->id,
                'loan' => $row['loan'],
                'interest' => $interest,
                'installement' => $row['installement'],
                'comment' => $row['comment'],
                'loan_type' => $row['loan_type'],
            ]
        );
    }
    public function rules(): array
    {
        return [
            'regnumber' => 'required|exists:users,regnumber',
             '*.regnumber' => 'required|exists:users,regnumber',
             'loan' =>'required|min:1|numeric',
             '.loan' =>'required|min:1|numeric',
             'loan_type' =>'required',
             '.loan_type' =>'required',
             'installement' =>'required|numeric|min:1',
             '.installement' =>'required|numeric|min:1',
             'comment' =>'required',
             '.comment' =>'required',
        ];
    }
}
