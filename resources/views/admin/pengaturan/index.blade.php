@extends('layouts.admin')
@section('title', 'Pengaturan Website')

@section('content')
<div class="page-header">
    <div>
        <div class="breadcrumb">
            <span>Dashboard</span>
            <i class="fa-solid fa-chevron-right"></i>
            <span>Pengaturan</span>
        </div>
        <h1>Pengaturan Website</h1>
        <p>Kelola konten utama tampilan website Anda</p>
    </div>
    @if(!$pengaturan)
        <a href="{{ route('admin.pengaturan.create') }}" class="btn btn-primary">
            <i class="fa-solid fa-plus"></i> Buat Pengaturan
        </a>
    @endif
</div>

@if($pengaturan)
    {{-- HERO SECTION --}}
    <div class="card" style="margin-bottom:20px">
        <div class="card-header">
            <div class="card-title"><i class="fa-solid fa-image" style="color:#3b82f6;margin-right:8px"></i>Hero Section</div>
            <a href="{{ route('admin.pengaturan.edit', $pengaturan->id) }}" class="btn btn-warning btn-sm">
                <i class="fa-solid fa-pen"></i> Edit
            </a>
        </div>
        <div class="card-body">
            <div style="display:grid;grid-template-columns:200px 1fr;gap:24px;align-items:start">
                <div>
                    <div class="form-label">Foto Utama</div>
                    <img src="{{ asset('storage/'.$pengaturan->foto_utama) }}" alt="Foto Utama"
                         style="width:100%;border-radius:10px;border:1px solid var(--border)">
                </div>
                <div>
                    <div class="form-grid" style="margin-bottom:16px">
                        <div>
                            <div class="form-label">Judul Utama</div>
                            <p style="font-weight:600;font-size:1.1rem">{{ $pengaturan->judul_utama }}</p>
                        </div>
                        <div>
                            <div class="form-label">Sub Judul</div>
                            <p>{{ $pengaturan->sub_judul }}</p>
                        </div>
                    </div>
                    <div>
                        <div class="form-label">Deskripsi</div>
                        <p style="color:var(--muted)">{{ $pengaturan->deskripsi_judul }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ABOUT SECTION --}}
    <div class="card" style="margin-bottom:20px">
        <div class="card-header">
            <div class="card-title"><i class="fa-solid fa-circle-info" style="color:#10b981;margin-right:8px"></i>About Section</div>
        </div>
        <div class="card-body">
            <div style="display:grid;grid-template-columns:200px 1fr;gap:24px;align-items:start">
                <div>
                    <div class="form-label">Foto About</div>
                    <img src="{{ asset('storage/'.$pengaturan->foto_about) }}" alt="Foto About"
                         style="width:100%;border-radius:10px;border:1px solid var(--border)">
                </div>
                <div>
                    <div style="margin-bottom:12px">
                        <div class="form-label">Judul About</div>
                        <p style="font-weight:600">{{ $pengaturan->judul_about }}</p>
                    </div>
                    <div>
                        <div class="form-label">Teks About</div>
                        <p style="color:var(--muted);line-height:1.7">{{ $pengaturan->text_about }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- STATISTIK --}}
    <div class="card" style="margin-bottom:20px">
        <div class="card-header">
            <div class="card-title"><i class="fa-solid fa-chart-bar" style="color:#f59e0b;margin-right:8px"></i>Statistik Data</div>
        </div>
        <div class="card-body">
            <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:16px">
                @foreach([
                    ['label'=>'Tahun Berpengalaman','value'=>$pengaturan->tahun_berpengalaman,'icon'=>'fa-calendar','color'=>'#3b82f6'],
                    ['label'=>'Tenaga Pengajar','value'=>$pengaturan->tenaga_pengajar,'icon'=>'fa-chalkboard-user','color'=>'#10b981'],
                    ['label'=>'Murid Aktif','value'=>$pengaturan->murid_aktiv,'icon'=>'fa-users','color'=>'#f59e0b'],
                    ['label'=>'Alumni Penerima Beasiswa','value'=>$pengaturan->alumni_penerimaBeasiswa,'icon'=>'fa-graduation-cap','color'=>'#8b5cf6'],
                ] as $stat)
                <div style="background:#f8fafc;border-radius:10px;padding:18px;text-align:center;border:1px solid var(--border)">
                    <i class="fa-solid {{ $stat['icon'] }}" style="font-size:1.5rem;color:{{ $stat['color'] }};margin-bottom:10px"></i>
                    <div style="font-size:1.8rem;font-weight:800;color:var(--text)">{{ number_format($stat['value']) }}</div>
                    <div style="font-size:.75rem;color:var(--muted);margin-top:4px">{{ $stat['label'] }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- MEDIA SOSIAL & KONTAK --}}
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px">
        <div class="card">
            <div class="card-header">
                <div class="card-title"><i class="fa-solid fa-share-nodes" style="color:#6366f1;margin-right:8px"></i>Media Sosial</div>
            </div>
            <div class="card-body">
                @foreach([
                    ['label'=>'Facebook','value'=>$pengaturan->link_fb,'icon'=>'fa-brands fa-facebook','color'=>'#1877f2'],
                    ['label'=>'WhatsApp','value'=>$pengaturan->link_wa,'icon'=>'fa-brands fa-whatsapp','color'=>'#25d366'],
                    ['label'=>'Instagram','value'=>$pengaturan->link_instagram,'icon'=>'fa-brands fa-instagram','color'=>'#e1306c'],
                    ['label'=>'YouTube','value'=>$pengaturan->link_youtube,'icon'=>'fa-brands fa-youtube','color'=>'#ff0000'],
                ] as $social)
                <div style="display:flex;align-items:center;gap:12px;padding:10px 0;border-bottom:1px solid var(--border)">
                    <i class="{{ $social['icon'] }}" style="color:{{ $social['color'] }};width:20px;font-size:1rem"></i>
                    <div>
                        <div style="font-size:.72rem;color:var(--muted);font-weight:600">{{ $social['label'] }}</div>
                        <div style="font-size:.85rem;word-break:break-all">{{ $social['value'] ?: '-' }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="card-title"><i class="fa-solid fa-address-card" style="color:#0ea5e9;margin-right:8px"></i>Informasi Kontak</div>
            </div>
            <div class="card-body">
                @foreach([
                    ['label'=>'Alamat','value'=>$pengaturan->alamat,'icon'=>'fa-location-dot','color'=>'#ef4444'],
                    ['label'=>'No. WhatsApp','value'=>$pengaturan->no_wa,'icon'=>'fa-phone','color'=>'#10b981'],
                    ['label'=>'Email','value'=>$pengaturan->email,'icon'=>'fa-envelope','color'=>'#3b82f6'],
                    ['label'=>'Jam Operasional','value'=>$pengaturan->jam_operasional,'icon'=>'fa-clock','color'=>'#f59e0b'],
                ] as $kontak)
                <div style="display:flex;align-items:flex-start;gap:12px;padding:10px 0;border-bottom:1px solid var(--border)">
                    <i class="fa-solid {{ $kontak['icon'] }}" style="color:{{ $kontak['color'] }};width:20px;font-size:.95rem;margin-top:2px"></i>
                    <div>
                        <div style="font-size:.72rem;color:var(--muted);font-weight:600">{{ $kontak['label'] }}</div>
                        <div style="font-size:.85rem">{{ $kontak['value'] }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- DELETE BUTTON --}}
    <div style="margin-top:20px;text-align:right">
        <form action="{{ route('admin.pengaturan.destroy', $pengaturan->id) }}" method="POST"
              onsubmit="return confirm('Yakin ingin menghapus semua pengaturan?')">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm">
                <i class="fa-solid fa-trash"></i> Hapus Pengaturan
            </button>
        </form>
    </div>

@else
    <div class="card">
        <div class="empty-state">
            <i class="fa-solid fa-gear"></i>
            <p>Belum ada pengaturan. Klik tombol di atas untuk membuat pengaturan website.</p>
            <a href="{{ route('admin.pengaturan.create') }}" class="btn btn-primary">
                <i class="fa-solid fa-plus"></i> Buat Pengaturan
            </a>
        </div>
    </div>
@endif
@endsection