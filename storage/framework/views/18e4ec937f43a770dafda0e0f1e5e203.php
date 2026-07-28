
<?php $__env->startSection('title', 'Management Pesan'); ?>

<?php $__env->startSection('content'); ?>

<div class="container-fluid mt-4">

    
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body text-center bg-light">
            <i class="fa-solid fa-envelope fa-2x mb-2 text-primary"></i>
            <h3 class="fw-bold mb-1">Management Pesan</h3>
            <p class="text-muted mb-0">Lihat Pesan dari pengunjung website</p>
        </div>
    </div>

    <form id="bulk-delete-form" action="<?php echo e(route('admin.messages.bulkDelete')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('DELETE'); ?>

        <div class="card shadow-sm border-0">
            <div class="card-body">

                
                <div class="d-flex justify-content-between align-items-center mb-3">

                    <button type="button"
                            onclick="confirmBulkDelete()"
                            class="btn btn-danger">
                        <i class="fa-solid fa-trash"></i> Hapus Terpilih
                    </button>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="selectAll">
                        <label class="form-check-label" for="selectAll">
                            Pilih Semua
                        </label>
                    </div>

                </div>

                
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-light text-center">
                            <tr>
                                <th width="5%">Pilih</th>
                                <th width="5%">No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>No WA</th>
                                <th>Pesan</th>
                                <th width="12%">Tanggal</th>
                                <th width="8%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="text-center">
                                    <input type="checkbox"
                                           name="ids[]"
                                           value="<?php echo e($message->id); ?>"
                                           class="form-check-input message-checkbox">
                                </td>
                                <td class="text-center"><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e($message->nama); ?></td>
                                <td><?php echo e($message->email); ?></td>
                                <td><?php echo e($message->no_wa); ?></td>
                                <td><?php echo e(Str::limit($message->pesan, 50)); ?></td>
                                <td class="text-center">
                                    <?php echo e($message->created_at->format('d M Y')); ?>

                                </td>
                                <td class="text-center">
                                    <button
                                        type="button"
                                        class="btn btn-sm btn-primary"
                                        onclick="showMessageModal(
                                            <?php echo \Illuminate\Support\Js::from($message->nama)->toHtml() ?>,
                                            <?php echo \Illuminate\Support\Js::from($message->email)->toHtml() ?>,
                                            <?php echo \Illuminate\Support\Js::from($message->no_wa)->toHtml() ?>,
                                            <?php echo \Illuminate\Support\Js::from($message->pesan)->toHtml() ?>,
                                            '<?php echo e($message->created_at->format('d M Y H:i')); ?>'
                                        )">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>

                
                <div class="mt-3 d-flex justify-content-end">
                    <?php echo e($messages->links()); ?>

                </div>

            </div>
        </div>
    </form>

</div>



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.getElementById('selectAll').addEventListener('change', function() {
    const checkboxes = document.querySelectorAll('.message-checkbox');
    checkboxes.forEach(cb => cb.checked = this.checked);
});

function confirmBulkDelete() {
    const checked = document.querySelectorAll('.message-checkbox:checked');

    if (checked.length === 0) {
        Swal.fire({
            icon: 'warning',
            title: 'Pilih minimal 1 pesan!',
            confirmButtonColor: '#0d6efd'
        });
        return;
    }

    Swal.fire({
        title: 'Yakin hapus pesan terpilih?',
        text: "Semua pesan terpilih akan dihapus permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#0d6efd',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('bulk-delete-form').submit();
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
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\SMK-MK\resources\views/admin/messages/index.blade.php ENDPATH**/ ?>