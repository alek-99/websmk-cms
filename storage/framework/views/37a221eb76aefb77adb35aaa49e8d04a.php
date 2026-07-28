
<?php $__env->startSection('title', 'Management Kategori Berita'); ?>

<?php $__env->startSection('content'); ?>

<div class="container-fluid mt-4">

    
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body text-center bg-light">
            <i class="fa-solid fa-folder fa-2x mb-2 text-primary"></i>
            <h3 class="fw-bold mb-1">Management Kategori Berita</h3>
            <p class="text-muted mb-0">Kelola kategori dan organisasi berita</p>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">

            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <form method="GET" class="d-flex gap-2" style="flex: 1; max-width: 400px;">
                    <input type="text"
                           name="search"
                           class="form-control"
                           placeholder="Cari kategori..."
                           value="<?php echo e(request('search')); ?>">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-search"></i>
                    </button>
                </form>
                <a href="<?php echo e(route('admin.categories.create')); ?>" class="btn btn-success">
                    <i class="fa-solid fa-plus"></i> Tambah Kategori
                </a>
            </div>

            
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama</th>
                            <th>Slug</th>
                            <th width="8%">Warna</th>
                            <th width="8%">Icon</th>
                            <th width="5%">Order</th>
                            <th width="8%">Status</th>
                            <th width="12%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="text-center"><?php echo e(($categories->currentPage() - 1) * $categories->perPage() + $loop->iteration); ?></td>
                            <td><?php echo e($category->name); ?></td>
                            <td><code><?php echo e($category->slug); ?></code></td>
                            <td class="text-center">
                                <?php if($category->color): ?>
                                    <span class="badge" style="background-color: <?php echo e($category->color); ?>; width: 30px; height: 30px; display: inline-block;"></span>
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if($category->icon): ?>
                                    <i class="<?php echo e($category->icon); ?>"></i>
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center"><?php echo e($category->order); ?></td>
                            <td class="text-center">
                                <?php if($category->is_active): ?>
                                    <span class="badge bg-success">Aktif</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Nonaktif</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <a href="<?php echo e(route('admin.categories.edit', $category)); ?>"
                                   class="btn btn-sm btn-primary"
                                   title="Edit">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <form method="POST"
                                      action="<?php echo e(route('admin.categories.destroy', $category)); ?>"
                                      style="display:inline;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="button"
                                            class="btn btn-sm btn-danger"
                                            onclick="confirmDelete(this)"
                                            title="Hapus">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">
                                <i class="fa-solid fa-inbox fa-2x mb-2 d-block"></i>
                                Belum ada kategori
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            
            <div class="mt-3 d-flex justify-content-end">
                <?php echo e($categories->links()); ?>

            </div>

        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function confirmDelete(btn) {
    Swal.fire({
        title: 'Yakin hapus kategori ini?',
        text: "Data yang dihapus tidak dapat dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#0d6efd',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            btn.closest('form').submit();
        }
    });
}

<?php if(session('success')): ?>
Swal.fire({
    icon: 'success',
    title: 'Berhasil!',
    text: "<?php echo e(session('success')); ?>",
    confirmButtonColor: '#198754',
    timer: 2500,
    showConfirmButton: false
});
<?php endif; ?>

<?php if(session('error')): ?>
Swal.fire({
    icon: 'error',
    title: 'Gagal!',
    text: "<?php echo e(session('error')); ?>",
    confirmButtonColor: '#dc3545'
});
<?php endif; ?>
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\SMK-MK\resources\views/admin/categories/index.blade.php ENDPATH**/ ?>