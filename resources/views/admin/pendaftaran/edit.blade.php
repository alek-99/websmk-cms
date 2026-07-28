@extends('layouts.admin')

@section('title', 'Edit Data Pendaftar')

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
    }

    /* ── LAYOUT ──────────────────────────────────────────────────── */
    .edit-header {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 1.25rem 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: var(--shadow);
        display: flex; align-items: center; justify-content: space-between; gap: 1rem;
    }
    .edit-header .breadcrumb { margin: 0; font-size: .8rem; }

    .edit-panel {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        overflow: hidden;
    }
    .edit-panel-head {
        padding: 1rem 1.5rem;
        border-bottom: 1px solid var(--border);
        background: var(--surface-alt);
        display: flex; align-items: center; gap: .75rem;
    }
    .edit-panel-body { padding: 1.5rem; }
    .edit-panel-foot {
        padding: 1rem 1.5rem;
        border-top: 1px solid var(--border);
        background: var(--surface-alt);
        display: flex; justify-content: flex-end; gap: .75rem;
    }

    /* ── AVATAR LARGE ────────────────────────────────────────────── */
    .pendaftar-avatar {
        width: 48px; height: 48px; border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.3rem; font-weight: 700; flex-shrink: 0;
        background: #eff6ff; color: #2563eb;
    }

    /* ── BADGE STATUS ────────────────────────────────────────────── */
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

    /* ── TABS ────────────────────────────────────────────────────── */
    .nav-tabs-form .nav-link {
        font-size: .82rem; padding: .45rem .9rem;
        color: var(--text-muted); border-radius: 8px 8px 0 0;
    }
    .nav-tabs-form .nav-link.active { color: var(--primary); font-weight: 500; }

    /* ── FORM CONTROLS ───────────────────────────────────────────── */
    .form-label { font-size: .8rem; font-weight: 600; color: #374151; margin-bottom: 4px; }
    .form-control, .form-select {
        border-radius: 8px; border: 1px solid #d1d5db; font-size: .875rem;
        padding: .45rem .75rem;
    }
    .form-control:focus, .form-select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(37,99,235,.1);
    }
    .form-control.is-invalid, .form-select.is-invalid { border-color: #dc2626; }

    /* ── BUTTONS ─────────────────────────────────────────────────── */
    .btn-save {
        display: inline-flex; align-items: center; gap: 6px;
        background: var(--primary); color: #fff;
        border: none; border-radius: 8px; padding: .5rem 1.25rem;
        font-size: .875rem; font-weight: 500; cursor: pointer;
        transition: background .15s, box-shadow .15s;
    }
    .btn-save:hover { background: #1d4ed8; box-shadow: 0 4px 12px rgba(37,99,235,.3); color: #fff; }

    /* ── EXISTING FILE INDICATOR ─────────────────────────────────── */
    .file-existing {
        display: flex; align-items: center; gap: 6px;
        font-size: .78rem; color: #16a34a; margin-top: 5px;
        padding: 4px 8px; background: #f0fdf4; border-radius: 6px;
        border: 1px solid #bbf7d0;
    }
</style>
@endpush

@section('content')
<div class="container-fluid py-4">

    {{-- ── HEADER ──────────────────────────────────────────────── --}}
    <div class="edit-header">
        <div class="d-flex align-items-center gap-3">
            <div class="pendaftar-avatar">{{ substr($pendaftaran->nama_lengkap, 0, 1) }}</div>
            <div>
                <h5 class="mb-0 fw-bold" style="color:#0f172a">{{ $pendaftaran->nama_lengkap }}</h5>
                <div class="d-flex align-items-center gap-2 mt-1">
                    <span style="font-family:monospace;font-size:.78rem;color:#64748b">{{ $pendaftaran->no_pendaftaran }}</span>
                    <span class="badge-status badge-{{ $pendaftaran->status }}">{{ ucfirst($pendaftaran->status) }}</span>
                </div>
            </div>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.pendaftaran.show', $pendaftaran->id) }}"
               class="btn btn-sm btn-outline-secondary rounded-2">
                <i class="bi bi-eye me-1"></i>Lihat Detail
            </a>
            <a href="{{ route('admin.pendaftaran.index') }}"
               class="btn btn-sm btn-outline-secondary rounded-2">
                <i class="bi bi-arrow-left me-1"></i>Kembali
            </a>
        </div>
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

    {{-- ── FORM ────────────────────────────────────────────────── --}}
    <form action="{{ route('admin.pendaftaran.update', $pendaftaran->id) }}"
          method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="edit-panel">
            <div class="edit-panel-head">
                <div style="width:32px;height:32px;border-radius:8px;background:#eff6ff;color:#2563eb;display:flex;align-items:center;justify-content:center">
                    <i class="bi bi-pencil-square" style="font-size:.9rem"></i>
                </div>
                <div>
                    <div class="fw-semibold" style="font-size:.875rem;color:#0f172a">Edit Data Pendaftaran</div>
                    <div style="font-size:.75rem;color:#64748b">Perbarui informasi pendaftar sesuai kebutuhan</div>
                </div>
            </div>
            <div class="edit-panel-body">
                @include('admin.pendaftaran.form', ['mode' => 'edit', 'row' => $pendaftaran])
            </div>
            <div class="edit-panel-foot">
                <a href="{{ route('admin.pendaftaran.index') }}"
                   class="btn btn-sm btn-outline-secondary rounded-2">Batal</a>
                <button type="submit" class="btn-save">
                    <i class="bi bi-save"></i> Simpan Perubahan
                </button>
            </div>
        </div>

    </form>

</div>
@endsection