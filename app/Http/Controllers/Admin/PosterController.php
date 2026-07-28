<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Poster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PosterController extends Controller
{
    public function index()
    {
        $posters = Poster::latest()->get();
        return view('admin.poster.index', compact('posters'));
    }

public function store(Request $request)
{
    $data = $request->validate([
        'nama_poster' => 'required|string|max:255',
        'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        'status' => 'required|in:aktiv,nonaktiv'
    ]);

    $data['foto'] = $request->file('foto')->store('poster', 'public');

    Poster::create($data);

    return back()->with('success', 'Poster berhasil dibuat');
}
public function destroy($id)
{
    $poster = Poster::findOrFail($id);

    if ($poster->foto && Storage::disk('public')->exists($poster->foto)) {
        Storage::disk('public')->delete($poster->foto);
    }

    $poster->delete();

    return back()->with('success', 'Data berhasil dihapus');
}
  public function toggleStatus($id)
{
    $poster = Poster::findOrFail($id);

    $poster->status = $poster->status === 'aktiv'
        ? 'nonaktiv'
        : 'aktiv';

    $poster->save();

    return back()->with('success', 'Status berhasil diubah');
}
}
