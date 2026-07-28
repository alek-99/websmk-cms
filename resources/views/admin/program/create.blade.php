@extends('layouts.admin')
@section('title', 'Tambah Program')

@section('content')
<div class="page-header">
    <div>
        <div class="breadcrumb">
            <a href="{{ route('admin.program.index') }}">Program</a>
            <i class="fa-solid fa-chevron-right"></i>
            <span>Tambah</span>
        </div>
        <h1>Tambah Program Baru</h1>
        <p>Isi detail program yang akan ditampilkan di website</p>
    </div>
    <a href="{{ route('admin.program.index') }}" class="btn btn-outline">
        <i class="fa-solid fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="card" style="max-width:720px">
    <div class="card-body">
        <form action="{{ route('admin.program.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label class="form-label">Icon / Gambar Program <span style="color:var(--danger)">*</span></label>
                <input type="file" name="icon" accept="image/*"
                       class="form-control {{ $errors->has('icon') ? 'is-invalid' : '' }}"
                       onchange="previewImg(this,'prev_icon')">
                <img id="prev_icon" class="img-preview" style="display:none">
                @error('icon') <div class="invalid-feedback">{{ $message }}</div> @enderror
                <div class="form-hint">Format: JPG, PNG, WEBP, SVG. Maks 1MB. Disarankan ukuran persegi (misal 200x200px).</div>
            </div>

            <div class="form-group">
                <label class="form-label">Judul Program <span style="color:var(--danger)">*</span></label>
                <input type="text" name="judul" class="form-control {{ $errors->has('judul') ? 'is-invalid' : '' }}"
                       value="{{ old('judul') }}" placeholder="cth: Program Tahfidz Al-Quran">
                @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Deskripsi <span style="color:var(--danger)">*</span></label>
                <textarea name="deskripsi" rows="5" class="form-control {{ $errors->has('deskripsi') ? 'is-invalid' : '' }}"
                          placeholder="Jelaskan program ini secara singkat dan menarik...">{{ old('deskripsi') }}</textarea>
                @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div style="display:flex;gap:12px;margin-top:8px">
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan Program
                </button>
                <a href="{{ route('admin.program.index') }}" class="btn btn-outline">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
function previewImg(input, previewId) {
    const preview = document.getElementById(previewId);
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => { preview.src = e.target.result; preview.style.display = 'block'; };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush