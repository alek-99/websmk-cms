<div class="modal fade" id="modalCreate" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data" id="createForm">
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-plus-circle"></i> Tambah Berita Baru
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <ul class="nav nav-tabs mb-4" role="tablist">
                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#content-tab" type="button">
                                <i class="fas fa-file-alt"></i> Konten
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#media-tab" type="button">
                                <i class="fas fa-image"></i> Media
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#seo-tab" type="button">
                                <i class="fas fa-search"></i> SEO
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#publish-tab" type="button">
                                <i class="fas fa-cog"></i> Pengaturan
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content">
                        {{-- Content Tab --}}
                        <div class="tab-pane fade show active" id="content-tab">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Judul <span class="text-danger">*</span></label>
                                <input type="text" name="title" class="form-control" required id="title-input">
                                <div class="form-text">
                                    <span id="title-length">0</span>/60 karakter
                                    <span id="title-feedback" class="ms-2"></span>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Kategori</label>
                                <div class="row g-2">
                                    @foreach($categories as $cat)
                                        <div class="col-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" 
                                                       type="checkbox" 
                                                       name="categories[]" 
                                                       value="{{ $cat->id }}"
                                                       id="cat-{{ $cat->id }}">
                                                <label class="form-check-label" for="cat-{{ $cat->id }}">
                                                    @if($cat->icon)
                                                        <i class="{{ $cat->icon }}"></i>
                                                    @endif
                                                    {{ $cat->name }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Tags</label>
                                <input type="text" 
                                       name="tags" 
                                       class="form-control" 
                                       placeholder="pisahkan dengan koma, contoh: teknologi, pendidikan, tips">
                                <div class="form-text">Pisahkan setiap tag dengan koma</div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Ringkasan (Excerpt)</label>
                                <textarea name="excerpt" 
                                          class="form-control" 
                                          rows="3" 
                                          maxlength="500"
                                          id="excerpt-input"></textarea>
                                <div class="form-text">
                                    <span id="excerpt-length">0</span>/500 karakter
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Konten <span class="text-danger">*</span></label>
                                <textarea name="content" 
                                          class="form-control" 
                                          rows="15" 
                                          required
                                          id="content-input"></textarea>
                                <div class="form-text mt-2">
                                    <i class="fas fa-info-circle"></i>
                                    <span id="word-count">0</span> kata • 
                                    <span id="read-time">0</span> menit baca
                                </div>
                            </div>
                        </div>

                        {{-- Media Tab --}}
                        <div class="tab-pane fade" id="media-tab">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Gambar Utama</label>
                                <input type="file" 
                                       name="featured_image" 
                                       class="form-control" 
                                       accept="image/*"
                                       onchange="previewImage(event, 'create')">
                                <div class="form-text">
                                    Ukuran maksimal 2MB. Format: JPG, PNG, WebP
                                </div>
                            </div>

                            <div class="mb-3" id="image-preview-create" style="display: none;">
                                <img src="" alt="Preview" class="img-fluid rounded" style="max-height: 300px;">
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Alt Text Gambar</label>
                                <input type="text" 
                                       name="featured_image_alt" 
                                       class="form-control"
                                       placeholder="Deskripsi gambar untuk SEO">
                                <div class="form-text">
                                    Penting untuk SEO dan aksesibilitas
                                </div>
                            </div>
                        </div>

                        {{-- SEO Tab --}}
                        <div class="tab-pane fade" id="seo-tab">
                            <div class="alert alert-info">
                                <i class="fas fa-lightbulb"></i>
                                <strong>Tips SEO:</strong> Jika dikosongkan, sistem akan otomatis mengisi dari judul dan konten
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Meta Title</label>
                                <input type="text" 
                                       name="meta_title" 
                                       class="form-control" 
                                       maxlength="60"
                                       id="meta-title-input">
                                <div class="form-text">
                                    <span id="meta-title-length">0</span>/60 karakter (optimal: 50-60)
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Meta Description</label>
                                <textarea name="meta_description" 
                                          class="form-control" 
                                          rows="3" 
                                          maxlength="155"
                                          id="meta-desc-input"></textarea>
                                <div class="form-text">
                                    <span id="meta-desc-length">0</span>/155 karakter (optimal: 120-155)
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Keywords</label>
                                <input type="text" 
                                       name="meta_keywords" 
                                       class="form-control"
                                       placeholder="keyword1, keyword2, keyword3">
                                <div class="form-text">
                                    Pisahkan setiap keyword dengan koma
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Canonical URL</label>
                                    <input type="url" name="canonical_url" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Robots</label>
                                    <select name="robots" class="form-select">
                                        <option value="index, follow">Index, Follow</option>
                                        <option value="noindex, follow">No Index, Follow</option>
                                        <option value="index, nofollow">Index, No Follow</option>
                                        <option value="noindex, nofollow">No Index, No Follow</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        {{-- Publish Tab --}}
                        <div class="tab-pane fade" id="publish-tab">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Status Publikasi</label>
                                <select name="status" class="form-select" id="status-select">
                                    <option value="draft">Draft</option>
                                    <option value="published">Publish Sekarang</option>
                                </select>
                            </div>

                            <div class="mb-3" id="schedule-group" style="display: none;">
                                <label class="form-label fw-bold">Jadwal Publikasi</label>
                                <input type="datetime-local" 
                                       name="scheduled_at" 
                                       class="form-control">
                                <div class="form-text">
                                    Kosongkan untuk publish langsung
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" 
                                           type="checkbox" 
                                           name="is_featured" 
                                           value="1"
                                           id="is-featured-create">
                                    <label class="form-check-label" for="is-featured-create">
                                        <i class="fas fa-star text-warning"></i>
                                        Jadikan Berita Unggulan
                                    </label>
                                </div>
                                <div class="form-text">
                                    Berita unggulan akan ditampilkan di halaman utama
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Simpan Berita
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
// Character counters
document.addEventListener('DOMContentLoaded', function() {
    // Title counter
    const titleInput = document.getElementById('title-input');
    if (titleInput) {
        titleInput.addEventListener('input', function() {
            const length = this.value.length;
            document.getElementById('title-length').textContent = length;
            
            const feedback = document.getElementById('title-feedback');
            if (length >= 30 && length <= 60) {
                feedback.innerHTML = '<span class="text-success"><i class="fas fa-check"></i> Bagus!</span>';
            } else if (length > 60) {
                feedback.innerHTML = '<span class="text-danger"><i class="fas fa-times"></i> Terlalu panjang</span>';
            } else {
                feedback.innerHTML = '<span class="text-warning"><i class="fas fa-info-circle"></i> Terlalu pendek</span>';
            }
        });
    }

    // Excerpt counter
    const excerptInput = document.getElementById('excerpt-input');
    if (excerptInput) {
        excerptInput.addEventListener('input', function() {
            document.getElementById('excerpt-length').textContent = this.value.length;
        });
    }

    // Meta title counter
    const metaTitleInput = document.getElementById('meta-title-input');
    if (metaTitleInput) {
        metaTitleInput.addEventListener('input', function() {
            document.getElementById('meta-title-length').textContent = this.value.length;
        });
    }

    // Meta description counter
    const metaDescInput = document.getElementById('meta-desc-input');
    if (metaDescInput) {
        metaDescInput.addEventListener('input', function() {
            document.getElementById('meta-desc-length').textContent = this.value.length;
        });
    }

    // Content word count
    const contentInput = document.getElementById('content-input');
    if (contentInput) {
        contentInput.addEventListener('input', function() {
            const text = this.value.replace(/<[^>]*>/g, ''); // Remove HTML tags
            const words = text.trim().split(/\s+/).filter(word => word.length > 0).length;
            const readTime = Math.ceil(words / 200);
            
            document.getElementById('word-count').textContent = words;
            document.getElementById('read-time').textContent = readTime;
        });
    }

    // Status change handler
    const statusSelect = document.getElementById('status-select');
    if (statusSelect) {
        statusSelect.addEventListener('change', function() {
            const scheduleGroup = document.getElementById('schedule-group');
            scheduleGroup.style.display = this.value === 'published' ? 'block' : 'none';
        });
    }
});

// Image preview
function previewImage(event, type) {
    const preview = document.getElementById('image-preview-' + type);
    const img = preview.querySelector('img');
    
    if (event.target.files && event.target.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            img.src = e.target.result;
            preview.style.display = 'block';
        }
        
        reader.readAsDataURL(event.target.files[0]);
    }
}
</script>