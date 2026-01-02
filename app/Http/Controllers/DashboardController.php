<?php

namespace App\Http\Controllers;

use App\Models\Fundraiser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\FundraisingWithdrawal;

class DashboardController extends Controller
{
    //
    public function apply_fundraiser() {
        $user = Auth::user();

        DB::transaction(function () use ($user) {
            
            $validated['user_id'] = $user->id;
            $validated['is_active'] = false;

            Fundraiser::create($validated);
        });

        return redirect()->route('admin.fundraisers.index');
        
    }

    public function my_withdrawals() {
        $user = Auth::user();

        $fundraiserId = $user->fundraiser->id;
        
        $withdrawals = FundraisingWithdrawal::where('fundraiser_id', $fundraiserId)
            ->orderByDesc('id')->get();

        return view('admin.my_withdrawals.index', compact('withdrawals'));
    }

    public function my_withdrawals_detail(FundraisingWithdrawal $fundraisingWithdrawal) {
        
        return view('admin.my_withdrawals.details', compact('fundraisingWithdrawals'));
    }
}