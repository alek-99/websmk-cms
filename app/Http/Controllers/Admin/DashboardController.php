<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Berita;
use App\Models\BeritaCategory;
use App\Models\Tag;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPesan = ContactMessage::count();
        $totalBerita = Berita::count();
        $totalCategories = BeritaCategory::where('is_active', true)->count();
        $totalTags = Tag::count();
        
        return view('dashboard', compact('totalPesan', 'totalBerita', 'totalCategories', 'totalTags'));
    }
}
