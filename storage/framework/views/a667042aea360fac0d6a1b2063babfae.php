
<div class="gallery-section" id="galeri">
    <div class="section-container">

        
        <div class="section-header">
            <h2><i class="fa-solid fa-images"></i> Galeri Kegiatan</h2>
            <p>Dokumentasi aktivitas santri dan pesantren</p>
        </div>

        
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

        
        <div class="gallery-grid">

            <?php $__empty_1 = true; $__currentLoopData = $galeris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $galeri): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                <?php
                    $ext = strtolower(pathinfo($galeri->media, PATHINFO_EXTENSION));
                    $isVideo = in_array($ext, ['mp4','mov','avi','mkv','webm']);
                    $type = $isVideo ? 'video' : 'image';
                    $url = asset('storage/'.$galeri->media);
                ?>

                <div class="gallery-item"
                     data-type="<?php echo e($type); ?>"
                     data-title="<?php echo e(strtolower($galeri->nama_kegiatan)); ?>">

                    <div class="gallery-card">

                        
                        <?php if($isVideo): ?>

                            <video preload="metadata"></video>

                            <div class="play-overlay"
                                 onclick="Gallery.openVideo('<?php echo e($url); ?>','<?php echo e($galeri->nama_kegiatan); ?>')">
                                <i class="fa-solid fa-play"></i>
                            </div>

                        <?php else: ?>

                            <img src="<?php echo e($url); ?>"
                                 alt="<?php echo e($galeri->nama_kegiatan); ?>"
                                 onclick="Gallery.openImage('<?php echo e($url); ?>','<?php echo e($galeri->nama_kegiatan); ?>')">

                        <?php endif; ?>

                        
                        <div class="action-buttons">

                            <button title="Lihat"
                                onclick="<?php echo e($isVideo
                                    ? "Gallery.openVideo('$url','{$galeri->nama_kegiatan}')"
                                    : "Gallery.openImage('$url','{$galeri->nama_kegiatan}')"); ?>">
                                <i class="fa-solid fa-eye"></i>
                            </button>

                            <button title="Unduh"
                                onclick="Gallery.download('<?php echo e($url); ?>','<?php echo e($galeri->nama_kegiatan); ?>')">
                                <i class="fa-solid fa-download"></i>
                            </button>

                        </div>

                        <div class="caption">
                            <?php echo e($galeri->nama_kegiatan); ?>

                        </div>

                    </div>
                </div>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="empty">Belum ada galeri</p>
            <?php endif; ?>

        </div>

    </div>
</div>



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
<?php /**PATH D:\SMK-MK\resources\views/content/galeri.blade.php ENDPATH**/ ?>