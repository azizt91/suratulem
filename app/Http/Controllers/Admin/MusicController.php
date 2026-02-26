<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Music;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MusicController extends Controller
{
    public function index()
    {
        $music = Music::latest()->paginate(10);
        return view('admin.music.index', compact('music'));
    }

    public function create()
    {
        return view('admin.music.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'file_path' => 'required|file|mimes:mp3|max:10240',
            'is_active' => 'boolean',
        ]);

        $data = $request->except('file_path');

        if ($request->hasFile('file_path')) {
            $path = $request->file('file_path')->store('music', 'public');
            $data['file_path'] = Storage::url($path);
        }

        $data['is_active'] = $request->has('is_active');

        Music::create($data);

        return redirect()->route('admin.music.index')->with('success', 'Musik berhasil ditambahkan.');
    }

    public function edit(Music $music)
    {
        return view('admin.music.edit', compact('music'));
    }

    public function update(Request $request, Music $music)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'file_path' => 'nullable|file|mimes:mp3|max:10240',
            'is_active' => 'boolean',
        ]);

        $data = $request->except('file_path');

        if ($request->hasFile('file_path')) {
            if ($music->file_path) {
                $oldPath = str_replace('/storage/', '', str_replace(url('/'), '', $music->file_path));
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }
            $path = $request->file('file_path')->store('music', 'public');
            $data['file_path'] = Storage::url($path);
        }

        $data['is_active'] = $request->has('is_active');

        $music->update($data);

        return redirect()->route('admin.music.index')->with('success', 'Musik berhasil diperbarui.');
    }

    public function destroy(Music $music)
    {
        if ($music->file_path) {
            $oldPath = str_replace('/storage/', '', str_replace(url('/'), '', $music->file_path));
            if (Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }
        }
        $music->delete();
        return redirect()->route('admin.music.index')->with('success', 'Musik berhasil dihapus.');
    }
}
