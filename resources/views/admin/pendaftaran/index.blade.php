@extends('layouts.admin')

@section('title', 'Manajemen Pendaftaran Siswa')

@push('styles')
<style>
    :root {
        --primary: #2563eb;
        --primary-light: #eff6ff;
        --surface: #ffffff;
        --surface-alt: #f8fafc;
        --border: #e2e8f0;
        --text: #0f172a;
        --text-muted: #64748b;
        --radius: 12px;
        --shadow: 0 1px 3px rgba(0,0,0,.06), 0 4px 16px rgba(0,0,0,.06);
        --shadow-lg: 0 8px 32px rgba(0,0,0,.10);
    }

    /* ── STAT CARDS ──────────────────────────────────────────── */
    .stat-card {
        border-radius: var(--radius);
        border: 1px solid var(--border);
        background: var(--surface);
        padding: 1.25rem 1.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        box-shadow: var(--shadow);
        transition: transform .15s, box-shadow .15s;
    }
    .stat-card:hover { transform: translateY(-2px); box-shadow: var(--shadow-lg); }
    .stat-icon {
        width: 48px; height: 48px; border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.4rem; flex-shrink: 0;
    }
    .stat-icon.total        { background: #f1f5f9; color: #64748b; }
    .stat-icon.menunggu     { background: #fffbeb; color: #d97706; }
    .stat-icon.diverifikasi { background: #ecfeff; color: #0891b2; }
    .stat-icon.diterima     { background: #f0fdf4; color: #16a34a; }
    .stat-icon.ditolak      { background: #fef2f2; color: #dc2626; }
    .stat-num { font-size: 1.75rem; font-weight: 700; line-height: 1; color: var(--text); }
    .stat-lbl { font-size: .8rem; color: var(--text-muted); margin-top: 2px; }

    /* ── CARD ────────────────────────────────────────────────── */
    .panel {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        overflow: hidden;
    }
    .panel-head {
        padding: .875rem 1.25rem;
        border-bottom: 1px solid var(--border);
        background: var(--surface-alt);
        display: flex; align-items: center; justify-content: space-between;
    }

    /* ── TABLE ───────────────────────────────────────────────── */
    .data-table { width: 100%; border-collapse: separate; border-spacing: 0; }
    .data-table thead th {
        background: #f8fafc;
        font-size: .75rem; font-weight: 600; letter-spacing: .05em;
        text-transform: uppercase; color: var(--text-muted);
        padding: .75rem 1rem; border-bottom: 1px solid var(--border);
        white-space: nowrap;
    }
    .data-table tbody td {
        padding: .875rem 1rem; font-size: .875rem; color: var(--text);
        border-bottom: 1px solid #f1f5f9; vertical-align: middle;
    }
    .data-table tbody tr:last-child td { border-bottom: none; }
    .data-table tbody tr:hover td { background: #f8fafc; }

    /* ── BADGES ──────────────────────────────────────────────── */
    .badge-status {
        display: inline-flex; align-items: center; gap: 5px;
        padding: 3px 10px; border-radius: 999px;
        font-size: .72rem; font-weight: 600;
    }
    .badge-status::before { content: ''; width: 6px; height: 6px; border-radius: 50%; }
    .badge-menunggu     { background: #fffbeb; color: #92400e; border: 1px solid #fde68a; }
    .badge-menunggu::before { background: #d97706; }
    .badge-diverifikasi { background: #ecfeff; color: #155e75; border: 1px solid #a5f3fc; }
    .badge-diverifikasi::before { background: #0891b2; }
    .badge-diterima     { background: #f0fdf4; color: #14532d; border: 1px solid #bbf7d0; }
    .badge-diterima::before { background: #16a34a; }
    .badge-ditolak      { background: #fef2f2; color: #7f1d1d; border: 1px solid #fecaca; }
    .badge-ditolak::before { background: #dc2626; }

    /* ── ACTION BUTTONS ──────────────────────────────────────── */
    .btn-act {
        display: inline-flex; align-items: center; justify-content: center;
        width: 32px; height: 32px; border-radius: 8px;
        border: 1px solid var(--border); background: var(--surface);
        color: var(--text-muted); font-size: .9rem;
        transition: all .15s; text-decoration: none;
        cursor: pointer;
    }
    .btn-act:hover { border-color: var(--primary); color: var(--primary); background: var(--primary-light); }
    .btn-act.danger:hover { border-color: #dc2626; color: #dc2626; background: #fef2f2; }
    .btn-act.success:hover { border-color: #16a34a; color: #16a34a; background: #f0fdf4; }

    /* ── SEARCH/FILTER BAR ───────────────────────────────────── */
    .filter-bar { padding: 1rem 1.25rem; display: flex; gap: .75rem; flex-wrap: wrap; align-items: flex-end; }
    .filter-bar .form-control,
    .filter-bar .form-select {
        border-radius: 8px; border: 1px solid var(--border);
        font-size: .875rem; padding: .45rem .75rem;
        box-shadow: none;
    }
    .filter-bar .form-control:focus,
    .filter-bar .form-select:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(37,99,235,.1); }

    /* ── BTN PRIMARY ─────────────────────────────────────────── */
    .btn-primary-custom {
        display: inline-flex; align-items: center; gap: 6px;
        background: var(--primary); color: #fff;
        border: none; border-radius: 8px; padding: .5rem 1.1rem;
        font-size: .875rem; font-weight: 500; cursor: pointer;
        transition: background .15s, box-shadow .15s;
    }
    .btn-primary-custom:hover { background: #1d4ed8; box-shadow: 0 4px 12px rgba(37,99,235,.3); color: #fff; }

    /* ── MODAL OVERRIDES ─────────────────────────────────────── */
    .modal-content { border-radius: var(--radius); border: 1px solid var(--border); box-shadow: var(--shadow-lg); }
    .modal-header { border-bottom: 1px solid var(--border); }
    .modal-footer { border-top: 1px solid var(--border); }

    /* ── AVATAR ──────────────────────────────────────────────── */
    .student-avatar {
        width: 36px; height: 36px; border-radius: 50%;
        display: inline-flex; align-items: center; justify-content: center;
        font-weight: 600; font-size: .85rem; flex-shrink: 0;
    }
    .avatar-male   { background: #dbeafe; color: #1d4ed8; }
    .avatar-female { background: #fce7f3; color: #be185d; }

    /* ── MISC ────────────────────────────────────────────────── */
    .no-pendaftaran { font-family: 'Courier New', monospace; font-size: .8rem; color: #64748b; }
    .empty-state { text-align: center; padding: 4rem 1rem; color: var(--text-muted); }
    .empty-state i { font-size: 3rem; display: block; margin-bottom: 1rem; opacity: .3; }

    /* nav tabs */
    .nav-tabs-form .nav-link { font-size: .82rem; padding: .45rem .9rem; }
</style>
@endpush

@section('content')
<div class="container-fluid py-4">

    {{-- ── HEADER ──────────────────────────────────────────────── --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-0 fw-bold" style="color:#0f172a">Pendaftaran Siswa Baru</h4>
            <small class="text-muted">Kelola seluruh data pendaftar masuk</small>
        </div>
        <button class="btn-primary-custom" data-bs-toggle="modal" data-bs-target="#modalTambah">
            <i class="bi bi-plus-lg"></i> Tambah Pendaftar
        </button>
    </div>

    {{-- ── FLASH ───────────────────────────────────────────────── --}}
    @if (session('success'))
        <div class="alert alert-success d-flex align-items-center gap-2 mb-4 border-0 rounded-3"
             style="background:#f0fdf4;color:#15803d;font-size:.875rem" role="alert">
            <i class="bi bi-check-circle-fill"></i>
            <span>{{ session('success') }}</span>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" style="font-size:.75rem"></button>
        </div>
    @endif

    {{-- ── STATISTIK ────────────────────────────────────────────── --}}
    <div class="row g-3 mb-4">
        @foreach ([
            ['label'=>'Total Pendaftar','key'=>'total','class'=>'total','icon'=>'bi-people-fill'],
            ['label'=>'Menunggu Verifikasi','key'=>'menunggu','class'=>'menunggu','icon'=>'bi-hourglass-split'],
            ['label'=>'Sedang Diverifikasi','key'=>'diverifikasi','class'=>'diverifikasi','icon'=>'bi-patch-check-fill'],
            ['label'=>'Diterima','key'=>'diterima','class'=>'diterima','icon'=>'bi-check-circle-fill'],
            ['label'=>'Ditolak','key'=>'ditolak','class'=>'ditolak','icon'=>'bi-x-circle-fill'],
        ] as $s)
        <div class="col-6 col-md-4 col-xl">
            <div class="stat-card">
                <div class="stat-icon {{ $s['class'] }}">
                    <i class="bi {{ $s['icon'] }}"></i>
                </div>
                <div>
                    <div class="stat-num">{{ $stats[$s['key']] }}</div>
                    <div class="stat-lbl">{{ $s['label'] }}</div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- ── FILTER ───────────────────────────────────────────────── --}}
    <div class="panel mb-4">
        <form method="GET" class="filter-bar">
            <div class="flex-grow-1" style="min-width:200px">
                <label class="form-label" style="font-size:.75rem;font-weight:600;color:#64748b;margin-bottom:4px">CARI</label>
                <div class="input-group" style="max-width:340px">
                    <span class="input-group-text" style="background:#fff;border-right:none;border-radius:8px 0 0 8px">
                        <i class="bi bi-search text-muted" style="font-size:.85rem"></i>
                    </span>
                    <input type="text" name="search" class="form-control"
                           style="border-left:none;border-radius:0 8px 8px 0"
                           placeholder="Nama / No. Pendaftaran / NISN"
                           value="{{ request('search') }}">
                </div>
            </div>
            <div>
                <label class="form-label" style="font-size:.75rem;font-weight:600;color:#64748b;margin-bottom:4px">STATUS</label>
                <select name="status" class="form-select" style="min-width:160px">
                    <option value="">Semua Status</option>
                    @foreach(['menunggu'=>'Menunggu','diverifikasi'=>'Diverifikasi','diterima'=>'Diterima','ditolak'=>'Ditolak'] as $val=>$lbl)
                        <option value="{{ $val }}" @selected(request('status') === $val)>{{ $lbl }}</option>
                    @endforeach
                </select>
            </div>
            <div class="d-flex gap-2 align-self-end">
                <button type="submit" class="btn-primary-custom">
                    <i class="bi bi-search"></i> Filter
                </button>
                <a href="{{ route('admin.pendaftaran.index') }}"
                   class="btn btn-sm btn-outline-secondary rounded-2">Reset</a>
            </div>
        </form>
    </div>

    {{-- ── TABEL ────────────────────────────────────────────────── --}}
    <div class="panel">
        <div class="panel-head">
            <span style="font-size:.875rem;font-weight:600;color:#0f172a">
                <i class="bi bi-table me-1 text-muted"></i>Daftar Pendaftar
            </span>
            @if($pendaftarans->total())
            <small class="text-muted">{{ $pendaftarans->total() }} data ditemukan</small>
            @endif
        </div>
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width:40px">#</th>
                        <th>No. Pendaftaran</th>
                        <th>Pendaftar</th>
                        <th>NISN</th>
                        <th>Asal Sekolah</th>
                        <th>No. HP</th>
                        <th>Status</th>
                        <th style="text-align:center;width:120px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pendaftarans as $p)
                    <tr>
                        <td style="color:#94a3b8;font-size:.8rem">{{ $pendaftarans->firstItem() + $loop->index }}</td>
                        <td><span class="no-pendaftaran">{{ $p->no_pendaftaran }}</span></td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="student-avatar {{ $p->jenis_kelamin === 'laki-laki' ? 'avatar-male' : 'avatar-female' }}">
                                    {{ substr($p->nama_lengkap, 0, 1) }}
                                </div>
                                <div>
                                    <div style="font-weight:600;font-size:.875rem">{{ $p->nama_lengkap }}</div>
                                    <div style="font-size:.75rem;color:#94a3b8">
                                        {{ $p->jenis_kelamin === 'laki-laki' ? 'Laki-laki' : 'Perempuan' }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td style="font-family:monospace;font-size:.82rem">{{ $p->nisn }}</td>
                        <td>{{ $p->asal_sekolah }}</td>
                        <td>{{ $p->no_hp }}</td>
                        <td>
                            <span class="badge-status badge-{{ $p->status }}">
                                {{ ucfirst($p->status) }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-1">
                                {{-- Detail --}}
                                <a href="{{ route('admin.pendaftaran.show', $p->id) }}"
                                   class="btn-act" title="Lihat Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                {{-- Edit — link ke halaman edit, bukan modal --}}
                                <a href="{{ route('admin.pendaftaran.edit', $p->id) }}"
                                   class="btn-act" title="Edit Data">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                {{-- Ubah Status --}}
                                <button class="btn-act success btn-status"
                                        data-bs-toggle="modal" data-bs-target="#modalStatus"
                                        data-id="{{ $p->id }}"
                                        data-status="{{ $p->status }}"
                                        data-nama="{{ $p->nama_lengkap }}"
                                        title="Ubah Status">
                                    <i class="bi bi-arrow-repeat"></i>
                                </button>
                                {{-- Hapus --}}
                                <button class="btn-act danger btn-hapus"
                                        data-bs-toggle="modal" data-bs-target="#modalHapus"
                                        data-id="{{ $p->id }}"
                                        data-nama="{{ $p->nama_lengkap }}"
                                        title="Hapus">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8">
                            <div class="empty-state">
                                <i class="bi bi-inbox"></i>
                                <p class="fw-semibold mb-1">Belum ada data pendaftaran</p>
                                <small>Klik "Tambah Pendaftar" untuk menambahkan data baru.</small>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($pendaftarans->hasPages())
        <div style="padding:.875rem 1.25rem;border-top:1px solid #f1f5f9;display:flex;justify-content:space-between;align-items:center">
            <small class="text-muted">
                Menampilkan {{ $pendaftarans->firstItem() }}–{{ $pendaftarans->lastItem() }}
                dari {{ $pendaftarans->total() }} data
            </small>
            {{ $pendaftarans->links() }}
        </div>
        @endif
    </div>

</div>{{-- /container --}}


{{-- ╔══════════════════════════════════════════════════════════════╗
     ║  MODAL TAMBAH                                                ║
     ╚══════════════════════════════════════════════════════════════╝ --}}
<div class="modal fade" id="modalTambah" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <div class="d-flex align-items-center gap-2">
                    <div style="width:36px;height:36px;border-radius:8px;background:#eff6ff;color:#2563eb;display:flex;align-items:center;justify-content:center">
                        <i class="bi bi-person-plus"></i>
                    </div>
                    <h5 class="modal-title mb-0 fw-semibold">Tambah Data Pendaftar</h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.pendaftaran.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body" style="background:#f8fafc">
                    @include('admin.pendaftaran.form', ['mode' => 'create', 'row' => null])
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-2" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-primary-custom">
                        <i class="bi bi-save"></i> Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


{{-- ╔══════════════════════════════════════════════════════════════╗
     ║  MODAL UBAH STATUS                                           ║
     ╚══════════════════════════════════════════════════════════════╝ --}}
<div class="modal fade" id="modalStatus" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-semibold" style="font-size:.95rem">
                    <i class="bi bi-arrow-repeat me-2 text-primary"></i>Ubah Status
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="formStatus" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <p style="font-size:.85rem;color:#64748b" class="mb-3">
                        Pendaftar: <strong id="statusNama" class="text-dark"></strong>
                    </p>
                    <div>
                        <label class="form-label" style="font-size:.8rem;font-weight:600">Status Baru</label>
                        <select name="status" id="statusSelect" class="form-select form-select-sm rounded-2">
                            @foreach(['menunggu'=>'Menunggu','diverifikasi'=>'Diverifikasi','diterima'=>'Diterima','ditolak'=>'Ditolak'] as $val=>$lbl)
                                <option value="{{ $val }}">{{ $lbl }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-2" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-sm btn-primary rounded-2">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>


{{-- ╔══════════════════════════════════════════════════════════════╗
     ║  MODAL HAPUS                                                 ║
     ╚══════════════════════════════════════════════════════════════╝ --}}
<div class="modal fade" id="modalHapus" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header" style="background:#fef2f2;border-bottom-color:#fecaca">
                <h5 class="modal-title fw-semibold" style="font-size:.95rem;color:#dc2626">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>Konfirmasi Hapus
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" style="font-size:.875rem">
                Yakin ingin menghapus data <strong id="hapusNama"></strong>?
                <div class="mt-2 p-2 rounded-2" style="background:#fff7ed;color:#92400e;font-size:.8rem">
                    <i class="bi bi-info-circle me-1"></i> Tindakan ini tidak dapat dibatalkan dan semua berkas terkait akan ikut terhapus.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-outline-secondary rounded-2" data-bs-dismiss="modal">Batal</button>
                <form id="formHapus" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger rounded-2">
                        <i class="bi bi-trash3 me-1"></i>Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection


@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {

    // ── MODAL STATUS ─────────────────────────────────────────────
    document.querySelectorAll('.btn-status').forEach(btn => {
        btn.addEventListener('click', () => {
            document.getElementById('statusNama').textContent = btn.dataset.nama;
            document.getElementById('statusSelect').value     = btn.dataset.status;
            document.getElementById('formStatus').action      =
                `{{ url('admin/pendaftaran') }}/${btn.dataset.id}/status`;
        });
    });

    // ── MODAL HAPUS ──────────────────────────────────────────────
    document.querySelectorAll('.btn-hapus').forEach(btn => {
        btn.addEventListener('click', () => {
            document.getElementById('hapusNama').textContent = btn.dataset.nama;
            document.getElementById('formHapus').action     =
                `{{ url('admin/pendaftaran') }}/${btn.dataset.id}`;
        });
    });
});
</script>
@endpush