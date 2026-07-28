{{-- HERO SECTION --}}
<div class="section-heading"><i class="fa-solid fa-image"></i> Hero Section</div>
<div class="form-group">
    <label class="form-label">Foto Utama <span style="color:var(--danger)">*</span></label>
    <input type="file" name="foto_utama" class="form-control {{ $errors->has('foto_utama') ? 'is-invalid' : '' }}"
           accept="image/*" onchange="previewImg(this,'prev_foto_utama')">
    @if(isset($pengaturan) && $pengaturan->foto_utama)
        <img id="prev_foto_utama" src="{{ asset('storage/'.$pengaturan->foto_utama) }}" class="img-preview">
    @else
        <img id="prev_foto_utama" class="img-preview" style="display:none">
    @endif
    @error('foto_utama') <div class="invalid-feedback">{{ $message }}</div> @enderror
    <div class="form-hint">Format: JPG, PNG, WEBP. Maks 2MB.</div>
</div>

<div class="form-grid">
    <div class="form-group">
        <label class="form-label">Judul Utama <span style="color:var(--danger)">*</span></label>
        <input type="text" name="judul_utama" class="form-control {{ $errors->has('judul_utama') ? 'is-invalid' : '' }}"
               value="{{ old('judul_utama', $pengaturan->judul_utama ?? '') }}" placeholder="cth: Selamat Datang di Pesantren Kami">
        @error('judul_utama') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="form-group">
        <label class="form-label">Sub Judul <span style="color:var(--danger)">*</span></label>
        <input type="text" name="sub_judul" class="form-control {{ $errors->has('sub_judul') ? 'is-invalid' : '' }}"
               value="{{ old('sub_judul', $pengaturan->sub_judul ?? '') }}" placeholder="cth: Belajar & Berkembang Bersama">
        @error('sub_judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<div class="form-group">
    <label class="form-label">Deskripsi Judul <span style="color:var(--danger)">*</span></label>
    <input type="text" name="deskripsi_judul" class="form-control {{ $errors->has('deskripsi_judul') ? 'is-invalid' : '' }}"
           value="{{ old('deskripsi_judul', $pengaturan->deskripsi_judul ?? '') }}" placeholder="Deskripsi singkat pada hero section">
    @error('deskripsi_judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<hr class="section-divider">

{{-- ABOUT --}}
<div class="section-heading"><i class="fa-solid fa-circle-info"></i> About Section</div>

<div class="form-group">
    <label class="form-label">Foto About <span style="color:var(--danger)">*</span></label>
    <input type="file" name="foto_about" class="form-control {{ $errors->has('foto_about') ? 'is-invalid' : '' }}"
           accept="image/*" onchange="previewImg(this,'prev_foto_about')">
    @if(isset($pengaturan) && $pengaturan->foto_about)
        <img id="prev_foto_about" src="{{ asset('storage/'.$pengaturan->foto_about) }}" class="img-preview">
    @else
        <img id="prev_foto_about" class="img-preview" style="display:none">
    @endif
    @error('foto_about') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="form-group">
    <label class="form-label">Judul About <span style="color:var(--danger)">*</span></label>
    <input type="text" name="judul_about" class="form-control {{ $errors->has('judul_about') ? 'is-invalid' : '' }}"
           value="{{ old('judul_about', $pengaturan->judul_about ?? '') }}" placeholder="cth: Tentang Kami">
    @error('judul_about') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="form-group">
    <label class="form-label">Teks About <span style="color:var(--danger)">*</span></label>
    <textarea name="text_about" class="form-control {{ $errors->has('text_about') ? 'is-invalid' : '' }}"
              rows="5" placeholder="Ceritakan tentang lembaga/sekolah Anda...">{{ old('text_about', $pengaturan->text_about ?? '') }}</textarea>
    @error('text_about') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<hr class="section-divider">

{{-- STATISTIK --}}
<div class="section-heading"><i class="fa-solid fa-chart-bar"></i> Statistik Data</div>

<div class="form-grid" style="grid-template-columns:1fr 1fr 1fr 1fr">
    <div class="form-group">
        <label class="form-label">Tahun Berpengalaman</label>
        <input type="number" name="tahun_berpengalaman" class="form-control {{ $errors->has('tahun_berpengalaman') ? 'is-invalid' : '' }}"
               value="{{ old('tahun_berpengalaman', $pengaturan->tahun_berpengalaman ?? 0) }}" min="0">
        @error('tahun_berpengalaman') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="form-group">
        <label class="form-label">Tenaga Pengajar</label>
        <input type="number" name="tenaga_pengajar" class="form-control {{ $errors->has('tenaga_pengajar') ? 'is-invalid' : '' }}"
               value="{{ old('tenaga_pengajar', $pengaturan->tenaga_pengajar ?? 0) }}" min="0">
        @error('tenaga_pengajar') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="form-group">
        <label class="form-label">Murid Aktif</label>
        <input type="number" name="murid_aktiv" class="form-control {{ $errors->has('murid_aktiv') ? 'is-invalid' : '' }}"
               value="{{ old('murid_aktiv', $pengaturan->murid_aktiv ?? 0) }}" min="0">
        @error('murid_aktiv') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="form-group">
        <label class="form-label">Alumni Penerima Beasiswa</label>
        <input type="number" name="alumni_penerimaBeasiswa" class="form-control {{ $errors->has('alumni_penerimaBeasiswa') ? 'is-invalid' : '' }}"
               value="{{ old('alumni_penerimaBeasiswa', $pengaturan->alumni_penerimaBeasiswa ?? 0) }}" min="0">
        @error('alumni_penerimaBeasiswa') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<hr class="section-divider">

{{-- MEDIA SOSIAL --}}
<div class="section-heading"><i class="fa-solid fa-share-nodes"></i> Media Sosial</div>

<div class="form-grid">
    <div class="form-group">
        <label class="form-label"><i class="fa-brands fa-facebook" style="color:#1877f2"></i> Link Facebook</label>
        <input type="url" name="link_fb" class="form-control {{ $errors->has('link_fb') ? 'is-invalid' : '' }}"
               value="{{ old('link_fb', $pengaturan->link_fb ?? '') }}" placeholder="https://facebook.com/...">
        @error('link_fb') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="form-group">
        <label class="form-label"><i class="fa-brands fa-whatsapp" style="color:#25d366"></i> Link WhatsApp</label>
        <input type="text" name="link_wa" class="form-control {{ $errors->has('link_wa') ? 'is-invalid' : '' }}"
               value="{{ old('link_wa', $pengaturan->link_wa ?? '') }}" placeholder="https://wa.me/628xxx atau nomor saja">
        @error('link_wa') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="form-group">
        <label class="form-label"><i class="fa-brands fa-instagram" style="color:#e1306c"></i> Link Instagram</label>
        <input type="url" name="link_instagram" class="form-control {{ $errors->has('link_instagram') ? 'is-invalid' : '' }}"
               value="{{ old('link_instagram', $pengaturan->link_instagram ?? '') }}" placeholder="https://instagram.com/...">
        @error('link_instagram') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="form-group">
        <label class="form-label"><i class="fa-brands fa-youtube" style="color:#ff0000"></i> Link YouTube</label>
        <input type="url" name="link_youtube" class="form-control {{ $errors->has('link_youtube') ? 'is-invalid' : '' }}"
               value="{{ old('link_youtube', $pengaturan->link_youtube ?? '') }}" placeholder="https://youtube.com/...">
        @error('link_youtube') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<hr class="section-divider">

{{-- KONTAK --}}
<div class="section-heading"><i class="fa-solid fa-address-card"></i> Informasi Kontak</div>

<div class="form-group">
    <label class="form-label">Alamat <span style="color:var(--danger)">*</span></label>
    <input type="text" name="alamat" class="form-control {{ $errors->has('alamat') ? 'is-invalid' : '' }}"
           value="{{ old('alamat', $pengaturan->alamat ?? '') }}" placeholder="Jl. Contoh No. 1, Kota, Provinsi">
    @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="form-grid">
    <div class="form-group">
        <label class="form-label">No. WhatsApp <span style="color:var(--danger)">*</span></label>
        <input type="text" name="no_wa" class="form-control {{ $errors->has('no_wa') ? 'is-invalid' : '' }}"
               value="{{ old('no_wa', $pengaturan->no_wa ?? '') }}" placeholder="08xxxxxxxxxx">
        @error('no_wa') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="form-group">
        <label class="form-label">Email <span style="color:var(--danger)">*</span></label>
        <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
               value="{{ old('email', $pengaturan->email ?? '') }}" placeholder="admin@contoh.com">
        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<div class="form-group">
    <label class="form-label">Jam Operasional <span style="color:var(--danger)">*</span></label>
    <input type="text" name="jam_operasional" class="form-control {{ $errors->has('jam_operasional') ? 'is-invalid' : '' }}"
           value="{{ old('jam_operasional', $pengaturan->jam_operasional ?? '') }}" placeholder="cth: Senin - Sabtu, 07.00 - 16.00 WIB">
    @error('jam_operasional') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>