<?php

namespace App\Http\Controllers\Admin;

use App\Models\Galeri;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index()
    {
        $galeris = Galeri::latest()->get();
        return view('admin.galeri.index', compact('galeris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'media' => 'required|file|max:51200', // 50MB (AMAN)
        ]);

        $file = $request->file('media');

        // Simpan berdasarkan tipe
        if (str_starts_with($file->getMimeType(), 'image/')) {
            $path = $file->store('galeri/foto', 'public');
        } else {
            $path = $file->store('galeri/video', 'public');
        }

        Galeri::create([
            'nama_kegiatan' => $request->nama_kegiatan,
            'media' => $path,
        ]);

        return redirect()
            ->route('admin.galeri.index')
            ->with('success', 'Galeri berhasil ditambahkan');
    }

    /**
     * DELETE GALERI
     */
    public function destroy($id)
    {
        $galeri = Galeri::findOrFail($id);

        // Hapus file dari storage
        if ($galeri->media && Storage::disk('public')->exists($galeri->media)) {
            Storage::disk('public')->delete($galeri->media);
        }

        // Hapus data dari database
        $galeri->delete();

        return redirect()
            ->route('admin.galeri.index')
            ->with('success', 'Galeri berhasil dihapus');
    }
}
