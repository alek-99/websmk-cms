@extends('layouts.admin')
@section('title', 'Edit Program')

@section('content')
<div class="page-header">
    <div>
        <div class="breadcrumb">
            <a href="{{ route('admin.program.index') }}">Program</a>
            <i class="fa-solid fa-chevron-right"></i>
            <span>Edit</span>
        </div>
        <h1>Edit Program</h1>
        <p>Perbarui detail program</p>
    </div>
    <a href="{{ route('admin.program.index') }}" class="btn btn-outline">
        <i class="fa-solid fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="card" style="max-width:720px">
    <div class="card-body">
        <form action="{{ route('admin.program.update', $program->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label class="form-label">Icon / Gambar Program</label>
                <input type="file" name="icon" accept="image/*"
                       class="form-control {{ $errors->has('icon') ? 'is-invalid' : '' }}"
                       onchange="previewImg(this,'prev_icon')">
                <img id="prev_icon" src="{{ asset('storage/'.$program->icon) }}" class="img-preview">
                @error('icon') <div class="invalid-feedback">{{ $message }}</div> @enderror
                <div class="form-hint">Kosongkan jika tidak ingin mengganti icon. Format: JPG, PNG, WEBP, SVG. Maks 1MB.</div>
            </div>

            <div class="form-group">
                <label class="form-label">Judul Program <span style="color:var(--danger)">*</span></label>
                <input type="text" name="judul" class="form-control {{ $errors->has('judul') ? 'is-invalid' : '' }}"
                       value="{{ old('judul', $program->judul) }}" placeholder="cth: Program Tahfidz Al-Quran">
                @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Deskripsi <span style="color:var(--danger)">*</span></label>
                <textarea name="deskripsi" rows="5" class="form-control {{ $errors->has('deskripsi') ? 'is-invalid' : '' }}"
                          placeholder="Jelaskan program ini...">{{ old('deskripsi', $program->deskripsi) }}</textarea>
                @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div style="display:flex;gap:12px;margin-top:8px">
                <button type="submit" class="btn btn-success">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
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