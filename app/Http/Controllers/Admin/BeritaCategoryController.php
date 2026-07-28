<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BeritaCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BeritaCategoryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        
        $query = BeritaCategory::query();

        if ($search) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('slug', 'like', "%{$search}%");
        }

        $categories = $query->orderBy('order')->paginate(20);

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:berita_categories',
            'slug' => 'nullable|string|max:255|unique:berita_categories',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:7',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean'
        ]);

        // Auto generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        BeritaCategory::create($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori berita berhasil ditambahkan');
    }

    public function edit(BeritaCategory $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, BeritaCategory $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:berita_categories,name,' . $category->id,
            'slug' => 'nullable|string|max:255|unique:berita_categories,slug,' . $category->id,
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:7',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean'
        ]);

        // Auto generate slug if not provided or changed
        if (empty($validated['slug']) || $validated['slug'] === $category->slug) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        $category->update($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori berita berhasil diperbarui');
    }

    public function destroy(BeritaCategory $category)
    {
        try {
            // Check if category has beritas
            if ($category->beritas()->count() > 0) {
                return back()->with('error', 'Tidak dapat menghapus kategori yang memiliki berita');
            }

            $category->delete();

            return back()->with('success', 'Kategori berita berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus kategori: ' . $e->getMessage());
        }
    }

    public function reorder(Request $request)
    {
        $validated = $request->validate([
            'items' => 'required|array',
            'items.*' => 'exists:berita_categories,id'
        ]);

        foreach ($validated['items'] as $order => $id) {
            BeritaCategory::where('id', $id)->update(['order' => $order]);
        }

        return response()->json(['message' => 'Urutan kategori berhasil diperbarui']);
    }
}
