@extends('layouts.admin')
@section('title', 'Management Kategori Berita')

@section('content')

<div class="container-fluid mt-4">

    {{-- HEADER --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body text-center bg-light">
            <i class="fa-solid fa-folder fa-2x mb-2 text-primary"></i>
            <h3 class="fw-bold mb-1">Management Kategori Berita</h3>
            <p class="text-muted mb-0">Kelola kategori dan organisasi berita</p>
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
                           placeholder="Cari kategori..."
                           value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-search"></i>
                    </button>
                </form>
                <a href="{{ route('admin.categories.create') }}" class="btn btn-success">
                    <i class="fa-solid fa-plus"></i> Tambah Kategori
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
                            <th width="8%">Warna</th>
                            <th width="8%">Icon</th>
                            <th width="5%">Order</th>
                            <th width="8%">Status</th>
                            <th width="12%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                        <tr>
                            <td class="text-center">{{ ($categories->currentPage() - 1) * $categories->perPage() + $loop->iteration }}</td>
                            <td>{{ $category->name }}</td>
                            <td><code>{{ $category->slug }}</code></td>
                            <td class="text-center">
                                @if($category->color)
                                    <span class="badge" style="background-color: {{ $category->color }}; width: 30px; height: 30px; display: inline-block;"></span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($category->icon)
                                    <i class="{{ $category->icon }}"></i>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="text-center">{{ $category->order }}</td>
                            <td class="text-center">
                                @if($category->is_active)
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-secondary">Nonaktif</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.categories.edit', $category) }}"
                                   class="btn btn-sm btn-primary"
                                   title="Edit">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <form method="POST"
                                      action="{{ route('admin.categories.destroy', $category) }}"
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
                            <td colspan="8" class="text-center text-muted py-4">
                                <i class="fa-solid fa-inbox fa-2x mb-2 d-block"></i>
                                Belum ada kategori
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- PAGINATION --}}
            <div class="mt-3 d-flex justify-content-end">
                {{ $categories->links() }}
            </div>

        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function confirmDelete(btn) {
    Swal.fire({
        title: 'Yakin hapus kategori ini?',
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
