@extends('layouts.admin')

@section('title', 'Detail Pendaftaran – ' . $pendaftaran->nama_lengkap)

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

    /* ── HERO HEADER ─────────────────────────────────────────────── */
    .hero-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        padding: 1.75rem;
        margin-bottom: 1.5rem;
    }
    .hero-avatar {
        width: 80px; height: 80px; border-radius: 16px;
        display: flex; align-items: center; justify-content: center;
        font-size: 2rem; font-weight: 700; flex-shrink: 0;
    }
    .avatar-male   { background: #dbeafe; color: #1d4ed8; }
    .avatar-female { background: #fce7f3; color: #be185d; }
    .hero-photo {
        width: 80px; height: 80px; border-radius: 16px;
        object-fit: cover; box-shadow: var(--shadow);
        border: 2px solid var(--border);
    }

    /* ── BADGE STATUS ────────────────────────────────────────────── */
    .badge-status {
        display: inline-flex; align-items: center; gap: 5px;
        padding: 4px 12px; border-radius: 999px;
        font-size: .78rem; font-weight: 600;
    }
    .badge-status::before { content: ''; width: 7px; height: 7px; border-radius: 50%; box-shadow: 0 0 0 2px currentColor; }
    .badge-menunggu     { background: #fffbeb; color: #92400e; border: 1px solid #fde68a; }
    .badge-menunggu::before { background: #d97706; box-shadow: 0 0 0 2px #fde68a; }
    .badge-diverifikasi { background: #ecfeff; color: #155e75; border: 1px solid #a5f3fc; }
    .badge-diverifikasi::before { background: #0891b2; box-shadow: 0 0 0 2px #a5f3fc; }
    .badge-diterima     { background: #f0fdf4; color: #14532d; border: 1px solid #bbf7d0; }
    .badge-diterima::before { background: #16a34a; box-shadow: 0 0 0 2px #bbf7d0; }
    .badge-ditolak      { background: #fef2f2; color: #7f1d1d; border: 1px solid #fecaca; }
    .badge-ditolak::before { background: #dc2626; box-shadow: 0 0 0 2px #fecaca; }

    /* ── SECTION PANELS ──────────────────────────────────────────── */
    .info-panel {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        overflow: hidden;
        height: 100%;
    }
    .info-panel-head {
        padding: .875rem 1.25rem;
        border-bottom: 1px solid var(--border);
        background: var(--surface-alt);
        display: flex; align-items: center; gap: .6rem;
    }
    .info-panel-head-icon {
        width: 28px; height: 28px; border-radius: 7px;
        display: flex; align-items: center; justify-content: center;
        font-size: .85rem; flex-shrink: 0;
    }
    .icon-blue   { background: #eff6ff; color: #2563eb; }
    .icon-green  { background: #f0fdf4; color: #16a34a; }
    .icon-purple { background: #f5f3ff; color: #7c3aed; }
    .icon-orange { background: #fff7ed; color: #ea580c; }
    .icon-cyan   { background: #ecfeff; color: #0891b2; }

    .info-panel-head-title { font-size: .8rem; font-weight: 600; color: var(--text); }
    .info-panel-body { padding: 0; }

    /* ── DATA ROWS ───────────────────────────────────────────────── */
    .data-row {
        display: flex; align-items: flex-start;
        padding: .7rem 1.25rem;
        border-bottom: 1px solid #f1f5f9;
        gap: .75rem;
    }
    .data-row:last-child { border-bottom: none; }
    .data-key {
        font-size: .75rem; font-weight: 600; color: var(--text-muted);
        width: 150px; flex-shrink: 0; padding-top: 1px;
        text-transform: uppercase; letter-spacing: .04em;
    }
    .data-val { font-size: .875rem; color: var(--text); flex: 1; word-break: break-word; }

    /* ── FILE CARDS ──────────────────────────────────────────────── */
    .file-card {
        display: flex; align-items: center; gap: .75rem;
        padding: .875rem 1.25rem;
        border-bottom: 1px solid #f1f5f9;
    }
    .file-card:last-child { border-bottom: none; }
    .file-icon {
        width: 40px; height: 40px; border-radius: 8px;
        background: var(--surface-alt); border: 1px solid var(--border);
        display: flex; align-items: center; justify-content: center;
        font-size: 1.1rem; color: var(--text-muted); flex-shrink: 0;
    }
    .file-icon.has-file { background: #eff6ff; border-color: #bfdbfe; color: #2563eb; }
    .file-name { font-size: .85rem; font-weight: 500; color: var(--text); }
    .file-sub  { font-size: .75rem; color: var(--text-muted); }
    .file-link {
        display: inline-flex; align-items: center; gap: 4px;
        font-size: .78rem; font-weight: 500; color: var(--primary);
        text-decoration: none; padding: 3px 10px; border-radius: 6px;
        background: var(--primary-light); border: 1px solid #bfdbfe;
        transition: all .15s;
    }
    .file-link:hover { background: #dbeafe; color: #1d4ed8; }

    /* ── ACTION BAR ──────────────────────────────────────────────── */
    .action-bar {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        padding: 1rem 1.25rem;
        margin-bottom: 1.5rem;
        display: flex; align-items: center; justify-content: space-between; gap: 1rem;
        flex-wrap: wrap;
    }

    .btn-primary-custom {
        display: inline-flex; align-items: center; gap: 6px;
        background: var(--primary); color: #fff;
        border: none; border-radius: 8px; padding: .45rem 1rem;
        font-size: .82rem; font-weight: 500; cursor: pointer;
        text-decoration: none; transition: background .15s;
    }
    .btn-primary-custom:hover { background: #1d4ed8; color: #fff; }

    /* ── META INFO ───────────────────────────────────────────────── */
    .meta-pill {
        display: inline-flex; align-items: center; gap: 5px;
        padding: 3px 10px; border-radius: 6px;
        background: var(--surface-alt); border: 1px solid var(--border);
        font-size: .75rem; color: var(--text-muted);
    }
</style>
@endpush

@section('content')
<div class="container-fluid py-4">

    {{-- ── ACTION BAR ──────────────────────────────────────────────── --}}
    <div class="action-bar">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0" style="font-size:.8rem">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.pendaftaran.index') }}" class="text-decoration-none">Pendaftaran</a>
                    </li>
                    <li class="breadcrumb-item active">Detail</li>
                </ol>
            </nav>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.pendaftaran.edit', $pendaftaran->id) }}"
               class="btn-primary-custom">
                <i class="bi bi-pencil-square"></i> Edit Data
            </a>
            <a href="{{ route('admin.pendaftaran.index') }}"
               class="btn btn-sm btn-outline-secondary rounded-2">
                <i class="bi bi-arrow-left me-1"></i>Kembali
            </a>
        </div>
    </div>

    {{-- ── HERO CARD ────────────────────────────────────────────────── --}}
    <div class="hero-card">
        <div class="d-flex align-items-center gap-3 flex-wrap">
            {{-- Photo or Avatar --}}
            @if($pendaftaran->foto)
                <img src="{{ Storage::url($pendaftaran->foto) }}" class="hero-photo" alt="Foto Siswa">
            @else
                <div class="hero-avatar {{ $pendaftaran->jenis_kelamin === 'laki-laki' ? 'avatar-male' : 'avatar-female' }}">
                    {{ strtoupper(substr($pendaftaran->nama_lengkap, 0, 1)) }}
                </div>
            @endif

            <div class="flex-grow-1">
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <h4 class="mb-0 fw-bold" style="color:#0f172a">{{ $pendaftaran->nama_lengkap }}</h4>
                    <span class="badge-status badge-{{ $pendaftaran->status }}">{{ ucfirst($pendaftaran->status) }}</span>
                </div>
                <div class="d-flex align-items-center gap-3 mt-1 flex-wrap">
                    <span class="meta-pill">
                        <i class="bi bi-hash"></i> {{ $pendaftaran->no_pendaftaran }}
                    </span>
                    <span class="meta-pill">
                        <i class="bi bi-person"></i>
                        {{ $pendaftaran->jenis_kelamin === 'laki-laki' ? 'Laki-laki' : 'Perempuan' }}
                    </span>
                    <span class="meta-pill">
                        <i class="bi bi-mortarboard"></i> {{ $pendaftaran->asal_sekolah }}
                    </span>
                </div>
            </div>

            <div class="text-end" style="font-size:.75rem;color:#94a3b8">
                <div><i class="bi bi-calendar3 me-1"></i>Daftar: {{ $pendaftaran->created_at->isoFormat('D MMM Y') }}</div>
                <div><i class="bi bi-clock-history me-1"></i>Update: {{ $pendaftaran->updated_at->isoFormat('D MMM Y, HH:mm') }}</div>
            </div>
        </div>
    </div>

    {{-- ── GRID KONTEN ──────────────────────────────────────────────── --}}
    <div class="row g-3">

        {{-- DATA SISWA ──────────────────────────────────────────── --}}
        <div class="col-lg-7">
            <div class="info-panel">
                <div class="info-panel-head">
                    <div class="info-panel-head-icon icon-blue"><i class="bi bi-person-fill"></i></div>
                    <span class="info-panel-head-title">Data Siswa</span>
                </div>
                <div class="info-panel-body">
                    <div class="data-row">
                        <div class="data-key">NISN</div>
                        <div class="data-val" style="font-family:monospace">{{ $pendaftaran->nisn }}</div>
                    </div>
                    <div class="data-row">
                        <div class="data-key">NIK</div>
                        <div class="data-val" style="font-family:monospace">{{ $pendaftaran->nik }}</div>
                    </div>
                    <div class="data-row">
                        <div class="data-key">Tempat, Tgl Lahir</div>
                        <div class="data-val">
                            {{ $pendaftaran->tempat_lahir }},
                            {{ $pendaftaran->tanggal_lahir->isoFormat('D MMMM Y') }}
                        </div>
                    </div>
                    <div class="data-row">
                        <div class="data-key">Agama</div>
                        <div class="data-val">{{ $pendaftaran->agama }}</div>
                    </div>
                    <div class="data-row">
                        <div class="data-key">No. HP</div>
                        <div class="data-val">
                            <a href="tel:{{ $pendaftaran->no_hp }}" class="text-decoration-none" style="color:#2563eb">
                                {{ $pendaftaran->no_hp }}
                            </a>
                        </div>
                    </div>
                    <div class="data-row">
                        <div class="data-key">Email</div>
                        <div class="data-val">
                            @if($pendaftaran->email)
                                <a href="mailto:{{ $pendaftaran->email }}" class="text-decoration-none" style="color:#2563eb">
                                    {{ $pendaftaran->email }}
                                </a>
                            @else
                                <span style="color:#94a3b8">—</span>
                            @endif
                        </div>
                    </div>
                    <div class="data-row">
                        <div class="data-key">Alamat</div>
                        <div class="data-val">{{ $pendaftaran->alamat }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- SEKOLAH + ORTU (kanan) ─────────────────────────────── --}}
        <div class="col-lg-5 d-flex flex-column gap-3">

            {{-- SEKOLAH --}}
            <div class="info-panel">
                <div class="info-panel-head">
                    <div class="info-panel-head-icon icon-green"><i class="bi bi-building"></i></div>
                    <span class="info-panel-head-title">Sekolah Asal</span>
                </div>
                <div class="info-panel-body">
                    <div class="data-row">
                        <div class="data-key">Nama Sekolah</div>
                        <div class="data-val fw-semibold">{{ $pendaftaran->asal_sekolah }}</div>
                    </div>
                    <div class="data-row">
                        <div class="data-key">NPSN</div>
                        <div class="data-val" style="font-family:monospace">{{ $pendaftaran->npsn_sekolah ?? '—' }}</div>
                    </div>
                    <div class="data-row">
                        <div class="data-key">Nilai Rata-rata</div>
                        <div class="data-val">
                            @if($pendaftaran->nilai_rata_rata)
                                <span class="fw-semibold" style="color:#0f172a">{{ number_format($pendaftaran->nilai_rata_rata, 2) }}</span>
                                <span style="font-size:.75rem;color:#94a3b8"> / 100</span>
                            @else
                                <span style="color:#94a3b8">—</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- ORANG TUA --}}
            <div class="info-panel">
                <div class="info-panel-head">
                    <div class="info-panel-head-icon icon-purple"><i class="bi bi-people-fill"></i></div>
                    <span class="info-panel-head-title">Data Orang Tua</span>
                </div>
                <div class="info-panel-body">
                    <div class="data-row" style="background:#fafafa;border-bottom:1px solid #f1f5f9">
                        <div class="data-key" style="color:#94a3b8;font-size:.7rem">AYAH</div>
                        <div class="data-val">
                            <div class="fw-semibold">{{ $pendaftaran->nama_ayah }}</div>
                            <div style="font-size:.78rem;color:#64748b">{{ $pendaftaran->pekerjaan_ayah ?? 'Pekerjaan tidak diisi' }}</div>
                        </div>
                    </div>
                    <div class="data-row" style="background:#fafafa;border-bottom:1px solid #f1f5f9">
                        <div class="data-key" style="color:#94a3b8;font-size:.7rem">IBU</div>
                        <div class="data-val">
                            <div class="fw-semibold">{{ $pendaftaran->nama_ibu }}</div>
                            <div style="font-size:.78rem;color:#64748b">{{ $pendaftaran->pekerjaan_ibu ?? 'Pekerjaan tidak diisi' }}</div>
                        </div>
                    </div>
                    <div class="data-row">
                        <div class="data-key">No. HP Ortu</div>
                        <div class="data-val">
                            <a href="tel:{{ $pendaftaran->no_hp_ortu }}" class="text-decoration-none" style="color:#2563eb">
                                {{ $pendaftaran->no_hp_ortu }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- BERKAS ──────────────────────────────────────────────── --}}
        <div class="col-12">
            <div class="info-panel">
                <div class="info-panel-head">
                    <div class="info-panel-head-icon icon-orange"><i class="bi bi-paperclip"></i></div>
                    <span class="info-panel-head-title">Berkas Dokumen</span>
                </div>
                <div class="info-panel-body">
                    <div class="row g-0">
                        @foreach([
                            'scan_kk'     => ['label'=>'Kartu Keluarga',  'icon'=>'bi-house-fill'],
                            'scan_akta'   => ['label'=>'Akta Kelahiran',  'icon'=>'bi-file-earmark-person-fill'],
                            'scan_ijazah' => ['label'=>'Ijazah / SKL',    'icon'=>'bi-award-fill'],
                        ] as $field => $meta)
                        <div class="col-md-4">
                            <div class="file-card">
                                <div class="file-icon {{ $pendaftaran->$field ? 'has-file' : '' }}">
                                    <i class="bi {{ $meta['icon'] }}"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="file-name">{{ $meta['label'] }}</div>
                                    @if($pendaftaran->$field)
                                        <div class="file-sub mb-1" style="color:#16a34a">
                                            <i class="bi bi-check-circle me-1"></i>Berkas tersedia
                                        </div>
                                        <a href="{{ Storage::url($pendaftaran->$field) }}"
                                           target="_blank" class="file-link">
                                            <i class="bi bi-box-arrow-up-right"></i> Lihat File
                                        </a>
                                    @else
                                        <div class="file-sub" style="color:#94a3b8">
                                            <i class="bi bi-dash-circle me-1"></i>Tidak ada berkas
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>{{-- /row --}}

</div>
@endsection