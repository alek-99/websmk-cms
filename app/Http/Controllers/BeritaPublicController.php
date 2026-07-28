<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\BeritaCategory;
use App\Models\Tag;
use Illuminate\Http\Request;

class BeritaPublicController extends Controller
{
    public function index(Request $request)
    {
        $query = Berita::with(['author', 'categories', 'tags'])
                    ->published();

        // Filter by category
        if ($request->filled('category')) {
            $query->byCategory($request->category);
        }

        // Filter by tag
        if ($request->filled('tag')) {
            $query->byTag($request->tag);
        }

        // Search
        if ($request->filled('q')) {
            $query->search($request->q);
        }

        // Sort
        $sort = $request->get('sort', 'latest');
        switch ($sort) {
            case 'popular':
                $query->popular();
                break;
            case 'oldest':
                $query->oldest('published_at');
                break;
            default:
                $query->latest('published_at');
        }

        $beritas = $query->paginate(12);
        $featured = Berita::published()->featured()->latest('published_at')->first();
        $categories = BeritaCategory::active()->withCount('beritas')->get();
        $popularTags = Tag::withCount('beritas')
                            ->orderByDesc('beritas_count')
                            ->take(10)
                            ->get();

        return view('berita.index', compact(
            'beritas',
            'featured',
            'categories',
            'popularTags'
        ));
    }

    public function show($slug)
    {
        $berita = Berita::with(['author', 'categories', 'tags'])
                    ->where('slug', $slug)
                    ->published()
                    ->firstOrFail();

        // Increment views with session tracking
        if (!session()->has('viewed_berita_' . $berita->id)) {
            $berita->incrementViews();
            session()->put('viewed_berita_' . $berita->id, true);
        }

        // Get related news
        $related = $berita->getRelatedNews(6);

        // Get recent news
        $recent = Berita::published()
                    ->where('id', '!=', $berita->id)
                    ->latest('published_at')
                    ->take(5)
                    ->get();

        return view('berita.show', compact('berita', 'related', 'recent'));
    }

    public function category($slug)
    {
        $category = BeritaCategory::where('slug', $slug)->firstOrFail();
        
        $beritas = Berita::with(['author', 'categories', 'tags'])
                    ->published()
                    ->byCategory($slug)
                    ->latest('published_at')
                    ->paginate(12);

        $categories = BeritaCategory::active()->withCount('beritas')->get();

        return view('berita.category', compact('category', 'beritas', 'categories'));
    }

    public function tag($slug)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();
        
        $beritas = Berita::with(['author', 'categories', 'tags'])
                    ->published()
                    ->byTag($slug)
                    ->latest('published_at')
                    ->paginate(12);

        $popularTags = Tag::withCount('beritas')
                            ->orderByDesc('beritas_count')
                            ->take(10)
                            ->get();

        return view('berita.tag', compact('tag', 'beritas', 'popularTags'));
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        
        $beritas = Berita::with(['author', 'categories', 'tags'])
                    ->published()
                    ->search($query)
                    ->latest('published_at')
                    ->paginate(12);

        return view('berita.search', compact('beritas', 'query'));
    }

    public function share(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);
        $berita->incrementShares();

        return response()->json([
            'success' => true,
            'shares' => $berita->shares
        ]);
    }
}