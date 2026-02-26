<?php

namespace App\Http\Controllers;

use App\Models\Guestbook;
use App\Models\Invitation;
use Illuminate\Http\Request;

class GuestbookController extends Controller
{
    public function store(Request $request, Invitation $invitation)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:attending,not_attending',
            'jumlah_tamu' => 'required|integer|min:1|max:10',
            'message' => 'nullable|string|max:1000',
        ]);

        $invitation->guestbooks()->create([
            'name' => $request->name,
            'status' => $request->status,
            'jumlah_tamu' => $request->jumlah_tamu,
            'message' => $request->message,
        ]);

        return back()->withFragment('rsvp-section')->with('success_rsvp', 'Terima kasih telah mengonfirmasi kehadiran Anda!');
    }
}
