<?php
    /** @var \App\Models\Pendaftaran|null $row */
    $row      = $row ?? null;
    $mode     = $mode ?? 'create';
    $v        = fn(string $field) => old($field, optional($row)->{$field});
    $isEdit   = $mode === 'edit';
    $agamaList = ['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu'];
    $uid       = 'fp_' . $mode; // unique ID prefix prevents duplicate IDs when included twice
?>

<style>
/* ── FORM PARTIAL — scoped via .form-partial ─────────────────────── */
.form-partial {
    --fp-primary   : #2563eb;
    --fp-border    : #d1d5db;
    --fp-radius    : 8px;
    --fp-text      : #111827;
    --fp-muted     : #6b7280;
    --fp-green-bg  : #f0fdf4;
    --fp-green-bdr : #bbf7d0;
    --fp-green-txt : #16a34a;
}

/* Labels */
.form-partial .form-label {
    font-size:.78rem; font-weight:600; color:#374151; margin-bottom:4px;
}
.form-partial .form-label .req { color:#ef4444; }

/* Controls */
.form-partial .form-control,
.form-partial .form-select {
    border-radius: var(--fp-radius);
    border: 1px solid var(--fp-border);
    font-size:.875rem; padding:.45rem .75rem; background:#fff;
    transition: border-color .15s, box-shadow .15s;
}
.form-partial .form-control:focus,
.form-partial .form-select:focus {
    border-color: var(--fp-primary);
    box-shadow: 0 0 0 3px rgba(37,99,235,.1);
    outline: none;
}
.form-partial .form-control.is-invalid,
.form-partial .form-select.is-invalid { border-color:#dc2626; }
.form-partial .invalid-feedback { font-size:.73rem; }
.form-partial textarea.form-control { resize:vertical; min-height:80px; }

/* Input group */
.form-partial .input-group .input-group-text {
    border-radius:0 var(--fp-radius) var(--fp-radius) 0;
    border-color: var(--fp-border);
    font-size:.8rem; color: var(--fp-muted);
}
.form-partial .input-group .form-control { border-radius: var(--fp-radius) 0 0 var(--fp-radius); }

/* Section divider */
.form-partial .section-divider {
    font-size:.68rem; font-weight:700; letter-spacing:.08em;
    text-transform:uppercase; color:#9ca3af;
    display:flex; align-items:center; gap:.4rem; margin:0;
}
.form-partial .section-divider::after {
    content:''; flex:1; height:1px; background:#e5e7eb;
}

/* Tab nav */
.form-partial .fp-tabs {
    gap:0;
    border-bottom:2px solid #e5e7eb;
    flex-wrap:wrap;
}
.form-partial .fp-tabs .nav-link {
    font-size:.79rem; font-weight:500;
    color: var(--fp-muted);
    border:none; border-radius:0;
    padding:.55rem .9rem; margin-bottom:-2px;
    transition: color .15s, border-color .15s;
    white-space:nowrap;
}
.form-partial .fp-tabs .nav-link:hover { color: var(--fp-primary); background:none; }
.form-partial .fp-tabs .nav-link.active {
    color: var(--fp-primary); background:none;
    border-bottom:2px solid var(--fp-primary); font-weight:600;
}
.form-partial .fp-tabs .nav-link i { font-size:.82rem; }

/* Tab body */
.form-partial .fp-tab-pane { padding-top:1.25rem; }

/* Existing file pill */
.form-partial .file-existing {
    display:inline-flex; align-items:center; gap:5px;
    font-size:.73rem; color: var(--fp-green-txt);
    padding:3px 8px;
    background: var(--fp-green-bg);
    border:1px solid var(--fp-green-bdr);
    border-radius:6px; margin-top:5px;
}
.form-partial .file-existing a { color: var(--fp-green-txt); font-weight:600; }

/* Timestamp info box */
.form-partial .ts-box {
    padding:.8rem 1rem;
    background:#f8fafc; border:1px solid #e5e7eb;
    border-radius: var(--fp-radius);
    font-size:.78rem; color: var(--fp-muted);
    line-height:1.6;
}

/* Required note */
.form-partial .required-note {
    font-size:.73rem; color: var(--fp-muted);
    margin-bottom:1rem;
}
</style>

<div class="form-partial">

    <p class="required-note"><span class="text-danger fw-semibold">*</span> Wajib diisi</p>

    
    <ul class="nav fp-tabs" id="<?php echo e($uid); ?>_tabs" role="tablist">
        <?php
            $tabs = [
                ['id'=>'siswa',   'label'=>'Data Siswa',  'icon'=>'bi-person-fill'],
                ['id'=>'sekolah', 'label'=>'Sekolah Asal','icon'=>'bi-building'],
                ['id'=>'ortu',    'label'=>'Orang Tua',   'icon'=>'bi-people-fill'],
                ['id'=>'berkas',  'label'=>'Berkas',       'icon'=>'bi-paperclip'],
                ['id'=>'status',  'label'=>'Status',       'icon'=>'bi-toggles'],
            ];
        ?>
        <?php $__currentLoopData = $tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $tab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li class="nav-item" role="presentation">
            <button class="nav-link <?php echo e($i === 0 ? 'active' : ''); ?>"
                    id="<?php echo e($uid); ?>_<?php echo e($tab['id']); ?>_tab"
                    data-bs-toggle="tab"
                    data-bs-target="#<?php echo e($uid); ?>_<?php echo e($tab['id']); ?>"
                    type="button" role="tab"
                    aria-controls="<?php echo e($uid); ?>_<?php echo e($tab['id']); ?>"
                    aria-selected="<?php echo e($i === 0 ? 'true' : 'false'); ?>">
                <i class="bi <?php echo e($tab['icon']); ?> me-1"></i><?php echo e($tab['label']); ?>

            </button>
        </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>

    <div class="tab-content" id="<?php echo e($uid); ?>_content">

        
        <div class="tab-pane fade show active fp-tab-pane"
             id="<?php echo e($uid); ?>_siswa" role="tabpanel"
             aria-labelledby="<?php echo e($uid); ?>_siswa_tab">
            <div class="row g-3">

                <div class="col-md-6">
                    <label class="form-label">NISN <span class="req">*</span></label>
                    <input type="text" name="nisn"
                           class="form-control <?php $__errorArgs = ['nisn'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           value="<?php echo e($v('nisn')); ?>"
                           placeholder="10 digit" maxlength="10" required>
                    <?php $__errorArgs = ['nisn'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="col-md-6">
                    <label class="form-label">NIK <span class="req">*</span></label>
                    <input type="text" name="nik"
                           class="form-control <?php $__errorArgs = ['nik'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           value="<?php echo e($v('nik')); ?>"
                           placeholder="16 digit" maxlength="16" required>
                    <?php $__errorArgs = ['nik'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="col-12">
                    <label class="form-label">Nama Lengkap <span class="req">*</span></label>
                    <input type="text" name="nama_lengkap"
                           class="form-control <?php $__errorArgs = ['nama_lengkap'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           value="<?php echo e($v('nama_lengkap')); ?>" required>
                    <?php $__errorArgs = ['nama_lengkap'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Jenis Kelamin <span class="req">*</span></label>
                    <select name="jenis_kelamin"
                            class="form-select <?php $__errorArgs = ['jenis_kelamin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                        <option value="">— Pilih —</option>
                        <option value="laki-laki"  <?php if($v('jenis_kelamin') === 'laki-laki'): echo 'selected'; endif; ?>>Laki-laki</option>
                        <option value="perempuan"  <?php if($v('jenis_kelamin') === 'perempuan'): echo 'selected'; endif; ?>>Perempuan</option>
                    </select>
                    <?php $__errorArgs = ['jenis_kelamin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Tempat Lahir <span class="req">*</span></label>
                    <input type="text" name="tempat_lahir"
                           class="form-control <?php $__errorArgs = ['tempat_lahir'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           value="<?php echo e($v('tempat_lahir')); ?>" required>
                    <?php $__errorArgs = ['tempat_lahir'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Tanggal Lahir <span class="req">*</span></label>
                    <input type="date" name="tanggal_lahir"
                           class="form-control <?php $__errorArgs = ['tanggal_lahir'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           value="<?php echo e($v('tanggal_lahir') ? \Carbon\Carbon::parse($v('tanggal_lahir'))->format('Y-m-d') : ''); ?>"
                           required>
                    <?php $__errorArgs = ['tanggal_lahir'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Agama <span class="req">*</span></label>
                    <select name="agama"
                            class="form-select <?php $__errorArgs = ['agama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                        <option value="">— Pilih —</option>
                        <?php $__currentLoopData = $agamaList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($ag); ?>" <?php if($v('agama') === $ag): echo 'selected'; endif; ?>><?php echo e($ag); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['agama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="col-md-4">
                    <label class="form-label">No. HP <span class="req">*</span></label>
                    <input type="text" name="no_hp"
                           class="form-control <?php $__errorArgs = ['no_hp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           value="<?php echo e($v('no_hp')); ?>" placeholder="08xx..." required>
                    <?php $__errorArgs = ['no_hp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Email</label>
                    <input type="email" name="email"
                           class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           value="<?php echo e($v('email')); ?>" placeholder="opsional">
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="col-12">
                    <label class="form-label">Alamat Lengkap <span class="req">*</span></label>
                    <textarea name="alamat" rows="3"
                              class="form-control <?php $__errorArgs = ['alamat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                              placeholder="Jalan, RT/RW, Kelurahan, Kecamatan, Kota/Kabupaten"
                              required><?php echo e($v('alamat')); ?></textarea>
                    <?php $__errorArgs = ['alamat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

            </div>
        </div>

        
        <div class="tab-pane fade fp-tab-pane"
             id="<?php echo e($uid); ?>_sekolah" role="tabpanel"
             aria-labelledby="<?php echo e($uid); ?>_sekolah_tab">
            <div class="row g-3">

                <div class="col-md-8">
                    <label class="form-label">Nama Sekolah Asal <span class="req">*</span></label>
                    <input type="text" name="asal_sekolah"
                           class="form-control <?php $__errorArgs = ['asal_sekolah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           value="<?php echo e($v('asal_sekolah')); ?>" required>
                    <?php $__errorArgs = ['asal_sekolah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="col-md-4">
                    <label class="form-label">NPSN</label>
                    <input type="text" name="npsn_sekolah"
                           class="form-control <?php $__errorArgs = ['npsn_sekolah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           value="<?php echo e($v('npsn_sekolah')); ?>" placeholder="8 digit, opsional">
                    <?php $__errorArgs = ['npsn_sekolah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Nilai Rata-rata Rapor</label>
                    <div class="input-group">
                        <input type="number" name="nilai_rata_rata" step="0.01" min="0" max="100"
                               class="form-control <?php $__errorArgs = ['nilai_rata_rata'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               value="<?php echo e($v('nilai_rata_rata')); ?>" placeholder="0.00">
                        <span class="input-group-text">/ 100</span>
                    </div>
                    <?php $__errorArgs = ['nilai_rata_rata'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback d-block"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

            </div>
        </div>

        
        <div class="tab-pane fade fp-tab-pane"
             id="<?php echo e($uid); ?>_ortu" role="tabpanel"
             aria-labelledby="<?php echo e($uid); ?>_ortu_tab">
            <div class="row g-3">

                <div class="col-12">
                    <p class="section-divider"><i class="bi bi-person me-1"></i>Data Ayah</p>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Nama Ayah <span class="req">*</span></label>
                    <input type="text" name="nama_ayah"
                           class="form-control <?php $__errorArgs = ['nama_ayah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           value="<?php echo e($v('nama_ayah')); ?>" required>
                    <?php $__errorArgs = ['nama_ayah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Pekerjaan Ayah</label>
                    <input type="text" name="pekerjaan_ayah" class="form-control"
                           value="<?php echo e($v('pekerjaan_ayah')); ?>" placeholder="opsional">
                </div>

                <div class="col-12 mt-1">
                    <p class="section-divider"><i class="bi bi-person me-1"></i>Data Ibu</p>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Nama Ibu <span class="req">*</span></label>
                    <input type="text" name="nama_ibu"
                           class="form-control <?php $__errorArgs = ['nama_ibu'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           value="<?php echo e($v('nama_ibu')); ?>" required>
                    <?php $__errorArgs = ['nama_ibu'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Pekerjaan Ibu</label>
                    <input type="text" name="pekerjaan_ibu" class="form-control"
                           value="<?php echo e($v('pekerjaan_ibu')); ?>" placeholder="opsional">
                </div>

                <div class="col-12 mt-1">
                    <p class="section-divider"><i class="bi bi-telephone me-1"></i>Kontak</p>
                </div>

                <div class="col-md-6">
                    <label class="form-label">No. HP Orang Tua <span class="req">*</span></label>
                    <input type="text" name="no_hp_ortu"
                           class="form-control <?php $__errorArgs = ['no_hp_ortu'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           value="<?php echo e($v('no_hp_ortu')); ?>" placeholder="08xx..." required>
                    <?php $__errorArgs = ['no_hp_ortu'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

            </div>
        </div>

        
        <div class="tab-pane fade fp-tab-pane"
             id="<?php echo e($uid); ?>_berkas" role="tabpanel"
             aria-labelledby="<?php echo e($uid); ?>_berkas_tab">
            <div class="row g-3">

                <?php
                    $berkasFields = [
                        ['name'=>'foto',        'label'=>'Foto Siswa',       'accept'=>'image/*',             'icon'=>'bi-camera'],
                        ['name'=>'scan_kk',     'label'=>'Scan KK',          'accept'=>'.pdf,.jpg,.jpeg,.png','icon'=>'bi-house'],
                        ['name'=>'scan_akta',   'label'=>'Scan Akta Lahir',  'accept'=>'.pdf,.jpg,.jpeg,.png','icon'=>'bi-file-earmark-person'],
                        ['name'=>'scan_ijazah', 'label'=>'Scan Ijazah / SKL','accept'=>'.pdf,.jpg,.jpeg,.png','icon'=>'bi-award'],
                    ];
                ?>

                <?php $__currentLoopData = $berkasFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-6">
                    <label class="form-label">
                        <i class="bi <?php echo e($file['icon']); ?> me-1 text-muted"></i><?php echo e($file['label']); ?>

                    </label>
                    <input type="file" name="<?php echo e($file['name']); ?>"
                           accept="<?php echo e($file['accept']); ?>"
                           class="form-control <?php $__errorArgs = [$file['name']];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    <?php $__errorArgs = [$file['name']];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                    <?php if($isEdit && $row?->{$file['name']}): ?>
                        <span class="file-existing">
                            <i class="bi bi-check-circle-fill"></i>
                            Berkas sudah ada —
                            <a href="<?php echo e(Storage::url($row->{$file['name']})); ?>" target="_blank" rel="noopener">Lihat</a>
                            &nbsp;(unggah baru untuk mengganti)
                        </span>
                    <?php endif; ?>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>
        </div>

        
        <div class="tab-pane fade fp-tab-pane"
             id="<?php echo e($uid); ?>_status" role="tabpanel"
             aria-labelledby="<?php echo e($uid); ?>_status_tab">
            <div class="row g-3">

                <div class="col-md-5">
                    <label class="form-label">Status Pendaftaran</label>
                    <select name="status" class="form-select <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <?php
                            $statusOptions = [
                                'menunggu'     => 'Menunggu',
                                'diverifikasi' => 'Diverifikasi',
                                'diterima'     => 'Diterima',
                                'ditolak'      => 'Ditolak',
                            ];
                            $currentStatus = $v('status') ?: 'menunggu';
                        ?>
                        <?php $__currentLoopData = $statusOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $lbl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($val); ?>" <?php if($currentStatus === $val): echo 'selected'; endif; ?>>
                                <?php echo e($lbl); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <p class="mt-2 mb-0" style="font-size:.73rem;color:#9ca3af">
                        <i class="bi bi-info-circle me-1"></i>
                        Untuk mengubah status saja, gunakan tombol status langsung dari tabel.
                    </p>
                </div>

                <?php if($isEdit && $row): ?>
                <div class="col-12">
                    <div class="ts-box">
                        <div><i class="bi bi-calendar-plus me-1"></i>
                            Didaftarkan pada <strong><?php echo e($row->created_at->isoFormat('D MMMM Y, HH:mm')); ?></strong>
                        </div>
                        <div><i class="bi bi-clock-history me-1"></i>
                            Terakhir diperbarui <strong><?php echo e($row->updated_at->isoFormat('D MMMM Y, HH:mm')); ?></strong>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

            </div>
        </div>

    </div>

    
    <?php if($errors->any()): ?>
    <script>
    (function () {
        const tabMap = {
            siswa  : ['nisn','nik','nama_lengkap','jenis_kelamin','tempat_lahir','tanggal_lahir','agama','no_hp','email','alamat'],
            sekolah: ['asal_sekolah','npsn_sekolah','nilai_rata_rata'],
            ortu   : ['nama_ayah','pekerjaan_ayah','nama_ibu','pekerjaan_ibu','no_hp_ortu'],
            berkas : ['foto','scan_kk','scan_akta','scan_ijazah'],
            status : ['status'],
        };
        const errors = <?php echo json_encode($errors->keys(), 15, 512) ?>;
        for (const [tab, fields] of Object.entries(tabMap)) {
            if (fields.some(f => errors.includes(f))) {
                const el = document.getElementById('<?php echo e($uid); ?>_' + tab + '_tab');
                if (el) { el.click(); break; }
            }
        }
    })();
    </script>
    <?php endif; ?>

</div><?php /**PATH C:\SMK-MK\resources\views/admin/pendaftaran/form.blade.php ENDPATH**/ ?>