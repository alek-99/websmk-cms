@extends('layouts.admin')

@section('title', 'Galeri Kegiatan')

@section('content')
    <div class="container mx-auto px-4 py-6">

        {{-- Header --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-700">Galeri Kegiatan</h1>
            <button onclick="openModal()" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg shadow">
                + Tambah Galeri
            </button>
        </div>

        {{-- Alert --}}
        @if (session('success'))
            <div class="mb-4 bg-green-100 text-green-700 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Table --}}
        <div class="bg-white rounded-xl shadow overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-100 text-gray-600">
                    <tr>
                        <th class="p-3 text-left">Nama Kegiatan</th>
                        <th class="p-3 text-left">Media</th>
                        <th class="p-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($galeris as $galeri)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-3 font-medium text-gray-700">
                                {{ $galeri->nama_kegiatan }}
                            </td>

                            <td class="p-3">
                                @if (Str::contains($galeri->media, 'video'))
                                    <video controls src="{{ asset('storage/' . $galeri->media) }}"></video>
                                @else
                                    <img src="{{ asset('storage/' . $galeri->media) }}">
                                @endif

                            </td>

                            <td class="p-3 text-center">
                                <button onclick="hapusData({{ $galeri->id }})"
                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-lg text-xs">
                                    Hapus
                                </button>

                                <form id="form-hapus-{{ $galeri->id }}"
                                    action="{{ route('admin.galeri.destroy', $galeri->id) }}" method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="p-4 text-center text-gray-500">
                                Data galeri belum tersedia
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- MODAL INPUT --}}
    <div id="modalGaleri" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl w-full max-w-lg p-6 animate-fade-in">

            <h2 class="text-xl font-semibold mb-4">Tambah Galeri</h2>

            <form id="formGaleri" action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="text-sm font-medium">Nama Kegiatan</label>
                    <input type="text" name="nama_kegiatan" required
                        class="w-full border rounded-lg px-3 py-2 mt-1 focus:ring focus:ring-indigo-200">
                </div>

             <input type="file" 
       id="mediaInput" 
       name="media" 
       accept="image/*,video/*" 
       required 
       onchange="previewMedia(event)">

<input type="hidden" name="media_compressed" id="mediaCompressed">

<div id="progressBox" class="hidden mt-3">
    <div class="text-sm text-gray-600 mb-1">Mengompres video...</div>
    <div class="w-full bg-gray-200 rounded-full h-2">
        <div id="progressBar" class="bg-indigo-600 h-2 rounded-full" style="width:0%"></div>
    </div>
</div>


                {{-- Preview --}}
                <div id="previewBox" class="hidden mb-4">
                    <p class="text-xs text-gray-500 mb-1">Preview:</p>
                    <img id="previewImg" class="w-full h-48 object-cover rounded-lg hidden">
                    <video id="previewVideo" class="w-full h-48 rounded-lg hidden" controls></video>
                </div>

                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-200 rounded-lg">
                        Batal
                    </button>

                    <button id="btnSimpan" type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- SCRIPT --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/@ffmpeg/ffmpeg@0.12.6/dist/ffmpeg.min.js"></script>

    <script>
        function openModal() {
            const modal = document.getElementById('modalGaleri');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeModal() {
            document.getElementById('modalGaleri').classList.add('hidden');
        }

        function previewMedia(event) {
            const file = event.target.files[0];
            const previewBox = document.getElementById('previewBox');
            const img = document.getElementById('previewImg');
            const video = document.getElementById('previewVideo');

            previewBox.classList.remove('hidden');
            img.classList.add('hidden');
            video.classList.add('hidden');

            if (file.type.startsWith('image')) {
                img.src = URL.createObjectURL(file);
                img.classList.remove('hidden');
            } else if (file.type.startsWith('video')) {
                video.src = URL.createObjectURL(file);
                video.classList.remove('hidden');
            }
        }

        document.getElementById('formGaleri').addEventListener('submit', function() {
            const btn = document.getElementById('btnSimpan');
            btn.disabled = true;
            btn.innerText = 'Menyimpan...';
        });

        function hapusData(id) {
            Swal.fire({
                title: 'Yakin?',
                text: 'Media galeri akan dihapus permanen!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('form-hapus-' + id).submit();
                }
            });
        }
  

//  Script kompres vidio
const { createFFmpeg, fetchFile } = FFmpeg;
const ffmpeg = createFFmpeg({ log: true });

const input = document.getElementById('mediaInput');
const progressBox = document.getElementById('progressBox');
const progressBar = document.getElementById('progressBar');

input.addEventListener('change', async function () {
    const file = this.files[0];
    if (!file) return;

    // JIKA FOTO → LANGSUNG SUBMIT
    if (file.type.startsWith('image/')) {
        const form = document.getElementById('formGaleri');
        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(file);
        input.files = dataTransfer.files;
        return;
    }

    // JIKA VIDEO → COMPRESS
    progressBox.classList.remove('hidden');

    if (!ffmpeg.isLoaded()) {
        await ffmpeg.load();
    }

    ffmpeg.setProgress(({ ratio }) => {
        progressBar.style.width = Math.round(ratio * 100) + '%';
    });

    ffmpeg.FS('writeFile', 'input.mp4', await fetchFile(file));

    await ffmpeg.run(
        '-i', 'input.mp4',
        '-vf', 'scale=-2:720',
        '-preset', 'fast',
        '-movflags', '+faststart',
        'output.mp4'
    );

    const data = ffmpeg.FS('readFile', 'output.mp4');
    const compressedFile = new File(
        [data.buffer],
        'video_720p.mp4',
        { type: 'video/mp4' }
    );

    const dataTransfer = new DataTransfer();
    dataTransfer.items.add(compressedFile);
    input.files = dataTransfer.files;

    progressBox.classList.add('hidden');
});
</script>

@endsection
