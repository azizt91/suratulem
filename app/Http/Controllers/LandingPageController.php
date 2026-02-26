<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Template;
use App\Models\Invitation;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        // 1. Fetch active packages for pricing table
        $packages = Package::where('is_active', true)->orderBy('price', 'asc')->get();
        
        // 2. Fetch active templates for showcase grid
        $templates = Template::where('is_active', true)->latest()->take(6)->get(); // Show latest 6 active templates

        // 3. Count total invitations for Social Proof Counter
        $totalInvitations = Invitation::count();

        // Pass variables to welcome.blade.php
        return view('welcome', compact('packages', 'templates', 'totalInvitations'));
    }
}
