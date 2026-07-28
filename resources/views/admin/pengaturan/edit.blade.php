@extends('layouts.admin')
@section('title', 'Edit Pengaturan Website')

@section('content')
<div class="page-header">
    <div>
        <div class="breadcrumb">
            <a href="{{ route('admin.pengaturan.index') }}">Pengaturan</a>
            <i class="fa-solid fa-chevron-right"></i>
            <span>Edit</span>
        </div>
        <h1>Edit Pengaturan Website</h1>
        <p>Perbarui konten tampilan website Anda</p>
    </div>
    <a href="{{ route('admin.pengaturan.index') }}" class="btn btn-outline">
        <i class="fa-solid fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.pengaturan.update', $pengaturan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.pengaturan._form')

            <div style="display:flex;gap:12px;margin-top:8px">
                <button type="submit" class="btn btn-success">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
                </button>
                <a href="{{ route('admin.pengaturan.index') }}" class="btn btn-outline">Batal</a>
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