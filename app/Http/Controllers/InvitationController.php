<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
    public function edit(Invitation $invitation)
    {
        // Must authorize that the user owns this invitation
        if ($invitation->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('invitation.edit', compact('invitation'));
    }

    public function update(Request $request, Invitation $invitation)
    {
        if ($invitation->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'slug' => 'required|string|unique:invitations,slug,' . $invitation->id,
            'data_mempelai' => 'nullable|array',
            'data_acara' => 'nullable|array',
            'data_galeri' => 'nullable|array',
            'data_fitur_tambahan' => 'nullable|array',
            'music_id' => 'nullable|exists:music,id',
        ]);

        $invitation->update([
            'slug' => $request->slug,
            'data_mempelai' => $request->data_mempelai,
            'data_acara' => $request->data_acara,
            'data_galeri' => $request->data_galeri,
            'data_fitur_tambahan' => $request->data_fitur_tambahan,
            'music_id' => $request->music_id,
        ]);

        return redirect()->back()->with('success', 'Undangan berhasil diupdate.');
    }
}
