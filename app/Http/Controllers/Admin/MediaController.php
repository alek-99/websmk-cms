<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MediaLibrary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $type = $request->get('type');

        $query = MediaLibrary::query();

        if ($search) {
            $query->where('filename', 'like', "%{$search}%")
                  ->orWhere('alt_text', 'like', "%{$search}%");
        }

        if ($type && in_array($type, ['image', 'video', 'document', 'audio'])) {
            $query->where('type', $type);
        }

        $media = $query->latest()->paginate(20);
        $stats = [
            'total' => MediaLibrary::count(),
            'images' => MediaLibrary::where('type', 'image')->count(),
            'videos' => MediaLibrary::where('type', 'video')->count(),
            'documents' => MediaLibrary::where('type', 'document')->count(),
            'audio' => MediaLibrary::where('type', 'audio')->count(),
            'storage' => $this->getStorageUsage()
        ];

        return view('admin.media.index', compact('media', 'stats', 'type'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:10240', // 10MB max
            'alt_text' => 'nullable|string|max:255'
        ]);

        try {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('media', $filename, 'public');

            // Determine file type
            $mimeType = $file->getMimeType();
            $type = $this->getFileType($mimeType);
            $size = $file->getSize();

            // Create media library record
            $media = MediaLibrary::create([
                'filename' => $filename,
                'filepath' => $path,
                'type' => $type,
                'mime_type' => $mimeType,
                'size' => $size,
                'alt_text' => $request->get('alt_text'),
                'uploaded_by' => Auth::id()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'File berhasil diupload',
                'media' => [
                    'id' => $media->id,
                    'filename' => $media->filename,
                    'url' => asset('storage/' . $media->path),
                    'type' => $media->type,
                    'size' => $this->formatBytes($media->size)
                ]
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupload file: ' . $e->getMessage()
            ], 400);
        }
    }

    public function destroy(MediaLibrary $media)
    {
        try {
            // Delete file from storage
            if (Storage::disk('public')->exists($media->path)) {
                Storage::disk('public')->delete($media->path);
            }

            // Delete database record
            $media->delete();

            return back()->with('success', 'File berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus file: ' . $e->getMessage());
        }
    }

    private function getFileType($mimeType)
    {
        if (strpos($mimeType, 'image') !== false) {
            return 'image';
        } elseif (strpos($mimeType, 'video') !== false) {
            return 'video';
        } elseif (strpos($mimeType, 'audio') !== false) {
            return 'audio';
        } else {
            return 'document';
        }
    }

    private function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, $precision) . ' ' . $units[$i];
    }

    private function getStorageUsage()
    {
        $size = 0;
        $path = storage_path('app/public/media');
        
        if (is_dir($path)) {
            foreach (glob($path . '/*') as $file) {
                if (is_file($file)) {
                    $size += filesize($file);
                }
            }
        }
        
        return $this->formatBytes($size);
    }
}
