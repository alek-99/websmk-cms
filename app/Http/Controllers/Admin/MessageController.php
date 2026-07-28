<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ContactMessage;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::latest()->paginate(10);
        return view('admin.messages.index', compact('messages'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_wa' => 'nullable|string|max:20',
            'pesan' => 'required|string',
        ]);

        ContactMessage::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_wa' => $request->no_wa,
            'pesan' => $request->pesan,
        ]);
        return redirect()->back()->with('success', 'Pesan berhasil dikirim!');
    }
    public function show($id)
    {
        $message = ContactMessage::findOrFail($id);
        return view('admin.messages.show', compact('message'));
    }

  public function bulkDelete(Request $request)
{
    if ($request->ids) {
        ContactMessage::whereIn('id', $request->ids)->delete();
    }

    return redirect()->back()->with('success', 'Pesan berhasil dihapus!');
}

}
