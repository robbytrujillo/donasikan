<?php

namespace App\Models;

use App\Models\Fundraising;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Donatur extends Model
{
    //
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'phone_number',
        'notes',
        'fundraising_id',
        'total_amount',
        'is_paid',
        'proof',
    ];

    public function fundraising() {
        return $this->belongsTo(Fundraising::class);
    }
}