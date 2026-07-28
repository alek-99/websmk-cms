@extends('layouts.admin')
@section('title', 'Edit Tag Berita')

@section('content')

<div class="container-fluid mt-4">

    {{-- HEADER --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body text-center bg-light">
            <i class="fa-solid fa-tag fa-2x mb-2 text-primary"></i>
            <h3 class="fw-bold mb-1">Edit Tag Berita</h3>
            <p class="text-muted mb-0">Ubah informasi tag</p>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <form action="{{ route('admin.tags.update', $tag) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- NAME --}}
                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold">Nama Tag <span class="text-danger">*</span></label>
                            <input type="text"
                                   class="form-control @error('name') is-invalid @enderror"
                                   id="name"
                                   name="name"
                                   placeholder="Contoh: Kesehatan"
                                   value="{{ old('name', $tag->name) }}"
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
                                   placeholder="kesehatan"
                                   value="{{ old('slug', $tag->slug) }}">
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- INFO --}}
                        <div class="alert alert-info mb-4">
                            <i class="fa-solid fa-circle-info"></i>
                            <strong>Informasi:</strong> Tag ini digunakan oleh <strong>{{ $tag->beritas_count }}</strong> berita
                        </div>

                        {{-- BUTTONS --}}
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa-solid fa-save"></i> Simpan
                            </button>
                            <a href="{{ route('admin.tags.index') }}" class="btn btn-secondary">
                                <i class="fa-solid fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
