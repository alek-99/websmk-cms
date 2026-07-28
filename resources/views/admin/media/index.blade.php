@extends('layouts.admin')
@section('title', 'Media Library')

@section('content')

<div class="container-fluid mt-4">

    {{-- HEADER --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body text-center bg-light">
            <i class="fa-solid fa-image fa-2x mb-2 text-primary"></i>
            <h3 class="fw-bold mb-1">Media Library</h3>
            <p class="text-muted mb-0">Kelola media dan file upload Anda</p>
        </div>
    </div>

    {{-- STATISTICS --}}
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="fa-solid fa-folder fa-2x text-primary mb-2"></i>
                    <h5 class="card-title text-muted mb-1">Total File</h5>
                    <h3 class="fw-bold">{{ $stats['total'] }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="fa-solid fa-image fa-2x text-success mb-2"></i>
                    <h5 class="card-title text-muted mb-1">Gambar</h5>
                    <h3 class="fw-bold">{{ $stats['images'] }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="fa-solid fa-video fa-2x text-danger mb-2"></i>
                    <h5 class="card-title text-muted mb-1">Video</h5>
                    <h3 class="fw-bold">{{ $stats['videos'] }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="fa-solid fa-hard-drive fa-2x text-warning mb-2"></i>
                    <h5 class="card-title text-muted mb-1">Storage</h5>
                    <h3 class="fw-bold">{{ $stats['storage'] }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        {{-- UPLOAD SECTION --}}
        <div class="col-lg-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title fw-bold mb-3">
                        <i class="fa-solid fa-cloud-arrow-up"></i> Upload File
                    </h5>
                    <form id="uploadForm" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="file" class="form-label fw-bold">Pilih File</label>
                            <input type="file"
                                   class="form-control"
                                   id="file"
                                   name="file"
                                   accept="image/*,video/*,.pdf,.doc,.docx"
                                   required>
                            <small class="text-muted">Maksimal 10MB</small>
                        </div>

                        <div class="mb-3">
                            <label for="alt_text" class="form-label fw-bold">Alt Text <small class="text-muted">(opsional)</small></label>
                            <input type="text"
                                   class="form-control"
                                   id="alt_text"
                                   name="alt_text"
                                   placeholder="Deskripsi gambar...">
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fa-solid fa-upload"></i> Upload
                        </button>
                    </form>

                    <div id="uploadProgress" class="mt-3" style="display:none;">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated"
                                 id="progressBar"
                                 role="progressbar"
                                 style="width: 0%">
                            </div>
                        </div>
                        <small class="text-muted" id="progressText">Uploading...</small>
                    </div>
                </div>
            </div>
        </div>

        {{-- FILES LIST SECTION --}}
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title fw-bold mb-3">
                        <i class="fa-solid fa-list"></i> File
                    </h5>

                    {{-- SEARCH + FILTER --}}
                    <div class="d-flex gap-2 mb-3">
                        <form method="GET" class="d-flex gap-2 flex-grow-1">
                            <input type="text"
                                   name="search"
                                   class="form-control"
                                   placeholder="Cari file..."
                                   value="{{ request('search') }}">
                            <select name="type" class="form-select" style="max-width: 150px;">
                                <option value="">Semua Tipe</option>
                                <option value="image" {{ request('type') === 'image' ? 'selected' : '' }}>Gambar</option>
                                <option value="video" {{ request('type') === 'video' ? 'selected' : '' }}>Video</option>
                                <option value="document" {{ request('type') === 'document' ? 'selected' : '' }}>Dokumen</option>
                                <option value="audio" {{ request('type') === 'audio' ? 'selected' : '' }}>Audio</option>
                            </select>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa-solid fa-search"></i>
                            </button>
                        </form>
                    </div>

                    {{-- TABLE --}}
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>File</th>
                                    <th width="10%">Tipe</th>
                                    <th width="10%">Ukuran</th>
                                    <th width="15%">Upload</th>
                                    <th width="10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($media as $file)
                                <tr>
                                    <td>
                                        <small>
                                            <strong>{{ $file->filename }}</strong><br>
                                            @if($file->alt_text)
                                                <span class="text-muted">{{ $file->alt_text }}</span>
                                            @endif
                                        </small>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary">{{ strtoupper($file->type) }}</span>
                                    </td>
                                    <td>
                                        {{-- <small>{{ formatBytes($file->size) }}</small> --}}
                                    </td>
                                    <td>
                                        <small class="text-muted">{{ $file->created_at->diffForHumans() }}</small>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ asset('storage/' . $file->path) }}"
                                           class="btn btn-sm btn-info"
                                           target="_blank"
                                           title="Lihat">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <form method="POST"
                                              action="{{ route('admin.media.destroy', $file) }}"
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
                                        Belum ada file
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- PAGINATION --}}
                    <div class="mt-3">
                        {{ $media->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function formatBytes(bytes) {
    const units = ['B', 'KB', 'MB', 'GB'];
    let size = bytes;
    let unitIndex = 0;
    
    while (size > 1024 && unitIndex < units.length - 1) {
        size /= 1024;
        unitIndex++;
    }
    
    return size.toFixed(2) + ' ' + units[unitIndex];
}

document.getElementById('uploadForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const formData = new FormData(this);
    const progressDiv = document.getElementById('uploadProgress');
    const progressBar = document.getElementById('progressBar');

    progressDiv.style.display = 'block';

    fetch('{{ route("admin.media.upload") }}', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        progressDiv.style.display = 'none';
        progressBar.style.width = '0%';

        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: data.message,
                confirmButtonColor: '#198754',
                timer: 2000
            }).then(() => {
                location.reload();
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: data.message,
                confirmButtonColor: '#dc3545'
            });
        }
    })
    .catch(error => {
        progressDiv.style.display = 'none';
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Terjadi kesalahan: ' + error,
            confirmButtonColor: '#dc3545'
        });
    });
});

function confirmDelete(btn) {
    Swal.fire({
        title: 'Yakin hapus file ini?',
        text: "File yang dihapus tidak dapat dikembalikan!",
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
