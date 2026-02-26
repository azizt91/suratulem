<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Invitation;

class PublicInvitationController extends Controller
{
    public function __construct()
    {
        // Require active subscription to view the invitation
        $this->middleware('check.active.subscription');
    }

    public function show($slug)
    {
        $invitation = Invitation::where('slug', $slug)->firstOrFail();
        
        // Pass data to a default template (or the one selected by the user)
        $templatePath = $invitation->template ? $invitation->template->blade_path : 'invitation.themes.default';
        
        return view($templatePath, compact('invitation'));
    }
}
