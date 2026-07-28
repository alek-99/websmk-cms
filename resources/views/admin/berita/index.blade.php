@extends('layouts.admin')
@section('content')

<div class="container-fluid mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Management Berita</h3>
            <p class="text-muted mb-0">Kelola konten berita dan artikel</p>
        </div>

        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreate">
            <i class="fas fa-plus"></i> Tambah Berita
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Filters & Search --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.berita.index') }}" id="filterForm">
                <div class="row g-3">
                    <div class="col-md-3">
                        <input type="text" 
                               name="search" 
                               class="form-control" 
                               placeholder="Cari berita..."
                               value="{{ request('search') }}">
                    </div>
                    <div class="col-md-2">
                        <select name="status" class="form-select">
                            <option value="">Semua Status</option>
                            <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                            <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="category" class="form-select">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->slug }}" {{ request('category') == $cat->slug ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="sort" class="form-select">
                            <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Terbaru</option>
                            <option value="views" {{ request('sort') == 'views' ? 'selected' : '' }}>Populer</option>
                            <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>Judul</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-filter"></i> Filter
                        </button>
                        <a href="{{ route('admin.berita.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-redo"></i> Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Bulk Actions --}}
    <div class="card shadow-sm mb-3" id="bulkActionsCard" style="display: none;">
        <div class="card-body py-2">
            <form method="POST" action="{{ route('admin.berita.bulk-action') }}" id="bulkActionForm">
                @csrf
                <div class="d-flex align-items-center gap-3">
                    <span class="text-muted">
                        <span id="selectedCount">0</span> item dipilih
                    </span>
                    <input type="hidden" name="ids" id="bulkIds">
                    <select name="action" class="form-select form-select-sm" style="width: auto;" required>
                        <option value="">Pilih Aksi</option>
                        <option value="publish">Publish</option>
                        <option value="draft">Jadikan Draft</option>
                        <option value="feature">Jadikan Unggulan</option>
                        <option value="unfeature">Hapus dari Unggulan</option>
                        <option value="delete" class="text-danger">Hapus</option>
                    </select>
                    <button type="submit" class="btn btn-sm btn-primary">
                        <i class="fas fa-check"></i> Terapkan
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="clearSelection()">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Main Table --}}
    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="40">
                            <input type="checkbox" class="form-check-input" id="selectAll">
                        </th>
                        <th>Berita</th>
                        <th>Kategori</th>
                        <th>Penulis</th>
                        <th>Status</th>
                        <th>SEO</th>
                        <th>Statistik</th>
                        <th width="180">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($beritas as $b)
                    <tr>
                        <td>
                            <input type="checkbox" class="form-check-input row-checkbox" value="{{ $b->id }}">
                        </td>
                        <td>
                            <div class="d-flex align-items-start">
                                @if($b->featured_image)
                                    <img src="{{ asset('storage/'.$b->featured_image) }}" 
                                         class="rounded me-3" 
                                         style="width: 60px; height: 60px; object-fit: cover;">
                                @else
                                    <div class="bg-light rounded me-3 d-flex align-items-center justify-content-center" 
                                         style="width: 60px; height: 60px;">
                                        <i class="fas fa-image text-muted"></i>
                                    </div>
                                @endif
                                <div>
                                    <div class="fw-bold">{{ Str::limit($b->title, 50) }}</div>
                                    @if($b->is_featured)
                                        <span class="badge bg-warning text-dark">
                                            <i class="fas fa-star"></i> Unggulan
                                        </span>
                                    @endif
                                    <div class="small text-muted mt-1">
                                        {{ $b->reading_time_minutes }} menit baca
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            @foreach($b->categories as $cat)
                                <span class="badge" style="background-color: {{ $cat->color ?? '#6c757d' }}">
                                    @if($cat->icon)
                                        <i class="{{ $cat->icon }}"></i>
                                    @endif
                                    {{ $cat->name }}
                                </span>
                            @endforeach
                        </td>
                        <td>
                            <div class="small">
                                <i class="fas fa-user text-muted"></i>
                                {{ $b->author->name ?? 'N/A' }}
                            </div>
                            @if($b->editor)
                                <div class="small text-muted">
                                    <i class="fas fa-edit"></i> {{ $b->editor->name }}
                                </div>
                            @endif
                        </td>
                        <td>
                            @if($b->status == 'published')
                                @if($b->published_at > now())
                                    <span class="badge bg-info">
                                        <i class="fas fa-clock"></i> Terjadwal
                                    </span>
                                    <div class="small text-muted mt-1">
                                        {{ $b->published_at->format('d M Y H:i') }}
                                    </div>
                                @else
                                    <span class="badge bg-success">
                                        <i class="fas fa-check"></i> Published
                                    </span>
                                    <div class="small text-muted mt-1">
                                        {{ $b->published_at->format('d M Y') }}
                                    </div>
                                @endif
                            @else
                                <span class="badge bg-secondary">
                                    <i class="fas fa-file"></i> Draft
                                </span>
                            @endif
                        </td>
                        <td>
                            @php
                                $seoScore = $b->seo_score['percentage'] ?? 0;
                                $seoColor = $seoScore >= 80 ? 'success' : ($seoScore >= 60 ? 'warning' : 'danger');
                            @endphp
                            <div class="d-flex align-items-center">
                                <div class="progress flex-grow-1 me-2" style="height: 8px; width: 60px;">
                                    <div class="progress-bar bg-{{ $seoColor }}" 
                                         role="progressbar" 
                                         style="width: {{ $seoScore }}%"
                                         aria-valuenow="{{ $seoScore }}" 
                                         aria-valuemin="0" 
                                         aria-valuemax="100">
                                    </div>
                                </div>
                                <span class="badge bg-{{ $seoColor }}">{{ $seoScore }}%</span>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <span class="badge bg-info" title="Views">
                                    <i class="fas fa-eye"></i> {{ number_format($b->views) }}
                                </span>
                                <span class="badge bg-primary" title="Shares">
                                    <i class="fas fa-share"></i> {{ number_format($b->shares) }}
                                </span>
                            </div>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle" 
                                        data-bs-toggle="dropdown">
                                    <i class="fas fa-cog"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" 
                                           href="{{ route('berita.show', $b->slug) }}" 
                                           target="_blank">
                                            <i class="fas fa-eye"></i> Lihat
                                        </a>
                                    </li>
                                    <li>
                                      <a class="dropdown-item" 
                                           href="{{ route('admin.berita.edit', $b->id) }}" 
                                           target="_blank">
                                            <i class="fas fa-pen"></i> Edit
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" 
                                           href="{{ route('admin.berita.analytics', $b->id) }}">
                                            <i class="fas fa-chart-line"></i> Analytics
                                        </a>
                                    </li>
                                    <li>
                                        <form method="POST" 
                                              action="{{ route('admin.berita.duplicate', $b->id) }}" 
                                              class="d-inline">
                                            @csrf
                                            <button type="submit" class="dropdown-item">
                                                <i class="fas fa-copy"></i> Duplikat
                                            </button>
                                        </form>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <button class="dropdown-item text-danger" 
                                                onclick="deleteData({{ $b->id }})">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </li>
                                </ul>
                            </div>

                            <form id="delete-form-{{ $b->id }}"
                                  action="{{ route('admin.berita.destroy', $b->id) }}"
                                  method="POST" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>

                    {{-- MODAL EDIT --}}
                    {{-- @include('admin.berita.partials.edit-modal', ['berita' => $b]) --}}

                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-5">
                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Belum ada berita</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3 d-flex justify-content-between align-items-center">
        <div class="text-muted">
            Menampilkan {{ $beritas->firstItem() ?? 0 }} - {{ $beritas->lastItem() ?? 0 }} 
            dari {{ $beritas->total() }} berita
        </div>
        <div>
            {{ $beritas->links() }}
        </div>
    </div>

</div>

{{-- MODAL CREATE --}}
@include('admin.berita.modal')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5/dist/js/bootstrap.bundle.min.js"></script>
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
// Delete confirmation
function deleteData(id){
    Swal.fire({
        title: 'Yakin hapus berita?',
        text: "Data tidak bisa dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-'+id).submit();
        }
    });
}

// Bulk selection
const selectAll = document.getElementById('selectAll');
const rowCheckboxes = document.querySelectorAll('.row-checkbox');
const bulkActionsCard = document.getElementById('bulkActionsCard');
const selectedCount = document.getElementById('selectedCount');
const bulkIds = document.getElementById('bulkIds');

selectAll.addEventListener('change', function() {
    rowCheckboxes.forEach(cb => {
        cb.checked = this.checked;
    });
    updateBulkActions();
});

rowCheckboxes.forEach(cb => {
    cb.addEventListener('change', updateBulkActions);
});

function updateBulkActions() {
    const selected = Array.from(rowCheckboxes).filter(cb => cb.checked);
    const count = selected.length;
    
    if (count > 0) {
        bulkActionsCard.style.display = 'block';
        selectedCount.textContent = count;
        bulkIds.value = selected.map(cb => cb.value).join(',');
    } else {
        bulkActionsCard.style.display = 'none';
    }
    
    selectAll.checked = count === rowCheckboxes.length;
}

function clearSelection() {
    rowCheckboxes.forEach(cb => cb.checked = false);
    selectAll.checked = false;
    updateBulkActions();
}

// Form submission confirmation
document.getElementById('bulkActionForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const action = this.querySelector('[name="action"]').value;
    let message = 'Terapkan aksi ini ke item yang dipilih?';
    
    if (action === 'delete') {
        message = 'Yakin ingin menghapus item yang dipilih? Data tidak bisa dikembalikan!';
    }
    
    Swal.fire({
        title: 'Konfirmasi',
        text: message,
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Ya, Lanjutkan',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
        }
    });
});

// Auto-submit on filter change
document.querySelectorAll('#filterForm select').forEach(select => {
    select.addEventListener('change', () => {
        document.getElementById('filterForm').submit();
    });
});
</script>
@endpush
@endsection
