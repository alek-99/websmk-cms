@extends('layouts.admin')

@section('title', 'Manajemen Poster')

@section('content')

<div class="p-6">

    {{-- Header --}}
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold">Manajemen Poster</h1>
            <p class="text-gray-500">Kelola data poster website</p>
        </div>

        <button onclick="openModal()"
            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
            + Tambah Poster
        </button>
    </div>

    {{-- Alert --}}
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- Table --}}
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 text-left">No</th>
                    <th class="p-3 text-left">Nama Poster</th>
                    <th class="p-3 text-left">Foto</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($posters as $poster)
                <tr class="border-t">
                    <td class="p-3">{{ $loop->iteration }}</td>

                    <td class="p-3">{{ $poster->nama_poster }}</td>

                    <td class="p-3">
                        <img src="{{ asset('storage/'.$poster->foto) }}"
                             class="w-20 h-12 object-cover rounded">
                    </td>

                    <td class="p-3">
                        <span class="px-2 py-1 text-xs rounded 
                            {{ $poster->status == 'aktiv' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-600' }}">
                            {{ $poster->status }}
                        </span>
                    </td>

                    <td class="p-3 text-center flex justify-center gap-2">

                        {{-- Toggle Status --}}
                        <form action="{{ route('admin.poster.toggle', $poster->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit"
                                class="px-3 py-1 text-xs rounded bg-yellow-400 hover:bg-yellow-500">
                                Toggle
                            </button>
                        </form>

                        {{-- Delete --}}
                        <form action="{{ route('admin.poster.destroy', $poster->id) }}" method="POST"
                              onsubmit="return confirm('Yakin hapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="px-3 py-1 text-xs rounded bg-red-500 text-white hover:bg-red-600">
                                Hapus
                            </button>
                        </form>

                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center p-4 text-gray-500">
                        Data kosong
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- ================= MODAL TAMBAH ================= --}}
<div id="modalTambah" class="fixed inset-0 bg-black bg-opacity-40 hidden justify-center items-center">

    <div class="bg-white w-full max-w-md rounded-lg p-6 shadow-lg">

        <h2 class="text-lg font-bold mb-4">Tambah Poster</h2>

        <form action="{{ route('admin.poster.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="block text-sm">Nama Poster</label>
                <input type="text" name="nama_poster"
                    class="w-full border rounded px-3 py-2 mt-1" required>
            </div>

            <div class="mb-3">
                <label class="block text-sm">Foto</label>
                <input type="file" name="foto"
                    class="w-full border rounded px-3 py-2 mt-1" required>
            </div>

            <div class="mb-3">
                <label class="block text-sm">Status</label>
                <select name="status"
                    class="w-full border rounded px-3 py-2 mt-1">
                    <option value="aktiv">Aktif</option>
                    <option value="nonaktiv">Nonaktif</option>
                </select>
            </div>

            <div class="flex justify-end gap-2 mt-4">
                <button type="button" onclick="closeModal()"
                    class="px-4 py-2 bg-gray-300 rounded">
                    Batal
                </button>

                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Simpan
                </button>
            </div>

        </form>
    </div>
</div>

{{-- ================= SCRIPT ================= --}}
<script>
    function openModal() {
        document.getElementById('modalTambah').classList.remove('hidden');
        document.getElementById('modalTambah').classList.add('flex');
    }

    function closeModal() {
        document.getElementById('modalTambah').classList.remove('flex');
        document.getElementById('modalTambah').classList.add('hidden');
    }
</script>

@endsection