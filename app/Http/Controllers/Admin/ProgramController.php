<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::latest()->paginate(10);
        return view('admin.program.index', compact('programs'));
    }

    public function create()
    {
        return view('admin.program.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'icon'      => 'required|image|mimes:jpg,jpeg,png,webp,svg|max:1024',
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        $validated['icon'] = $request->file('icon')->store('programs', 'public');

        Program::create($validated);

        return redirect()->route('admin.program.index')
            ->with('success', 'Program berhasil ditambahkan.');
    }

    public function show(Program $program)
    {
        return view('admin.program.show', compact('program'));
    }

    public function edit(Program $program)
    {
        return view('admin.program.edit', compact('program'));
    }

    public function update(Request $request, Program $program)
    {
        $validated = $request->validate([
            'icon'      => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:1024',
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        if ($request->hasFile('icon')) {
            Storage::disk('public')->delete($program->icon);
            $validated['icon'] = $request->file('icon')->store('programs', 'public');
        }

        $program->update($validated);

        return redirect()->route('admin.program.index')
            ->with('success', 'Program berhasil diperbarui.');
    }

    public function destroy(Program $program)
    {
        Storage::disk('public')->delete($program->icon);
        $program->delete();

        return redirect()->route('admin.program.index')
            ->with('success', 'Program berhasil dihapus.');
    }
}