@extends('layouts.admin')
@section('title', 'Manajemen Program')

@section('content')
<div class="page-header">
    <div>
        <div class="breadcrumb">
            <span>Dashboard</span>
            <i class="fa-solid fa-chevron-right"></i>
            <span>Program</span>
        </div>
        <h1>Manajemen Program</h1>
        <p>Kelola daftar program yang ditampilkan di website</p>
    </div>
    <a href="{{ route('admin.program.create') }}" class="btn btn-primary">
        <i class="fa-solid fa-plus"></i> Tambah Program
    </a>
</div>

<div class="card">
    @if($programs->count())
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th style="width:50px">#</th>
                        <th style="width:80px">Icon</th>
                        <th>Judul Program</th>
                        <th>Deskripsi</th>
                        <th style="width:140px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($programs as $program)
                    <tr>
                        <td style="color:var(--muted);font-size:.8rem">{{ $loop->iteration }}</td>
                        <td>
                            <img src="{{ asset('storage/'.$program->icon) }}" alt="{{ $program->judul }}" class="img-thumb">
                        </td>
                        <td>
                            <div style="font-weight:600">{{ $program->judul }}</div>
                        </td>
                        <td>
                            <div style="color:var(--muted);font-size:.85rem;max-width:340px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">
                                {{ $program->deskripsi }}
                            </div>
                        </td>
                        <td>
                            <div style="display:flex;gap:6px">
                                <a href="{{ route('admin.program.edit', $program->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <form action="{{ route('admin.program.destroy', $program->id) }}" method="POST"
                                      onsubmit="return confirm('Hapus program ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if($programs->hasPages())
            <div style="padding:16px 24px;border-top:1px solid var(--border)">
                {{ $programs->links() }}
            </div>
        @endif
    @else
        <div class="empty-state">
            <i class="fa-solid fa-layer-group"></i>
            <p>Belum ada program. Klik tombol di atas untuk menambahkan program.</p>
            <a href="{{ route('admin.program.create') }}" class="btn btn-primary">
                <i class="fa-solid fa-plus"></i> Tambah Program
            </a>
        </div>
    @endif
</div>
@endsection