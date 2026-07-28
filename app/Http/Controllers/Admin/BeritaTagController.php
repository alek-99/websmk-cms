<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BeritaTagController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        
        $query = Tag::query();

        if ($search) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('slug', 'like', "%{$search}%");
        }

        $tags = $query->withCount('beritas')->orderBy('name')->paginate(20);

        return view('admin.tags.index', compact('tags'));
    }

    public function create()
    {
        return view('admin.tags.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:tags',
            'slug' => 'nullable|string|max:255|unique:tags'
        ]);

        // Auto generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        Tag::create($validated);

        return redirect()->route('admin.tags.index')
            ->with('success', 'Tag berhasil ditambahkan');
    }

    public function edit(Tag $tag)
    {
        $tag->loadCount('beritas');
        return view('admin.tags.edit', compact('tag'));
    }

    public function update(Request $request, Tag $tag)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:tags,name,' . $tag->id,
            'slug' => 'nullable|string|max:255|unique:tags,slug,' . $tag->id
        ]);

        // Auto generate slug if not provided or changed
        if (empty($validated['slug']) || $validated['slug'] === $tag->slug) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        $tag->update($validated);

        return redirect()->route('admin.tags.index')
            ->with('success', 'Tag berhasil diperbarui');
    }

    public function destroy(Tag $tag)
    {
        try {
            $tag->delete();

            return back()->with('success', 'Tag berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus tag: ' . $e->getMessage());
        }
    }

    public function merge(Request $request)
    {
        $request->validate([
            'source_tag_id' => 'required|exists:tags,id',
            'target_tag_id' => 'required|exists:tags,id|different:source_tag_id'
        ]);

        try {
            $sourceTag = Tag::findOrFail($request->source_tag_id);
            $targetTag = Tag::findOrFail($request->target_tag_id);

            // Move all berita from source to target
            $beritas = $sourceTag->beritas()->pluck('berita_id');
            
            foreach ($beritas as $beritaId) {
                // Detach from source
                $sourceTag->beritas()->detach($beritaId);
                // Attach to target if not already attached
                if (!$targetTag->beritas()->where('berita_id', $beritaId)->exists()) {
                    $targetTag->beritas()->attach($beritaId);
                }
            }

            // Delete source tag
            $sourceTag->delete();

            return back()->with('success', 'Tag berhasil digabungkan');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menggabungkan tag: ' . $e->getMessage());
        }
    }
}
