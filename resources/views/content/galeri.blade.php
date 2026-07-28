{{-- ================= GALERI KEGIATAN POWER ================= --}}
<div class="gallery-section" id="galeri">
    <div class="section-container">

        {{-- HEADER --}}
        <div class="section-header">
            <h2><i class="fa-solid fa-images"></i> Galeri Kegiatan</h2>
            <p>Dokumentasi aktivitas santri dan pesantren</p>
        </div>

        {{-- FILTER + SEARCH --}}
        <div class="gallery-controls">

            <div class="gallery-tabs">
                <button class="tab-btn active" data-filter="all">
                    <i class="fa-solid fa-layer-group"></i> Semua
                </button>
                <button class="tab-btn" data-filter="image">
                    <i class="fa-solid fa-image"></i> Foto
                </button>
                <button class="tab-btn" data-filter="video">
                    <i class="fa-solid fa-video"></i> Video
                </button>
            </div>

            <div class="gallery-search">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input id="gallerySearch" type="text" placeholder="Cari kegiatan...">
            </div>

        </div>

        {{-- GRID --}}
        <div class="gallery-grid">

            @forelse($galeris as $galeri)

                @php
                    $ext = strtolower(pathinfo($galeri->media, PATHINFO_EXTENSION));
                    $isVideo = in_array($ext, ['mp4','mov','avi','mkv','webm']);
                    $type = $isVideo ? 'video' : 'image';
                    $url = asset('storage/'.$galeri->media);
                @endphp

                <div class="gallery-item"
                     data-type="{{ $type }}"
                     data-title="{{ strtolower($galeri->nama_kegiatan) }}">

                    <div class="gallery-card">

                        {{-- VIDEO --}}
                        @if($isVideo)

                            <video preload="metadata"></video>

                            <div class="play-overlay"
                                 onclick="Gallery.openVideo('{{ $url }}','{{ $galeri->nama_kegiatan }}')">
                                <i class="fa-solid fa-play"></i>
                            </div>

                        @else

                            <img src="{{ $url }}"
                                 alt="{{ $galeri->nama_kegiatan }}"
                                 onclick="Gallery.openImage('{{ $url }}','{{ $galeri->nama_kegiatan }}')">

                        @endif

                        {{-- ACTION BUTTONS --}}
                        <div class="action-buttons">

                            <button title="Lihat"
                                onclick="{{ $isVideo
                                    ? "Gallery.openVideo('$url','{$galeri->nama_kegiatan}')"
                                    : "Gallery.openImage('$url','{$galeri->nama_kegiatan}')"
                                }}">
                                <i class="fa-solid fa-eye"></i>
                            </button>

                            <button title="Unduh"
                                onclick="Gallery.download('{{ $url }}','{{ $galeri->nama_kegiatan }}')">
                                <i class="fa-solid fa-download"></i>
                            </button>

                        </div>

                        <div class="caption">
                            {{ $galeri->nama_kegiatan }}
                        </div>

                    </div>
                </div>

            @empty
                <p class="empty">Belum ada galeri</p>
            @endforelse

        </div>

    </div>
</div>


{{-- ================= SCRIPT ================= --}}
<script>

const Gallery = {

    openImage(src,title){
        this.showModal(`
            <img src="${src}">
            <div class="modal-title">${title}</div>
            <button class="modal-download"
                onclick="Gallery.download('${src}','${title}')">
                <i class="fa-solid fa-download"></i> Unduh
            </button>
        `);
    },

    openVideo(src,title){
        this.showModal(`
            <video controls autoplay>
                <source src="${src}">
            </video>
            <div class="modal-title">${title}</div>
            <button class="modal-download"
                onclick="Gallery.download('${src}','${title}')">
                <i class="fa-solid fa-download"></i> Unduh
            </button>
        `);
    },

    showModal(content){

        const modal = document.createElement('div');
        modal.className = 'gallery-modal';

        modal.innerHTML = `
            <div class="modal-content">
                <div class="modal-close" onclick="Gallery.close()">
                    <i class="fa-solid fa-xmark"></i>
                </div>
                ${content}
            </div>
        `;

        document.body.appendChild(modal);
        document.body.style.overflow='hidden';
    },

    close(){
        document.querySelector('.gallery-modal')?.remove();
        document.body.style.overflow='';
    },

    download(url,name){
        const link = document.createElement('a');
        link.href = url;
        link.download = name || 'download';
        document.body.appendChild(link);
        link.click();
        link.remove();
    }
};

/* FILTER */

document.querySelectorAll('.tab-btn').forEach(btn=>{
    btn.onclick=()=>{

        document.querySelectorAll('.tab-btn').forEach(b=>b.classList.remove('active'));
        btn.classList.add('active');

        const type = btn.dataset.filter;

        document.querySelectorAll('.gallery-item').forEach(item=>{
            item.style.display =
                (type==='all' || item.dataset.type===type)
                ? ''
                : 'none';
        });
    };
});

/* SEARCH */

document.getElementById('gallerySearch')?.addEventListener('input',e=>{

    const val = e.target.value.toLowerCase();

    document.querySelectorAll('.gallery-item').forEach(item=>{
        item.style.display =
            item.dataset.title.includes(val)
            ? ''
            : 'none';
    });

});

</script>
