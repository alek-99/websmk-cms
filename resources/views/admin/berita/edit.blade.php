@extends('layouts.admin')

@section('title', 'Edit Berita')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Edit Berita</h5>
        </div>

        <div class="card-body">

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('admin.berita.update', $beritum->id) }}" 
                  method="POST" 
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Judul --}}
                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text" 
                           name="title" 
                           class="form-control @error('title') is-invalid @enderror"
                           value="{{ old('title', $beritum->title) }}"
                           required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Excerpt --}}
                <div class="mb-3">
                    <label class="form-label">Excerpt</label>
                    <textarea name="excerpt" 
                              class="form-control @error('excerpt') is-invalid @enderror"
                              rows="2">{{ old('excerpt', $beritum->excerpt) }}</textarea>
                </div>

                {{-- Content --}}
                <div class="mb-3">
                    <label class="form-label">Konten</label>
                    <textarea name="content" 
                              class="form-control @error('content') is-invalid @enderror"
                              rows="8" required>{{ old('content', $beritum->content) }}</textarea>
                </div>

                {{-- Featured Image --}}
                <div class="mb-3">
                    <label class="form-label">Featured Image</label>
                    <input type="file" 
                           name="featured_image" 
                           class="form-control @error('featured_image') is-invalid @enderror">

                    @if($beritum->featured_image)
                        <div class="mt-2">
                            <img src="{{ asset('storage/'.$beritum->featured_image) }}" 
                                 width="200" 
                                 class="img-thumbnail">
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label class="form-label">Alt Text Gambar</label>
                    <input type="text" 
                           name="featured_image_alt"
                           class="form-control"
                           value="{{ old('featured_image_alt', $beritum->featured_image_alt) }}">
                </div>

                {{-- Categories --}}
                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <div class="row">
                        @foreach($categories as $category)
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input"
                                           type="checkbox"
                                           name="categories[]"
                                           value="{{ $category->id }}"
                                           {{ in_array($category->id, old('categories', $beritum->categories->pluck('id')->toArray())) ? 'checked' : '' }}>
                                    <label class="form-check-label">
                                        {{ $category->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Tags --}}
                <div class="mb-3">
                    <label class="form-label">Tags (pisahkan dengan koma)</label>
                    <input type="text"
                           name="tags"
                           class="form-control"
                           value="{{ old('tags', $beritum->tags->pluck('name')->implode(',')) }}">
                </div>

                {{-- Status --}}
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="draft" 
                                {{ old('status', $beritum->status) == 'draft' ? 'selected' : '' }}>
                                Draft
                            </option>
                            <option value="published" 
                                {{ old('status', $beritum->status) == 'published' ? 'selected' : '' }}>
                                Published
                            </option>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Scheduled At</label>
                        <input type="datetime-local"
                               name="scheduled_at"
                               class="form-control"
                               value="{{ old('scheduled_at', optional($beritum->scheduled_at)->format('Y-m-d\TH:i')) }}">
                    </div>

                    <div class="col-md-4 mb-3 d-flex align-items-center">
                        <div class="form-check mt-4">
                            <input class="form-check-input"
                                   type="checkbox"
                                   name="is_featured"
                                   value="1"
                                   {{ old('is_featured', $beritum->is_featured) ? 'checked' : '' }}>
                            <label class="form-check-label">
                                Featured
                            </label>
                        </div>
                    </div>
                </div>

                <hr>

                {{-- SEO --}}
                <h6 class="fw-bold">SEO Settings</h6>

                <div class="mb-3">
                    <label class="form-label">Meta Title</label>
                    <input type="text"
                           name="meta_title"
                           class="form-control"
                           value="{{ old('meta_title', $beritum->meta_title) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Meta Description</label>
                    <textarea name="meta_description"
                              class="form-control"
                              rows="2">{{ old('meta_description', $beritum->meta_description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Meta Keywords</label>
                    <input type="text"
                           name="meta_keywords"
                           class="form-control"
                           value="{{ old('meta_keywords', $beritum->meta_keywords) }}">
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.berita.index') }}" 
                       class="btn btn-secondary">
                        Kembali
                    </a>

                    <button type="submit" class="btn btn-success">
                        Update Berita
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection