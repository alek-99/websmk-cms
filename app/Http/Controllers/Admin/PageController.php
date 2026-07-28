<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\BeritaCategory;
use App\Models\Galeri;
use App\Models\Poster;
// use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $beritas = Berita::where('status', 'published')
            ->where('published_at', '<=', now())
            ->latest()
            ->take(6)
            ->get();

        $featured = Berita::where('status', 'published')
            ->where('is_featured', true)
            ->latest()
            ->first();
        $kategoris = BeritaCategory::latest()->take('5')->get();
        $galeris = Galeri::latest()->get();
         $posters = Poster::where('status', 'aktiv')->latest()->get();


        return view('welcome', compact('beritas', 'featured', 'kategoris', 'galeris','posters'));
    }
    public function register()
    {
        return view('registrasi');
    }
}
