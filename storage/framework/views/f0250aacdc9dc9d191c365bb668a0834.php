
<?php $__env->startSection('content'); ?>

<div class="container-fluid mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Management Berita</h3>
            <p class="text-muted mb-0">Kelola konten berita dan artikel</p>
        </div>

        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreate">
            <i class="fas fa-plus"></i> Tambah Berita
        </button>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i><?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i><?php echo e(session('error')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="<?php echo e(route('admin.berita.index')); ?>" id="filterForm">
                <div class="row g-3">
                    <div class="col-md-3">
                        <input type="text" 
                               name="search" 
                               class="form-control" 
                               placeholder="Cari berita..."
                               value="<?php echo e(request('search')); ?>">
                    </div>
                    <div class="col-md-2">
                        <select name="status" class="form-select">
                            <option value="">Semua Status</option>
                            <option value="published" <?php echo e(request('status') == 'published' ? 'selected' : ''); ?>>Published</option>
                            <option value="draft" <?php echo e(request('status') == 'draft' ? 'selected' : ''); ?>>Draft</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="category" class="form-select">
                            <option value="">Semua Kategori</option>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($cat->slug); ?>" <?php echo e(request('category') == $cat->slug ? 'selected' : ''); ?>>
                                    <?php echo e($cat->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="sort" class="form-select">
                            <option value="created_at" <?php echo e(request('sort') == 'created_at' ? 'selected' : ''); ?>>Terbaru</option>
                            <option value="views" <?php echo e(request('sort') == 'views' ? 'selected' : ''); ?>>Populer</option>
                            <option value="title" <?php echo e(request('sort') == 'title' ? 'selected' : ''); ?>>Judul</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-filter"></i> Filter
                        </button>
                        <a href="<?php echo e(route('admin.berita.index')); ?>" class="btn btn-outline-secondary">
                            <i class="fas fa-redo"></i> Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    
    <div class="card shadow-sm mb-3" id="bulkActionsCard" style="display: none;">
        <div class="card-body py-2">
            <form method="POST" action="<?php echo e(route('admin.berita.bulk-action')); ?>" id="bulkActionForm">
                <?php echo csrf_field(); ?>
                <div class="d-flex align-items-center gap-3">
                    <span class="text-muted">
                        <span id="selectedCount">0</span> item dipilih
                    </span>
                    <input type="hidden" name="ids" id="bulkIds">
                    <select name="action" class="form-select form-select-sm" style="width: auto;" required>
                        <option value="">Pilih Aksi</option>
                        <option value="publish">Publish</option>
                        <option value="draft">Jadikan Draft</option>
                        <option value="feature">Jadikan Unggulan</option>
                        <option value="unfeature">Hapus dari Unggulan</option>
                        <option value="delete" class="text-danger">Hapus</option>
                    </select>
                    <button type="submit" class="btn btn-sm btn-primary">
                        <i class="fas fa-check"></i> Terapkan
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="clearSelection()">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>

    
    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="40">
                            <input type="checkbox" class="form-check-input" id="selectAll">
                        </th>
                        <th>Berita</th>
                        <th>Kategori</th>
                        <th>Penulis</th>
                        <th>Status</th>
                        <th>SEO</th>
                        <th>Statistik</th>
                        <th width="180">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $beritas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td>
                            <input type="checkbox" class="form-check-input row-checkbox" value="<?php echo e($b->id); ?>">
                        </td>
                        <td>
                            <div class="d-flex align-items-start">
                                <?php if($b->featured_image): ?>
                                    <img src="<?php echo e(asset('storage/'.$b->featured_image)); ?>" 
                                         class="rounded me-3" 
                                         style="width: 60px; height: 60px; object-fit: cover;">
                                <?php else: ?>
                                    <div class="bg-light rounded me-3 d-flex align-items-center justify-content-center" 
                                         style="width: 60px; height: 60px;">
                                        <i class="fas fa-image text-muted"></i>
                                    </div>
                                <?php endif; ?>
                                <div>
                                    <div class="fw-bold"><?php echo e(Str::limit($b->title, 50)); ?></div>
                                    <?php if($b->is_featured): ?>
                                        <span class="badge bg-warning text-dark">
                                            <i class="fas fa-star"></i> Unggulan
                                        </span>
                                    <?php endif; ?>
                                    <div class="small text-muted mt-1">
                                        <?php echo e($b->reading_time_minutes); ?> menit baca
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <?php $__currentLoopData = $b->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span class="badge" style="background-color: <?php echo e($cat->color ?? '#6c757d'); ?>">
                                    <?php if($cat->icon): ?>
                                        <i class="<?php echo e($cat->icon); ?>"></i>
                                    <?php endif; ?>
                                    <?php echo e($cat->name); ?>

                                </span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </td>
                        <td>
                            <div class="small">
                                <i class="fas fa-user text-muted"></i>
                                <?php echo e($b->author->name ?? 'N/A'); ?>

                            </div>
                            <?php if($b->editor): ?>
                                <div class="small text-muted">
                                    <i class="fas fa-edit"></i> <?php echo e($b->editor->name); ?>

                                </div>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($b->status == 'published'): ?>
                                <?php if($b->published_at > now()): ?>
                                    <span class="badge bg-info">
                                        <i class="fas fa-clock"></i> Terjadwal
                                    </span>
                                    <div class="small text-muted mt-1">
                                        <?php echo e($b->published_at->format('d M Y H:i')); ?>

                                    </div>
                                <?php else: ?>
                                    <span class="badge bg-success">
                                        <i class="fas fa-check"></i> Published
                                    </span>
                                    <div class="small text-muted mt-1">
                                        <?php echo e($b->published_at->format('d M Y')); ?>

                                    </div>
                                <?php endif; ?>
                            <?php else: ?>
                                <span class="badge bg-secondary">
                                    <i class="fas fa-file"></i> Draft
                                </span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php
                                $seoScore = $b->seo_score['percentage'] ?? 0;
                                $seoColor = $seoScore >= 80 ? 'success' : ($seoScore >= 60 ? 'warning' : 'danger');
                            ?>
                            <div class="d-flex align-items-center">
                                <div class="progress flex-grow-1 me-2" style="height: 8px; width: 60px;">
                                    <div class="progress-bar bg-<?php echo e($seoColor); ?>" 
                                         role="progressbar" 
                                         style="width: <?php echo e($seoScore); ?>%"
                                         aria-valuenow="<?php echo e($seoScore); ?>" 
                                         aria-valuemin="0" 
                                         aria-valuemax="100">
                                    </div>
                                </div>
                                <span class="badge bg-<?php echo e($seoColor); ?>"><?php echo e($seoScore); ?>%</span>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <span class="badge bg-info" title="Views">
                                    <i class="fas fa-eye"></i> <?php echo e(number_format($b->views)); ?>

                                </span>
                                <span class="badge bg-primary" title="Shares">
                                    <i class="fas fa-share"></i> <?php echo e(number_format($b->shares)); ?>

                                </span>
                            </div>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle" 
                                        data-bs-toggle="dropdown">
                                    <i class="fas fa-cog"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" 
                                           href="<?php echo e(route('berita.show', $b->slug)); ?>" 
                                           target="_blank">
                                            <i class="fas fa-eye"></i> Lihat
                                        </a>
                                    </li>
                                    <li>
                                      <a class="dropdown-item" 
                                           href="<?php echo e(route('admin.berita.edit', $b->id)); ?>" 
                                           target="_blank">
                                            <i class="fas fa-pen"></i> Edit
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" 
                                           href="<?php echo e(route('admin.berita.analytics', $b->id)); ?>">
                                            <i class="fas fa-chart-line"></i> Analytics
                                        </a>
                                    </li>
                                    <li>
                                        <form method="POST" 
                                              action="<?php echo e(route('admin.berita.duplicate', $b->id)); ?>" 
                                              class="d-inline">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="dropdown-item">
                                                <i class="fas fa-copy"></i> Duplikat
                                            </button>
                                        </form>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <button class="dropdown-item text-danger" 
                                                onclick="deleteData(<?php echo e($b->id); ?>)">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </li>
                                </ul>
                            </div>

                            <form id="delete-form-<?php echo e($b->id); ?>"
                                  action="<?php echo e(route('admin.berita.destroy', $b->id)); ?>"
                                  method="POST" class="d-none">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                            </form>
                        </td>
                    </tr>

                    
                    

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="8" class="text-center py-5">
                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Belum ada berita</p>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3 d-flex justify-content-between align-items-center">
        <div class="text-muted">
            Menampilkan <?php echo e($beritas->firstItem() ?? 0); ?> - <?php echo e($beritas->lastItem() ?? 0); ?> 
            dari <?php echo e($beritas->total()); ?> berita
        </div>
        <div>
            <?php echo e($beritas->links()); ?>

        </div>
    </div>

</div>


<?php echo $__env->make('admin.berita.modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5/dist/js/bootstrap.bundle.min.js"></script>
<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
// Delete confirmation
function deleteData(id){
    Swal.fire({
        title: 'Yakin hapus berita?',
        text: "Data tidak bisa dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-'+id).submit();
        }
    });
}

// Bulk selection
const selectAll = document.getElementById('selectAll');
const rowCheckboxes = document.querySelectorAll('.row-checkbox');
const bulkActionsCard = document.getElementById('bulkActionsCard');
const selectedCount = document.getElementById('selectedCount');
const bulkIds = document.getElementById('bulkIds');

selectAll.addEventListener('change', function() {
    rowCheckboxes.forEach(cb => {
        cb.checked = this.checked;
    });
    updateBulkActions();
});

rowCheckboxes.forEach(cb => {
    cb.addEventListener('change', updateBulkActions);
});

function updateBulkActions() {
    const selected = Array.from(rowCheckboxes).filter(cb => cb.checked);
    const count = selected.length;
    
    if (count > 0) {
        bulkActionsCard.style.display = 'block';
        selectedCount.textContent = count;
        bulkIds.value = selected.map(cb => cb.value).join(',');
    } else {
        bulkActionsCard.style.display = 'none';
    }
    
    selectAll.checked = count === rowCheckboxes.length;
}

function clearSelection() {
    rowCheckboxes.forEach(cb => cb.checked = false);
    selectAll.checked = false;
    updateBulkActions();
}

// Form submission confirmation
document.getElementById('bulkActionForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const action = this.querySelector('[name="action"]').value;
    let message = 'Terapkan aksi ini ke item yang dipilih?';
    
    if (action === 'delete') {
        message = 'Yakin ingin menghapus item yang dipilih? Data tidak bisa dikembalikan!';
    }
    
    Swal.fire({
        title: 'Konfirmasi',
        text: message,
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Ya, Lanjutkan',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
        }
    });
});

// Auto-submit on filter change
document.querySelectorAll('#filterForm select').forEach(select => {
    select.addEventListener('change', () => {
        document.getElementById('filterForm').submit();
    });
});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\SMK-MK\resources\views/admin/berita/index.blade.php ENDPATH**/ ?>