<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TemplateController extends Controller
{
    public function index()
    {
        $templates = Template::latest()->paginate(10);
        return view('admin.templates.index', compact('templates'));
    }

    public function create()
    {
        return view('admin.templates.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:templates,slug',
            'preview_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'blade_path' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
        ]);

        $data = $request->except('preview_image');
        $data['slug'] = $request->slug ? Str::slug($request->slug) : Str::slug($request->name);

        if ($request->hasFile('preview_image')) {
            $path = $request->file('preview_image')->store('templates', 'public');
            $data['preview_image'] = '/storage/' . $path;
        }

        Template::create($data);

        return redirect()->route('admin.templates.index')->with('success', 'Template berhasil ditambahkan.');
    }

    public function edit(Template $template)
    {
        return view('admin.templates.edit', compact('template'));
    }

    public function update(Request $request, Template $template)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:templates,slug,' . $template->id,
            'preview_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'blade_path' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
        ]);

        $data = $request->except('preview_image');
        $data['slug'] = Str::slug($request->slug);

        if ($request->hasFile('preview_image')) {
            // Delete old
            if ($template->preview_image) {
                // Parse the Storage::url string back to a file path
                $oldPath = str_replace('/storage/', '', str_replace(url('/'), '', $template->preview_image));
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }
            $path = $request->file('preview_image')->store('templates', 'public');
            $data['preview_image'] = '/storage/' . $path;
        }

        $template->update($data);

        return redirect()->route('admin.templates.index')->with('success', 'Template berhasil diperbarui.');
    }

    public function destroy(Template $template)
    {
        if ($template->preview_image) {
            $oldPath = str_replace('/storage/', '', str_replace(url('/'), '', $template->preview_image));
            if (Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }
        }
        $template->delete();
        return redirect()->route('admin.templates.index')->with('success', 'Template berhasil dihapus.');
    }

    public function preview($slug)
    {
        $template = Template::where('slug', $slug)->firstOrFail();

        // Dummy data — field names MUST match what each theme blade expects
        $invitation = new \App\Models\Invitation([
            'slug' => 'preview',
            'data_mempelai' => [
                'pria' => [
                    'nama_panggilan' => 'Romeo',
                    'nama_lengkap'   => 'Romeo Montague, S.Kom',
                    'orang_tua'      => 'Bpk. Montague & Ibu Montague',
                    'anak_ke'        => 'Putra Pertama',
                    'instagram'      => 'romeo',
                    'foto'           => 'https://images.unsplash.com/photo-1583939003579-730e3918a45a?q=80&w=400&auto=format&fit=crop',
                ],
                'wanita' => [
                    'nama_panggilan' => 'Juliet',
                    'nama_lengkap'   => 'Juliet Capulet, S.E',
                    'orang_tua'      => 'Bpk. Capulet & Ibu Capulet',
                    'anak_ke'        => 'Putri Kedua',
                    'instagram'      => 'juliet',
                    'foto'           => 'https://images.unsplash.com/photo-1544928147-79a2dbc1f389?q=80&w=400&auto=format&fit=crop',
                ],
            ],
            'data_acara' => [
                'akad' => [
                    'tanggal'       => '2025-12-31',
                    'waktu_mulai'   => '08.00',
                    'waktu_selesai' => '10.00',
                    'lokasi'        => 'Masjid Agung Al-Akbar, Jl. Cinta Damai No. 1',
                    'maps_url'      => '#',
                ],
                'resepsi' => [
                    'tanggal'       => '2025-12-31',
                    'waktu_mulai'   => '11.00',
                    'waktu_selesai' => '14.00',
                    'lokasi'        => 'Gedung Serbaguna Sejahtera, Jl. Bahagia No. 2',
                    'maps_url'      => '#',
                ],
            ],
            'data_galeri' => [
                'foto_1' => 'https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=600&auto=format&fit=crop',
                'foto_2' => 'https://images.unsplash.com/photo-1522673607200-164d1b6ce486?q=80&w=600&auto=format&fit=crop',
                'foto_3' => 'https://images.unsplash.com/photo-1583939003579-730e3918a45a?q=80&w=400&auto=format&fit=crop',
                'foto_4' => 'https://images.unsplash.com/photo-1544928147-79a2dbc1f389?q=80&w=400&auto=format&fit=crop',
            ],
            'data_fitur_tambahan' => [
                'quotes' => '"Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu sendiri..." (Ar-Rum: 21)',
                'amplop_digital' => [
                    ['bank' => 'BCA', 'nomor' => '1234567890', 'nama' => 'Romeo Montague'],
                    ['bank' => 'Mandiri', 'nomor' => '0987654321', 'nama' => 'Juliet Capulet'],
                ],
                'alamat_hadiah' => 'Jl. Cinta Damai No. 1, Kota Bahagia',
            ],
        ]);

        // Prevent guestbook / music errors on non-persisted model
        $invitation->id = null;
        $invitation->setRelation('guestbooks', collect([]));
        $invitation->setRelation('music', null);

        return view($template->blade_path, compact('invitation'));
    }
}
