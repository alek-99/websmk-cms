@extends('layouts.admin')
@section('title', 'Tambah Kategori Berita')

@section('content')

<div class="container-fluid mt-4">

    {{-- HEADER --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body text-center bg-light">
            <i class="fa-solid fa-folder-plus fa-2x mb-2 text-primary"></i>
            <h3 class="fw-bold mb-1">Tambah Kategori Berita</h3>
            <p class="text-muted mb-0">Buat kategori baru untuk mengorganisir berita</p>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <form action="{{ route('admin.categories.store') }}" method="POST">
                        @csrf

                        {{-- NAME --}}
                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold">Nama Kategori <span class="text-danger">*</span></label>
                            <input type="text"
                                   class="form-control @error('name') is-invalid @enderror"
                                   id="name"
                                   name="name"
                                   placeholder="Contoh: Berita Umum"
                                   value="{{ old('name') }}"
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- SLUG --}}
                        <div class="mb-3">
                            <label for="slug" class="form-label fw-bold">Slug <small class="text-muted">(opsional, otomatis dibuat jika kosong)</small></label>
                            <input type="text"
                                   class="form-control @error('slug') is-invalid @enderror"
                                   id="slug"
                                   name="slug"
                                   placeholder="berita-umum"
                                   value="{{ old('slug') }}">
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- DESCRIPTION --}}
                        <div class="mb-3">
                            <label for="description" class="form-label fw-bold">Deskripsi <small class="text-muted">(opsional)</small></label>
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                      id="description"
                                      name="description"
                                      rows="3"
                                      placeholder="Deskripsi kategori...">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- COLOR --}}
                        <div class="mb-3">
                            <label for="color" class="form-label fw-bold">Warna <small class="text-muted">(opsional)</small></label>
                            <div class="input-group">
                                <input type="color"
                                       class="form-control form-control-color"
                                       id="color"
                                       name="color"
                                       value="{{ old('color', '#007bff') }}"
                                       style="max-width: 80px;">
                                <input type="text"
                                       class="form-control"
                                       id="colorValue"
                                       readonly
                                       value="{{ old('color', '#007bff') }}">
                            </div>
                        </div>

                        {{-- ICON --}}
                        <div class="mb-3">
                            <label for="icon" class="form-label fw-bold">Icon <small class="text-muted">(opsional, FontAwesome)</small></label>
                            <input type="text"
                                   class="form-control @error('icon') is-invalid @enderror"
                                   id="icon"
                                   name="icon"
                                   placeholder="Contoh: fa-solid fa-newspaper"
                                   value="{{ old('icon') }}">
                            @error('icon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- ORDER --}}
                        <div class="mb-3">
                            <label for="order" class="form-label fw-bold">Urutan <small class="text-muted">(opsional)</small></label>
                            <input type="number"
                                   class="form-control @error('order') is-invalid @enderror"
                                   id="order"
                                   name="order"
                                   min="0"
                                   placeholder="0"
                                   value="{{ old('order', 0) }}">
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- IS ACTIVE --}}
                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    <span class="fw-bold">Aktif</span>
                                </label>
                            </div>
                        </div>

                        {{-- BUTTONS --}}
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa-solid fa-save"></i> Simpan
                            </button>
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                                <i class="fa-solid fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
document.getElementById('color').addEventListener('change', function() {
    document.getElementById('colorValue').value = this.value;
});
</script>

@endsection
