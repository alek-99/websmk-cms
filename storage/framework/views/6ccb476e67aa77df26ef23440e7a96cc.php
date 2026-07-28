

<?php $__env->startSection('title', 'Edit Berita'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Edit Berita</h5>
        </div>

        <div class="card-body">

            <?php if(session('error')): ?>
                <div class="alert alert-danger">
                    <?php echo e(session('error')); ?>

                </div>
            <?php endif; ?>

            <form action="<?php echo e(route('admin.berita.update', $beritum->id)); ?>" 
                  method="POST" 
                  enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                
                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text" 
                           name="title" 
                           class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           value="<?php echo e(old('title', $beritum->title)); ?>"
                           required>
                    <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div class="mb-3">
                    <label class="form-label">Excerpt</label>
                    <textarea name="excerpt" 
                              class="form-control <?php $__errorArgs = ['excerpt'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                              rows="2"><?php echo e(old('excerpt', $beritum->excerpt)); ?></textarea>
                </div>

                
                <div class="mb-3">
                    <label class="form-label">Konten</label>
                    <textarea name="content" 
                              class="form-control <?php $__errorArgs = ['content'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                              rows="8" required><?php echo e(old('content', $beritum->content)); ?></textarea>
                </div>

                
                <div class="mb-3">
                    <label class="form-label">Featured Image</label>
                    <input type="file" 
                           name="featured_image" 
                           class="form-control <?php $__errorArgs = ['featured_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">

                    <?php if($beritum->featured_image): ?>
                        <div class="mt-2">
                            <img src="<?php echo e(asset('storage/'.$beritum->featured_image)); ?>" 
                                 width="200" 
                                 class="img-thumbnail">
                        </div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label class="form-label">Alt Text Gambar</label>
                    <input type="text" 
                           name="featured_image_alt"
                           class="form-control"
                           value="<?php echo e(old('featured_image_alt', $beritum->featured_image_alt)); ?>">
                </div>

                
                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <div class="row">
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input"
                                           type="checkbox"
                                           name="categories[]"
                                           value="<?php echo e($category->id); ?>"
                                           <?php echo e(in_array($category->id, old('categories', $beritum->categories->pluck('id')->toArray())) ? 'checked' : ''); ?>>
                                    <label class="form-check-label">
                                        <?php echo e($category->name); ?>

                                    </label>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

                
                <div class="mb-3">
                    <label class="form-label">Tags (pisahkan dengan koma)</label>
                    <input type="text"
                           name="tags"
                           class="form-control"
                           value="<?php echo e(old('tags', $beritum->tags->pluck('name')->implode(','))); ?>">
                </div>

                
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="draft" 
                                <?php echo e(old('status', $beritum->status) == 'draft' ? 'selected' : ''); ?>>
                                Draft
                            </option>
                            <option value="published" 
                                <?php echo e(old('status', $beritum->status) == 'published' ? 'selected' : ''); ?>>
                                Published
                            </option>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Scheduled At</label>
                        <input type="datetime-local"
                               name="scheduled_at"
                               class="form-control"
                               value="<?php echo e(old('scheduled_at', optional($beritum->scheduled_at)->format('Y-m-d\TH:i'))); ?>">
                    </div>

                    <div class="col-md-4 mb-3 d-flex align-items-center">
                        <div class="form-check mt-4">
                            <input class="form-check-input"
                                   type="checkbox"
                                   name="is_featured"
                                   value="1"
                                   <?php echo e(old('is_featured', $beritum->is_featured) ? 'checked' : ''); ?>>
                            <label class="form-check-label">
                                Featured
                            </label>
                        </div>
                    </div>
                </div>

                <hr>

                
                <h6 class="fw-bold">SEO Settings</h6>

                <div class="mb-3">
                    <label class="form-label">Meta Title</label>
                    <input type="text"
                           name="meta_title"
                           class="form-control"
                           value="<?php echo e(old('meta_title', $beritum->meta_title)); ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Meta Description</label>
                    <textarea name="meta_description"
                              class="form-control"
                              rows="2"><?php echo e(old('meta_description', $beritum->meta_description)); ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Meta Keywords</label>
                    <input type="text"
                           name="meta_keywords"
                           class="form-control"
                           value="<?php echo e(old('meta_keywords', $beritum->meta_keywords)); ?>">
                </div>

                <div class="d-flex justify-content-between">
                    <a href="<?php echo e(route('admin.berita.index')); ?>" 
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\SMK-MK\resources\views/admin/berita/edit.blade.php ENDPATH**/ ?>