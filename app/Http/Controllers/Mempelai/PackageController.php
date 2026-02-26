<?php

namespace App\Http\Controllers\Mempelai;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * Display a listing of the active packages for the Mempelai to choose from.
     */
    public function index()
    {
        $packages = Package::where('is_active', true)->get();
        return view('mempelai.paket.index', compact('packages'));
    }
}
