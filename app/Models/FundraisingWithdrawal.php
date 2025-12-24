<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FundraisingWithdrawal extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'fundraising_id',
        'fundraiser_id',
        'has_received',
        'has_sent',
        'amount_requested',
        'proof',
        'amount_received',
        'bank_name',
        'bank_account_name',
        'bank_account_number',
    ];
}