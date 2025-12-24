<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Donatur extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'name',
        'phone_number',
        'notes',
        'fundraising_id',
        'total_amount',
        'is_paid',
        'proof',
    ];
}