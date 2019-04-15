<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function buyers_panel()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);

        return view('dashboard.buyer');
    }

    public function sellers_panel()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);

        if (!$user->seller_panel_enabled) return redirect()->back()->with('error', 'You have to first enable the sellers panel');

        return view('dashboard.seller');
    }
}