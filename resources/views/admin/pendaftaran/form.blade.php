@php
    /** @var \App\Models\Pendaftaran|null $row */
    $row      = $row ?? null;
    $mode     = $mode ?? 'create';
    $v        = fn(string $field) => old($field, optional($row)->{$field});
    $isEdit   = $mode === 'edit';
    $agamaList = ['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu'];
    $uid       = 'fp_' . $mode; // unique ID prefix prevents duplicate IDs when included twice
@endphp

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

    {{-- ── TAB NAV ─────────────────────────────────────────────────── --}}
    <ul class="nav fp-tabs" id="{{ $uid }}_tabs" role="tablist">
        @php
            $tabs = [
                ['id'=>'siswa',   'label'=>'Data Siswa',  'icon'=>'bi-person-fill'],
                ['id'=>'sekolah', 'label'=>'Sekolah Asal','icon'=>'bi-building'],
                ['id'=>'ortu',    'label'=>'Orang Tua',   'icon'=>'bi-people-fill'],
                ['id'=>'berkas',  'label'=>'Berkas',       'icon'=>'bi-paperclip'],
                ['id'=>'status',  'label'=>'Status',       'icon'=>'bi-toggles'],
            ];
        @endphp
        @foreach($tabs as $i => $tab)
        <li class="nav-item" role="presentation">
            <button class="nav-link {{ $i === 0 ? 'active' : '' }}"
                    id="{{ $uid }}_{{ $tab['id'] }}_tab"
                    data-bs-toggle="tab"
                    data-bs-target="#{{ $uid }}_{{ $tab['id'] }}"
                    type="button" role="tab"
                    aria-controls="{{ $uid }}_{{ $tab['id'] }}"
                    aria-selected="{{ $i === 0 ? 'true' : 'false' }}">
                <i class="bi {{ $tab['icon'] }} me-1"></i>{{ $tab['label'] }}
            </button>
        </li>
        @endforeach
    </ul>

    <div class="tab-content" id="{{ $uid }}_content">

        {{-- ══════════════════════════════════════════════════════════════
             TAB 1 · DATA SISWA
        ══════════════════════════════════════════════════════════════ --}}
        <div class="tab-pane fade show active fp-tab-pane"
             id="{{ $uid }}_siswa" role="tabpanel"
             aria-labelledby="{{ $uid }}_siswa_tab">
            <div class="row g-3">

                <div class="col-md-6">
                    <label class="form-label">NISN <span class="req">*</span></label>
                    <input type="text" name="nisn"
                           class="form-control @error('nisn') is-invalid @enderror"
                           value="{{ $v('nisn') }}"
                           placeholder="10 digit" maxlength="10" required>
                    @error('nisn')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">NIK <span class="req">*</span></label>
                    <input type="text" name="nik"
                           class="form-control @error('nik') is-invalid @enderror"
                           value="{{ $v('nik') }}"
                           placeholder="16 digit" maxlength="16" required>
                    @error('nik')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-12">
                    <label class="form-label">Nama Lengkap <span class="req">*</span></label>
                    <input type="text" name="nama_lengkap"
                           class="form-control @error('nama_lengkap') is-invalid @enderror"
                           value="{{ $v('nama_lengkap') }}" required>
                    @error('nama_lengkap')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label">Jenis Kelamin <span class="req">*</span></label>
                    <select name="jenis_kelamin"
                            class="form-select @error('jenis_kelamin') is-invalid @enderror" required>
                        <option value="">— Pilih —</option>
                        <option value="laki-laki"  @selected($v('jenis_kelamin') === 'laki-laki')>Laki-laki</option>
                        <option value="perempuan"  @selected($v('jenis_kelamin') === 'perempuan')>Perempuan</option>
                    </select>
                    @error('jenis_kelamin')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label">Tempat Lahir <span class="req">*</span></label>
                    <input type="text" name="tempat_lahir"
                           class="form-control @error('tempat_lahir') is-invalid @enderror"
                           value="{{ $v('tempat_lahir') }}" required>
                    @error('tempat_lahir')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label">Tanggal Lahir <span class="req">*</span></label>
                    <input type="date" name="tanggal_lahir"
                           class="form-control @error('tanggal_lahir') is-invalid @enderror"
                           value="{{ $v('tanggal_lahir') ? \Carbon\Carbon::parse($v('tanggal_lahir'))->format('Y-m-d') : '' }}"
                           required>
                    @error('tanggal_lahir')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label">Agama <span class="req">*</span></label>
                    <select name="agama"
                            class="form-select @error('agama') is-invalid @enderror" required>
                        <option value="">— Pilih —</option>
                        @foreach($agamaList as $ag)
                            <option value="{{ $ag }}" @selected($v('agama') === $ag)>{{ $ag }}</option>
                        @endforeach
                    </select>
                    @error('agama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label">No. HP <span class="req">*</span></label>
                    <input type="text" name="no_hp"
                           class="form-control @error('no_hp') is-invalid @enderror"
                           value="{{ $v('no_hp') }}" placeholder="08xx..." required>
                    @error('no_hp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label">Email</label>
                    <input type="email" name="email"
                           class="form-control @error('email') is-invalid @enderror"
                           value="{{ $v('email') }}" placeholder="opsional">
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-12">
                    <label class="form-label">Alamat Lengkap <span class="req">*</span></label>
                    <textarea name="alamat" rows="3"
                              class="form-control @error('alamat') is-invalid @enderror"
                              placeholder="Jalan, RT/RW, Kelurahan, Kecamatan, Kota/Kabupaten"
                              required>{{ $v('alamat') }}</textarea>
                    @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

            </div>
        </div>

        {{-- ══════════════════════════════════════════════════════════════
             TAB 2 · SEKOLAH ASAL
        ══════════════════════════════════════════════════════════════ --}}
        <div class="tab-pane fade fp-tab-pane"
             id="{{ $uid }}_sekolah" role="tabpanel"
             aria-labelledby="{{ $uid }}_sekolah_tab">
            <div class="row g-3">

                <div class="col-md-8">
                    <label class="form-label">Nama Sekolah Asal <span class="req">*</span></label>
                    <input type="text" name="asal_sekolah"
                           class="form-control @error('asal_sekolah') is-invalid @enderror"
                           value="{{ $v('asal_sekolah') }}" required>
                    @error('asal_sekolah')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label">NPSN</label>
                    <input type="text" name="npsn_sekolah"
                           class="form-control @error('npsn_sekolah') is-invalid @enderror"
                           value="{{ $v('npsn_sekolah') }}" placeholder="8 digit, opsional">
                    @error('npsn_sekolah')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label">Nilai Rata-rata Rapor</label>
                    <div class="input-group">
                        <input type="number" name="nilai_rata_rata" step="0.01" min="0" max="100"
                               class="form-control @error('nilai_rata_rata') is-invalid @enderror"
                               value="{{ $v('nilai_rata_rata') }}" placeholder="0.00">
                        <span class="input-group-text">/ 100</span>
                    </div>
                    @error('nilai_rata_rata')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                </div>

            </div>
        </div>

        {{-- ══════════════════════════════════════════════════════════════
             TAB 3 · ORANG TUA
        ══════════════════════════════════════════════════════════════ --}}
        <div class="tab-pane fade fp-tab-pane"
             id="{{ $uid }}_ortu" role="tabpanel"
             aria-labelledby="{{ $uid }}_ortu_tab">
            <div class="row g-3">

                <div class="col-12">
                    <p class="section-divider"><i class="bi bi-person me-1"></i>Data Ayah</p>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Nama Ayah <span class="req">*</span></label>
                    <input type="text" name="nama_ayah"
                           class="form-control @error('nama_ayah') is-invalid @enderror"
                           value="{{ $v('nama_ayah') }}" required>
                    @error('nama_ayah')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Pekerjaan Ayah</label>
                    <input type="text" name="pekerjaan_ayah" class="form-control"
                           value="{{ $v('pekerjaan_ayah') }}" placeholder="opsional">
                </div>

                <div class="col-12 mt-1">
                    <p class="section-divider"><i class="bi bi-person me-1"></i>Data Ibu</p>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Nama Ibu <span class="req">*</span></label>
                    <input type="text" name="nama_ibu"
                           class="form-control @error('nama_ibu') is-invalid @enderror"
                           value="{{ $v('nama_ibu') }}" required>
                    @error('nama_ibu')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Pekerjaan Ibu</label>
                    <input type="text" name="pekerjaan_ibu" class="form-control"
                           value="{{ $v('pekerjaan_ibu') }}" placeholder="opsional">
                </div>

                <div class="col-12 mt-1">
                    <p class="section-divider"><i class="bi bi-telephone me-1"></i>Kontak</p>
                </div>

                <div class="col-md-6">
                    <label class="form-label">No. HP Orang Tua <span class="req">*</span></label>
                    <input type="text" name="no_hp_ortu"
                           class="form-control @error('no_hp_ortu') is-invalid @enderror"
                           value="{{ $v('no_hp_ortu') }}" placeholder="08xx..." required>
                    @error('no_hp_ortu')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

            </div>
        </div>

        {{-- ══════════════════════════════════════════════════════════════
             TAB 4 · BERKAS
        ══════════════════════════════════════════════════════════════ --}}
        <div class="tab-pane fade fp-tab-pane"
             id="{{ $uid }}_berkas" role="tabpanel"
             aria-labelledby="{{ $uid }}_berkas_tab">
            <div class="row g-3">

                @php
                    $berkasFields = [
                        ['name'=>'foto',        'label'=>'Foto Siswa',       'accept'=>'image/*',             'icon'=>'bi-camera'],
                        ['name'=>'scan_kk',     'label'=>'Scan KK',          'accept'=>'.pdf,.jpg,.jpeg,.png','icon'=>'bi-house'],
                        ['name'=>'scan_akta',   'label'=>'Scan Akta Lahir',  'accept'=>'.pdf,.jpg,.jpeg,.png','icon'=>'bi-file-earmark-person'],
                        ['name'=>'scan_ijazah', 'label'=>'Scan Ijazah / SKL','accept'=>'.pdf,.jpg,.jpeg,.png','icon'=>'bi-award'],
                    ];
                @endphp

                @foreach($berkasFields as $file)
                <div class="col-md-6">
                    <label class="form-label">
                        <i class="bi {{ $file['icon'] }} me-1 text-muted"></i>{{ $file['label'] }}
                    </label>
                    <input type="file" name="{{ $file['name'] }}"
                           accept="{{ $file['accept'] }}"
                           class="form-control @error($file['name']) is-invalid @enderror">
                    @error($file['name'])<div class="invalid-feedback">{{ $message }}</div>@enderror

                    @if($isEdit && $row?->{$file['name']})
                        <span class="file-existing">
                            <i class="bi bi-check-circle-fill"></i>
                            Berkas sudah ada —
                            <a href="{{ Storage::url($row->{$file['name']}) }}" target="_blank" rel="noopener">Lihat</a>
                            &nbsp;(unggah baru untuk mengganti)
                        </span>
                    @endif
                </div>
                @endforeach

            </div>
        </div>

        {{-- ══════════════════════════════════════════════════════════════
             TAB 5 · STATUS
        ══════════════════════════════════════════════════════════════ --}}
        <div class="tab-pane fade fp-tab-pane"
             id="{{ $uid }}_status" role="tabpanel"
             aria-labelledby="{{ $uid }}_status_tab">
            <div class="row g-3">

                <div class="col-md-5">
                    <label class="form-label">Status Pendaftaran</label>
                    <select name="status" class="form-select @error('status') is-invalid @enderror">
                        @php
                            $statusOptions = [
                                'menunggu'     => 'Menunggu',
                                'diverifikasi' => 'Diverifikasi',
                                'diterima'     => 'Diterima',
                                'ditolak'      => 'Ditolak',
                            ];
                            $currentStatus = $v('status') ?: 'menunggu';
                        @endphp
                        @foreach($statusOptions as $val => $lbl)
                            <option value="{{ $val }}" @selected($currentStatus === $val)>
                                {{ $lbl }}
                            </option>
                        @endforeach
                    </select>
                    @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    <p class="mt-2 mb-0" style="font-size:.73rem;color:#9ca3af">
                        <i class="bi bi-info-circle me-1"></i>
                        Untuk mengubah status saja, gunakan tombol status langsung dari tabel.
                    </p>
                </div>

                @if($isEdit && $row)
                <div class="col-12">
                    <div class="ts-box">
                        <div><i class="bi bi-calendar-plus me-1"></i>
                            Didaftarkan pada <strong>{{ $row->created_at->isoFormat('D MMMM Y, HH:mm') }}</strong>
                        </div>
                        <div><i class="bi bi-clock-history me-1"></i>
                            Terakhir diperbarui <strong>{{ $row->updated_at->isoFormat('D MMMM Y, HH:mm') }}</strong>
                        </div>
                    </div>
                </div>
                @endif

            </div>
        </div>

    </div>{{-- /tab-content --}}

    {{-- ── Jump to first error tab on page load ──────────────────── --}}
    @if($errors->any())
    <script>
    (function () {
        const tabMap = {
            siswa  : ['nisn','nik','nama_lengkap','jenis_kelamin','tempat_lahir','tanggal_lahir','agama','no_hp','email','alamat'],
            sekolah: ['asal_sekolah','npsn_sekolah','nilai_rata_rata'],
            ortu   : ['nama_ayah','pekerjaan_ayah','nama_ibu','pekerjaan_ibu','no_hp_ortu'],
            berkas : ['foto','scan_kk','scan_akta','scan_ijazah'],
            status : ['status'],
        };
        const errors = @json($errors->keys());
        for (const [tab, fields] of Object.entries(tabMap)) {
            if (fields.some(f => errors.includes(f))) {
                const el = document.getElementById('{{ $uid }}_' + tab + '_tab');
                if (el) { el.click(); break; }
            }
        }
    })();
    </script>
    @endif

</div>{{-- /form-partial --}}