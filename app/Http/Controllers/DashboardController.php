<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->hasRole('admin')) {
            $totalRevenue = \App\Models\Payment::where('status', 'paid')->sum('amount');
            $totalUsers = \App\Models\User::whereHas('roles', fn($q) => $q->where('name', 'mempelai'))->count();
            $totalInvitations = \App\Models\Invitation::count();
            return view('admin.dashboard.index', compact('totalRevenue', 'totalUsers', 'totalInvitations'));
        }

        $invitation = \App\Models\Invitation::with('guestbooks')->where('user_id', $user->id)->first();
        return view('mempelai.dashboard.index', compact('invitation'));
    }
}
