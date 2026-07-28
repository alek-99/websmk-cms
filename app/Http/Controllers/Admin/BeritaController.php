<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\BeritaCategory;
use App\Models\BeritaTag;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $query = Berita::with(['author', 'categories', 'tags'])
                       ->withCount('analytics');

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->byCategory($request->category);
        }

        // Filter by author
        if ($request->filled('author')) {
            $query->where('author_id', $request->author);
        }

        // Search
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Sort
        $sortBy = $request->get('sort', 'created_at');
        $sortOrder = $request->get('order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $beritas = $query->latest()->paginate(15);
        $categories = BeritaCategory::active()->get();
        $tags = Tag::orderBy('name')->get();

        return view('admin.berita.index', compact('beritas', 'categories', 'tags'));
    }

    public function create()
    {
        $categories = BeritaCategory::active()->get();
        $tags = Tag::orderBy('name')->get();
        
        return view('admin.berita.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'excerpt' => 'nullable|max:500',
            'featured_image' => 'nullable|image|max:2048',
            'featured_image_alt' => 'nullable|string',
            'meta_title' => 'nullable|max:60',
            'meta_description' => 'nullable|max:155',
            'meta_keywords' => 'nullable|string',
            'status' => 'required|in:draft,published',
            'scheduled_at' => 'nullable|date|after:now',
            'is_featured' => 'boolean',
            'categories' => 'array',
            'categories.*' => 'exists:berita_categories,id',
            'tags' => 'nullable|string'
        ]);

        DB::beginTransaction();
        try {
            // Handle image upload
            if ($request->hasFile('featured_image')) {
                $validated['featured_image'] = $request->file('featured_image')
                    ->store('berita/images', 'public');
            }

            // Create berita
            $berita = Berita::create($validated);

            // Attach categories
            if ($request->filled('categories')) {
                $berita->categories()->attach($request->categories);
            }

            // Handle tags
            if ($request->filled('tags')) {
                $tagNames = array_map('trim', explode(',', $request->tags));
                $tagIds = [];

                foreach ($tagNames as $tagName) {
                    if (!empty($tagName)) {
                        $tag = Tag::firstOrCreate(
                            ['name' => $tagName],
                            ['slug' => Str::slug($tagName)]
                        );
                        $tagIds[] = $tag->id;
                    }
                }

                $berita->tags()->attach($tagIds);
            }

            DB::commit();

            return redirect()->route('admin.berita.index')
                ->with('success', 'Berita berhasil ditambahkan');

        } catch (\Exception $e) {
            DB::rollBack();
            
            // Delete uploaded image if exists
            if (isset($validated['featured_image'])) {
                Storage::disk('public')->delete($validated['featured_image']);
            }

            return back()->withInput()
                ->with('error', 'Gagal menyimpan berita: ' . $e->getMessage());
        }
    }

    public function edit(Berita $beritum)
    {
        $beritum->load(['categories', 'tags']);
        $categories = BeritaCategory::active()->get();
        $tags = Tag::orderBy('name')->get();
        
        return view('admin.berita.edit', compact('beritum', 'categories'));
    }

    public function update(Request $request, Berita $beritum)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'excerpt' => 'nullable|max:500',
            'featured_image' => 'nullable|image|max:2048',
            'featured_image_alt' => 'nullable|string',
            'meta_title' => 'nullable|max:60',
            'meta_description' => 'nullable|max:155',
            'meta_keywords' => 'nullable|string',
            'status' => 'required|in:draft,published',
            'scheduled_at' => 'nullable|date',
            'is_featured' => 'boolean',
            'categories' => 'array',
            'categories.*' => 'exists:berita_categories,id',
            'tags' => 'nullable|string'
        ]);

        DB::beginTransaction();
        try {
            // Handle image upload
            if ($request->hasFile('featured_image')) {
                // Delete old image
                if ($beritum->featured_image) {
                    Storage::disk('public')->delete($beritum->featured_image);
                }

                $validated['featured_image'] = $request->file('featured_image')
                    ->store('berita/images', 'public');
            }

            // Set editor
            $validated['editor_id'] = Auth::id();

            // Update berita
            $beritum->update($validated);

            // Sync categories
            if ($request->has('categories')) {
                $beritum->categories()->sync($request->categories);
            } else {
                $beritum->categories()->detach();
            }

            // Handle tags
            if ($request->filled('tags')) {
                $tagNames = array_map('trim', explode(',', $request->tags));
                $tagIds = [];

                foreach ($tagNames as $tagName) {
                    if (!empty($tagName)) {
                        $tag = Tag::firstOrCreate(
                            ['name' => $tagName],
                            ['slug' => Str::slug($tagName)]
                        );
                        $tagIds[] = $tag->id;
                    }
                }

                $beritum->tags()->sync($tagIds);
            } else {
                $beritum->tags()->detach();
            }

            DB::commit();

            return redirect()->route('admin.berita.index')
                ->with('success', 'Berita berhasil diperbarui');

        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withInput()
                ->with('error', 'Gagal memperbarui berita: ' . $e->getMessage());
        }
    }

    public function destroy(Berita $beritum)
    {
        try {
            // Delete image
            if ($beritum->featured_image) {
                Storage::disk('public')->delete($beritum->featured_image);
            }

            $beritum->delete();

            return back()->with('success', 'Berita berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus berita: ' . $e->getMessage());
        }
    }

    public function show($slug)
    {
        $berita = Berita::with(['author', 'categories', 'tags'])
                    ->where('slug', $slug)
                    ->published()
                    ->firstOrFail();

        // Increment views
        $berita->incrementViews();

        // Get related news
        $related = $berita->getRelatedNews(3);

        // Get recent news
        $recent = Berita::published()
                    ->where('id', '!=', $berita->id)
                    ->latest('published_at')
                    ->take(5)
                    ->get();

        return view('berita.show', compact('berita', 'related', 'recent'));
    }

    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:publish,draft,delete,feature,unfeature',
            'ids' => 'required|array',
            'ids.*' => 'exists:beritas,id'
        ]);

        $beritas = Berita::whereIn('id', $request->ids);

        switch ($request->action) {
            case 'publish':
                $beritas->update([
                    'status' => 'published',
                    'published_at' => now()
                ]);
                $message = 'Berita berhasil dipublish';
                break;

            case 'draft':
                $beritas->update(['status' => 'draft']);
                $message = 'Berita berhasil dijadikan draft';
                break;

            case 'feature':
                $beritas->update(['is_featured' => true]);
                $message = 'Berita berhasil dijadikan unggulan';
                break;

            case 'unfeature':
                $beritas->update(['is_featured' => false]);
                $message = 'Berita berhasil dihapus dari unggulan';
                break;

            case 'delete':
                foreach ($beritas->get() as $berita) {
                    if ($berita->featured_image) {
                        Storage::disk('public')->delete($berita->featured_image);
                    }
                    $berita->delete();
                }
                $message = 'Berita berhasil dihapus';
                break;
        }

        return back()->with('success', $message);
    }

    public function analytics(Berita $beritum)
    {
        $analytics = $beritum->analytics()
                    ->orderBy('date', 'desc')
                    ->take(30)
                    ->get();

        $totalViews = $analytics->sum('views');
        $totalShares = $analytics->sum('shares');
        $avgReadingTime = $analytics->avg('avg_reading_time');

        return view('admin.berita.analytics', compact(
            'beritum',
            'analytics',
            'totalViews',
            'totalShares',
            'avgReadingTime'
        ));
    }

    public function duplicate(Berita $beritum)
    {
        DB::beginTransaction();
        try {
            $newBerita = $beritum->replicate();
            $newBerita->title = $beritum->title . ' (Copy)';
            $newBerita->slug = Str::slug($newBerita->title);
            $newBerita->status = 'draft';
            $newBerita->published_at = null;
            $newBerita->views = 0;
            $newBerita->save();

            // Sync relationships
            $newBerita->categories()->sync($beritum->categories->pluck('id'));
            $newBerita->tags()->sync($beritum->tags->pluck('id'));

            DB::commit();

            return redirect()->route('admin.berita.edit', $newBerita->id)
                ->with('success', 'Berita berhasil diduplikasi');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menduplikasi berita: ' . $e->getMessage());
        }
    }
}