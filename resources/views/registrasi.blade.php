<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Pendaftaran Siswa Baru | SMK Maulana Hasanuddin</title>

    {{-- SEO --}}
    <meta name="description" content="Formulir pendaftaran siswa baru SMK Maulana Hasanuddin. Daftar sekarang dan raih masa depan terbaikmu.">

    {{-- OPEN GRAPH --}}
    <meta property="og:title" content="Pendaftaran Siswa Baru SMK Maulana Hasanuddin">
    <meta property="og:description" content="Isi formulir pendaftaran siswa baru dengan mudah dan cepat.">
    <meta property="og:image" content="{{ asset('storage/images/Logo Smk MH.png') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    {{-- FAVICON --}}
    <link rel="icon" href="{{ asset('storage/images/Logo Smk MH.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root{
            --biru-tua:#0b2f6b;
            --biru:#1e40af;
            --kuning:#facc15;
        }

        body{ background:#eef1f6; }

        /* ── FRAME ala aplikasi mobile, tapi tetap melar responsive ── */
        .app-shell{
            max-width:480px;
            margin:0 auto;
            min-height:100vh;
            background:#fff;
            position:relative;
            box-shadow:0 0 40px rgba(0,0,0,.08);
        }
        @media (min-width:768px){
            .app-shell{ margin:2rem auto; border-radius:28px; overflow:hidden; min-height:auto; }
        }

        /* ── HEADER ── */
        .app-header{
            background:linear-gradient(135deg,var(--biru-tua),var(--biru));
            padding:1.5rem 1.25rem 3.5rem;
            color:#fff;
            position:relative;
        }
        .app-header .logo-badge{
            width:44px;height:44px;border-radius:12px;
            background:#fff;display:flex;align-items:center;justify-content:center;
            overflow:hidden;flex-shrink:0;
        }
        .app-header .logo-badge img{ width:100%;height:100%;object-fit:cover; }
        .burger{
            width:36px;height:36px;border-radius:10px;
            background:rgba(255,255,255,.12);
            display:flex;align-items:center;justify-content:center;
        }

        /* ── CARD FORM (menimpa header) ── */
        .form-card{
            background:#fff;
            border-radius:26px 26px 0 0;
            margin-top:-2rem;
            position:relative;
            z-index:2;
            padding:1.5rem 1.25rem 2rem;
        }

        .section-icon{
            width:34px;height:34px;border-radius:10px;
            display:flex;align-items:center;justify-content:center;
            flex-shrink:0;
        }
        .icon-siswa{ background:#dbeafe; color:#1d4ed8; }
        .icon-ortu{ background:#dcfce7; color:#16a34a; }
        .icon-sekolah{ background:#f3e8ff; color:#9333ea; }
        .icon-berkas{ background:#ffedd5; color:#ea580c; }

        .field-label{
            font-size:.75rem;font-weight:600;color:#475569;
            margin-bottom:.3rem;display:block;
        }
        .field-input{
            width:100%;
            border:1px solid #e2e8f0;
            border-radius:10px;
            padding:.6rem .8rem;
            font-size:.875rem;
            background:#f8fafc;
            transition:border-color .15s,box-shadow .15s;
        }
        .field-input:focus{
            outline:none;
            border-color:var(--biru);
            box-shadow:0 0 0 3px rgba(30,64,175,.12);
            background:#fff;
        }
        .field-input.border-red-500{ border-color:#ef4444; background:#fef2f2; }

        /* ── ACCORDION ── */
        .accordion-item{
            border:1px solid #e2e8f0;
            border-radius:14px;
            overflow:hidden;
        }
        .accordion-btn{
            width:100%;
            display:flex;align-items:center;gap:.7rem;
            padding:.9rem 1rem;
            background:#fff;
            cursor:pointer;
            border:none;
            text-align:left;
        }
        .accordion-btn .chevron{
            margin-left:auto;
            transition:transform .2s ease;
            color:#94a3b8;
        }
        .accordion-btn[aria-expanded="true"] .chevron{ transform:rotate(180deg); }
        .accordion-panel{
            max-height:0;
            overflow:hidden;
            transition:max-height .25s ease;
            background:#f8fafc;
        }
        .accordion-panel .inner{ padding:1rem; display:flex; flex-direction:column; gap:.9rem; }

        .btn-utama{
            width:100%;
            background:linear-gradient(135deg,var(--biru-tua),var(--biru));
            color:#fff;font-weight:600;font-size:.9rem;
            padding:.85rem;border-radius:12px;border:none;
            display:flex;align-items:center;justify-content:center;gap:.5rem;
            box-shadow:0 6px 16px rgba(30,64,175,.28);
        }
        .btn-reset{
            width:100%;
            background:#fff;color:var(--biru);font-weight:600;font-size:.85rem;
            padding:.75rem;border-radius:12px;border:1px solid #dbeafe;
            display:flex;align-items:center;justify-content:center;gap:.4rem;
        }
    </style>
</head>

<body>

<div class="app-shell">

    {{-- ── HEADER ── --}}
    <div class="app-header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="logo-badge">
                    <img src="{{ asset('storage/images/Logo Smk MH.png') }}" alt="Logo">
                </div>
                <div>
                    <p class="text-[11px] uppercase tracking-wide opacity-70">Penerimaan Siswa Baru</p>
                    <h1 class="font-bold text-sm leading-tight">SMK Maulana Hasanuddin</h1>
                </div>
            </div>
          <a href="{{ route('welcome') }}" class="burger" aria-label="Kembali ke website">
    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
        <line x1="19" y1="12" x2="5" y2="12"></line>
        <polyline points="12 19 5 12 12 5"></polyline>
    </svg>
</a>
        </div>

        <span class="inline-block mt-4 text-[11px] font-semibold px-3 py-1 rounded-full" style="background:var(--kuning);color:#1f2937">
            Tahun Ajaran {{ date('Y') }}/{{ date('Y')+1 }}
        </span>
    </div>

    {{-- ── CARD FORM ── --}}
    <div class="form-card">

        {{-- SUCCESS --}}
        @if(session('success'))
            <div class="mb-5 p-3 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm">
                {{ session('success') }}
            </div>
        @endif

        {{-- ERROR --}}
        @if($errors->any())
            <div class="mb-5 p-3 bg-red-50 border border-red-200 text-red-700 rounded-xl text-sm">
                <ul class="list-disc ml-4">
                    @foreach($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="flex items-start justify-between gap-3 mb-6">
            <div>
                <h2 class="text-lg font-bold text-blue-900 leading-snug">Formulir Pendaftaran<br>Siswa Baru</h2>
                <p class="text-xs text-slate-500 mt-1">Lengkapi data berikut dengan benar</p>
            </div>
            <div style="width:96px;height:96px;flex-shrink:0">
                <img src="{{ asset('storage/images/icon_sekolah.png') }}" alt="Ilustrasi Siswa"
                     style="width:100%;height:100%;object-fit:contain">
            </div>
        </div>

        <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            {{-- ══════════════ DATA SISWA (selalu terbuka) ══════════════ --}}
            <div class="flex items-center gap-2 mb-1">
                <div class="section-icon icon-siswa"><i class="bi bi-person-fill"></i></div>
                <h3 class="font-semibold text-blue-900 text-sm">Data Siswa</h3>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="field-label">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" placeholder="Masukkan nama lengkap"
                        class="field-input @error('nama_lengkap') border-red-500 @enderror"
                        value="{{ old('nama_lengkap') }}">
                </div>

                <div>
                    <label class="field-label">NISN</label>
                    <input type="text" name="nisn" placeholder="Masukkan NISN"
                        class="field-input @error('nisn') border-red-500 @enderror"
                        value="{{ old('nisn') }}">
                </div>

                <div>
                    <label class="field-label">No Whatsapp</label>
                    <input type="text" name="no_hp" placeholder="08xxxxxxxxxx"
                        class="field-input @error('no_hp') border-red-500 @enderror"
                        value="{{ old('no_hp') }}">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="field-label">NIK</label>
                        <input type="text" name="nik" placeholder="Masukkan NIK"
                            class="field-input @error('nik') border-red-500 @enderror"
                            value="{{ old('nik') }}">
                    </div>
                    <div>
                        <label class="field-label">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="field-input">
                            <option value="">Pilih jenis kelamin</option>
                            <option value="laki-laki" @selected(old('jenis_kelamin')=='laki-laki')>Laki-laki</option>
                            <option value="perempuan" @selected(old('jenis_kelamin')=='perempuan')>Perempuan</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="field-label">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" placeholder="Tempat lahir"
                            class="field-input" value="{{ old('tempat_lahir') }}">
                    </div>
                    <div>
                        <label class="field-label">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="field-input"
                            value="{{ old('tanggal_lahir') }}">
                    </div>
                </div>

                <div>
                    <label class="field-label">Agama</label>
                    <select name="agama" class="field-input">
                        <option value="">Pilih agama</option>
                        @foreach(['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu'] as $ag)
                            <option value="{{ $ag }}" @selected(old('agama')==$ag)>{{ $ag }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="field-label">Alamat Lengkap</label>
                    <textarea name="alamat" rows="3" placeholder="Masukkan alamat lengkap"
                        class="field-input">{{ old('alamat') }}</textarea>
                </div>
            </div>

            {{-- ══════════════ ACCORDION SECTIONS ══════════════ --}}
            <div class="space-y-3 pt-2">

                {{-- ORANG TUA --}}
                <div class="accordion-item">
                    <button type="button" class="accordion-btn" aria-expanded="false" data-acc="ortu">
                        <div class="section-icon icon-ortu"><i class="bi bi-people-fill"></i></div>
                        <span class="font-semibold text-sm text-slate-800">Data Orang Tua / Wali</span>
                        <svg class="chevron" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </button>
                    <div class="accordion-panel" data-acc-panel="ortu">
                        <div class="inner">
                            <div>
                                <label class="field-label">Nama Ayah</label>
                                <input type="text" name="nama_ayah" placeholder="Nama ayah"
                                    class="field-input" value="{{ old('nama_ayah') }}">
                            </div>
                            <div>
                                <label class="field-label">Nama Ibu</label>
                                <input type="text" name="nama_ibu" placeholder="Nama ibu"
                                    class="field-input" value="{{ old('nama_ibu') }}">
                            </div>
                            <div>
                                <label class="field-label">No HP Orang Tua</label>
                                <input type="text" name="no_hp_ortu" placeholder="No HP orang tua"
                                    class="field-input" value="{{ old('no_hp_ortu') }}">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ASAL SEKOLAH --}}
                <div class="accordion-item">
                    <button type="button" class="accordion-btn" aria-expanded="false" data-acc="sekolah">
                        <div class="section-icon icon-sekolah"><i class="bi bi-building"></i></div>
                        <span class="font-semibold text-sm text-slate-800">Asal Sekolah</span>
                        <svg class="chevron" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </button>
                    <div class="accordion-panel" data-acc-panel="sekolah">
                        <div class="inner">
                            <div>
                                <label class="field-label">Nama Sekolah</label>
                                <input type="text" name="asal_sekolah" placeholder="Nama sekolah asal"
                                    class="field-input" value="{{ old('asal_sekolah') }}">
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="field-label">NPSN</label>
                                    <input type="text" name="npsn_sekolah" placeholder="NPSN"
                                        class="field-input" value="{{ old('npsn_sekolah') }}">
                                </div>
                                <div>
                                    <label class="field-label">Nilai</label>
                                    <input type="number" name="nilai_rata_rata" placeholder="Nilai rata-rata"
                                        class="field-input" value="{{ old('nilai_rata_rata') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- UPLOAD BERKAS --}}
                <div class="accordion-item">
                    <button type="button" class="accordion-btn" aria-expanded="false" data-acc="berkas">
                        <div class="section-icon icon-berkas"><i class="bi bi-upload"></i></div>
                        <span class="font-semibold text-sm text-slate-800">Upload Berkas</span>
                        <svg class="chevron" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </button>
                    <div class="accordion-panel" data-acc-panel="berkas">
                        <div class="inner">
                            <div>
                                <label class="field-label">Foto Formal Background Merah</label>
                                <input type="file" name="foto" class="field-input">
                            </div>
                            <div>
                                <label class="field-label">Scan Kartu Keluarga</label>
                                <input type="file" name="scan_kk" class="field-input">
                            </div>
                            <div>
                                <label class="field-label">Scan Akta</label>
                                <input type="file" name="scan_akta" class="field-input">
                            </div>
                            <div>
                                <label class="field-label">Scan Ijazah SLTP</label>
                                <input type="file" name="scan_ijazah" class="field-input">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ══════════════ SUBMIT ══════════════ --}}
            <div class="pt-3 space-y-3">
                <button type="submit" class="btn-utama">
                    Simpan dan Lanjutkan
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </button>
                <button type="reset" class="btn-reset">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="1 4 1 10 7 10"></polyline>
                        <path d="M3.5 15a9 9 0 1 0 2-9.5L1 10"></path>
                    </svg>
                    Reset Form
                </button>
                <a href="{{ route('welcome') }}" class="block text-center text-xs text-slate-400 pt-1">Kembali ke beranda</a>
            </div>

        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('[data-acc]').forEach(btn => {
        const key   = btn.dataset.acc;
        const panel = document.querySelector(`[data-acc-panel="${key}"]`);

        btn.addEventListener('click', () => {
            const isOpen = btn.getAttribute('aria-expanded') === 'true';

            // tutup semua panel lain dulu biar rapi, boleh dihapus kalau mau multi-buka
            document.querySelectorAll('.accordion-btn').forEach(b => {
                if (b !== btn) {
                    b.setAttribute('aria-expanded', 'false');
                    const p = document.querySelector(`[data-acc-panel="${b.dataset.acc}"]`);
                    if (p) p.style.maxHeight = null;
                }
            });

            btn.setAttribute('aria-expanded', String(!isOpen));
            panel.style.maxHeight = isOpen ? null : panel.scrollHeight + 'px';
        });
    });
});
</script>

</body>
</html>
