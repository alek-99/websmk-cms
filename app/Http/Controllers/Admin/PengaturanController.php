<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaturan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengaturanController extends Controller
{
public function index()
    {
        $pengaturan = Pengaturan::first();
        return view('admin.pengaturan.index', compact('pengaturan'));
    }
 
    public function create()
    {
        return view('admin.pengaturan.create');
    }
 
    public function store(Request $request)
    {
        $validated = $request->validate([
            // Hero Section
            'foto_utama'             => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'judul_utama'            => 'required|string|max:255',
            'sub_judul'              => 'required|string|max:255',
            'deskripsi_judul'        => 'required|string|max:255',
            // About
            'foto_about'             => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'judul_about'            => 'required|string|max:255',
            'text_about'             => 'required|string',
            // Statistik
            'tahun_berpengalaman'    => 'required|integer|min:0',
            'tenaga_pengajar'        => 'required|integer|min:0',
            'murid_aktiv'            => 'required|integer|min:0',
            'alumni_penerimaBeasiswa'=> 'required|integer|min:0',
            // Medsos
            'link_fb'                => 'nullable|url|max:255',
            'link_wa'                => 'nullable|string|max:255',
            'link_instagram'         => 'nullable|url|max:255',
            'link_youtube'           => 'nullable|url|max:255',
            // Kontak
            'alamat'                 => 'required|string|max:255',
            'no_wa'                  => 'required|string|max:20',
            'email'                  => 'required|email|max:255',
            'jam_operasional'        => 'required|string|max:255',
        ]);
 
        $validated['foto_utama'] = $request->file('foto_utama')->store('pengaturan', 'public');
        $validated['foto_about'] = $request->file('foto_about')->store('pengaturan', 'public');
 
        Pengaturan::create($validated);
 
        return redirect()->route('admin.pengaturan.index')
            ->with('success', 'Pengaturan berhasil disimpan.');
    }
 
    public function edit(Pengaturan $pengaturan)
    {
        return view('admin.pengaturan.edit', compact('pengaturan'));
    }
 
    public function update(Request $request, Pengaturan $pengaturan)
    {
        $validated = $request->validate([
            // Hero Section
            'foto_utama'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'judul_utama'            => 'required|string|max:255',
            'sub_judul'              => 'required|string|max:255',
            'deskripsi_judul'        => 'required|string|max:255',
            // About
            'foto_about'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'judul_about'            => 'required|string|max:255',
            'text_about'             => 'required|string',
            // Statistik
            'tahun_berpengalaman'    => 'required|integer|min:0',
            'tenaga_pengajar'        => 'required|integer|min:0',
            'murid_aktiv'            => 'required|integer|min:0',
            'alumni_penerimaBeasiswa'=> 'required|integer|min:0',
            // Medsos
            'link_fb'                => 'nullable|url|max:255',
            'link_wa'                => 'nullable|string|max:255',
            'link_instagram'         => 'nullable|url|max:255',
            'link_youtube'           => 'nullable|url|max:255',
            // Kontak
            'alamat'                 => 'required|string|max:255',
            'no_wa'                  => 'required|string|max:20',
            'email'                  => 'required|email|max:255',
            'jam_operasional'        => 'required|string|max:255',
        ]);
 
        if ($request->hasFile('foto_utama')) {
            Storage::disk('public')->delete($pengaturan->foto_utama);
            $validated['foto_utama'] = $request->file('foto_utama')->store('pengaturan', 'public');
        }
 
        if ($request->hasFile('foto_about')) {
            Storage::disk('public')->delete($pengaturan->foto_about);
            $validated['foto_about'] = $request->file('foto_about')->store('pengaturan', 'public');
        }
 
        $pengaturan->update($validated);
 
        return redirect()->route('admin.pengaturan.index')
            ->with('success', 'Pengaturan berhasil diperbarui.');
    }
 
    public function destroy(Pengaturan $pengaturan)
    {
        Storage::disk('public')->delete($pengaturan->foto_utama);
        Storage::disk('public')->delete($pengaturan->foto_about);
        $pengaturan->delete();
 
        return redirect()->route('admin.pengaturan.index')
            ->with('success', 'Pengaturan berhasil dihapus.');
    }
}
