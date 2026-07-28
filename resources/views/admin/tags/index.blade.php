@extends('layouts.admin')
@section('title', 'Management Tag Berita')

@section('content')

<div class="container-fluid mt-4">

    {{-- HEADER --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body text-center bg-light">
            <i class="fa-solid fa-tags fa-2x mb-2 text-primary"></i>
            <h3 class="fw-bold mb-1">Management Tag Berita</h3>
            <p class="text-muted mb-0">Kelola tag untuk mengorganisir topik berita</p>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">

            {{-- SEARCH + CREATE --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <form method="GET" class="d-flex gap-2" style="flex: 1; max-width: 400px;">
                    <input type="text"
                           name="search"
                           class="form-control"
                           placeholder="Cari tag..."
                           value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-search"></i>
                    </button>
                </form>
                <a href="{{ route('admin.tags.create') }}" class="btn btn-success">
                    <i class="fa-solid fa-plus"></i> Tambah Tag
                </a>
            </div>

            {{-- TABLE --}}
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama</th>
                            <th>Slug</th>
                            <th width="10%">Jumlah Berita</th>
                            <th width="12%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tags as $tag)
                        <tr>
                            <td class="text-center">{{ ($tags->currentPage() - 1) * $tags->perPage() + $loop->iteration }}</td>
                            <td>{{ $tag->name }}</td>
                            <td><code>{{ $tag->slug }}</code></td>
                            <td class="text-center">
                                <span class="badge bg-primary">{{ $tag->beritas_count }}</span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.tags.edit', $tag) }}"
                                   class="btn btn-sm btn-primary"
                                   title="Edit">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <form method="POST"
                                      action="{{ route('admin.tags.destroy', $tag) }}"
                                      style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button"
                                            class="btn btn-sm btn-danger"
                                            onclick="confirmDelete(this)"
                                            title="Hapus">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                <i class="fa-solid fa-inbox fa-2x mb-2 d-block"></i>
                                Belum ada tag
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- PAGINATION --}}
            <div class="mt-3 d-flex justify-content-end">
                {{ $tags->links() }}
            </div>

        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function confirmDelete(btn) {
    Swal.fire({
        title: 'Yakin hapus tag ini?',
        text: "Data yang dihapus tidak dapat dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#0d6efd',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            btn.closest('form').submit();
        }
    });
}

@if(session('success'))
Swal.fire({
    icon: 'success',
    title: 'Berhasil!',
    text: "{{ session('success') }}",
    confirmButtonColor: '#198754',
    timer: 2500,
    showConfirmButton: false
});
@endif

@if(session('error'))
Swal.fire({
    icon: 'error',
    title: 'Gagal!',
    text: "{{ session('error') }}",
    confirmButtonColor: '#dc3545'
});
@endif
</script>

@endsection
