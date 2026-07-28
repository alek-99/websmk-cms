

<?php $__env->startSection('meta'); ?>
<title><?php echo e($berita->meta_title ?? $berita->title); ?></title>
<meta name="description" content="<?php echo e($berita->meta_description); ?>">
<link rel="canonical" href="<?php echo e($berita->canonical_url ?? url()->current()); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


<div class="news-hero">

    <?php if($berita->featured_image): ?>
        <img src="<?php echo e(asset('storage/'.$berita->featured_image)); ?>" class="hero-bg">
    <?php endif; ?>

    <div class="hero-overlay"></div>

    <div class="container hero-content">

        
        <div class="mb-3">
            <?php $__currentLoopData = $berita->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <span class="badge"
                      style="background: <?php echo e($cat->color ?? '#0d6efd'); ?>">
                    <?php echo e($cat->name); ?>

                </span>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        
        <h1 class="hero-title"><?php echo e($berita->title); ?></h1>

        
        <div class="hero-meta">
            <span><i class="fas fa-user"></i> <?php echo e($berita->author->name ?? 'Admin'); ?></span>
            <span><i class="fas fa-calendar"></i> <?php echo e($berita->formatted_date); ?></span>
            <span><i class="fas fa-clock"></i> <?php echo e($berita->reading_time_minutes); ?> menit baca</span>
            <span><i class="fas fa-eye"></i> <?php echo e(number_format($berita->views)); ?> views</span>
        </div>

    </div>
</div>


<div class="floating-share">

    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(urlencode(url()->current())); ?>" target="_blank">
        <i class="fab fa-facebook-f"></i>
    </a>

    <a href="https://twitter.com/intent/tweet?url=<?php echo e(urlencode(url()->current())); ?>" target="_blank">
        <i class="fab fa-twitter"></i>
    </a>

    <a href="https://wa.me/?text=<?php echo e(urlencode($berita->title.' '.url()->current())); ?>" target="_blank">
        <i class="fab fa-whatsapp"></i>
    </a>

    <button onclick="copyLink()">
        <i class="fas fa-link"></i>
    </button>

</div>


<div class="container py-5">

    
    <?php if($berita->excerpt): ?>
        <div class="lead-box mb-4">
            <?php echo e($berita->excerpt); ?>

        </div>
    <?php endif; ?>

    
    <article class="article-content">
        <?php echo $berita->content; ?>

    </article>

    
    <?php if($berita->tags->count()): ?>
    <div class="mt-5">
        <?php $__currentLoopData = $berita->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('berita.tag',$tag->slug)); ?>" class="tag">
                #<?php echo e($tag->name); ?>

            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php endif; ?>

</div>


<?php if($berita->author): ?>
<div class="container mb-5">
    <div class="author-box">

        <div class="author-avatar">
            <?php echo e(strtoupper(substr($berita->author->name,0,1))); ?>

        </div>

        <div>
            <h5 class="mb-1"><?php echo e($berita->author->name); ?></h5>
            <p class="text-muted mb-0">Penulis Artikel</p>
        </div>

    </div>
</div>
<?php endif; ?>


<?php if($related->count()): ?>
<div class="container pb-5">
    <h3 class="fw-bold mb-4">Berita Terkait</h3>

    <div class="row g-4">

        <?php $__currentLoopData = $related; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-4">
            <a href="<?php echo e(route('berita.show',$r->slug)); ?>" class="related-card">

                <?php if($r->featured_image): ?>
                <img src="<?php echo e(asset('storage/'.$r->featured_image)); ?>">
                <?php endif; ?>

                <div class="p-3">
                    <h6><?php echo e(Str::limit($r->title,60)); ?></h6>
                    <small class="text-muted">
                        <?php echo e($r->published_at->format('d M Y')); ?>

                    </small>
                </div>

            </a>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </div>
</div>
<?php endif; ?>

<?php $__env->stopSection(); ?>


<?php $__env->startPush('styles'); ?>
<style>

.news-hero{
    position:relative;
    height:480px;
    overflow:hidden;
    color:white;
}

.hero-bg{
    width:100%;
    height:100%;
    object-fit:cover;
}

.hero-overlay{
    position:absolute;
    inset:0;
    background:linear-gradient(to top, rgba(0,0,0,.85), rgba(0,0,0,.2));
}

.hero-content{
    position:absolute;
    bottom:40px;
    z-index:2;
}

.hero-title{
    font-size:2.6rem;
    font-weight:800;
}

.hero-meta span{
    margin-right:18px;
    opacity:.9;
}

.floating-share{
    position:fixed;
    top:100px;
    right:10px;
    display:flex;
    flex-direction:column;
    gap:10px;
    z-index:999;
}

.floating-share a,
.floating-share button{
    background:#0d6efd;
    color:white;
    border:none;
    width:42px;
    height:42px;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
}

.lead-box{
    background:#f8f9fa;
    border-left:5px solid #0d6efd;
    padding:18px;
    font-size:1.2rem;
}

.article-content{
    font-size:1.15rem;
    line-height:1.9;
}

.article-content img{
    max-width:100%;
    border-radius:10px;
    margin:2rem 0;
}

.tag{
    background:#e9ecef;
    padding:6px 12px;
    border-radius:20px;
    text-decoration:none;
    margin-right:8px;
    color:#333;
}

.author-box{
    display:flex;
    align-items:center;
    gap:20px;
    padding:20px;
    border-radius:12px;
    background:#f8f9fa;
}

.author-avatar{
    width:70px;
    height:70px;
    border-radius:50%;
    background:#0d6efd;
    color:white;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:28px;
}

.related-card{
    display:block;
    text-decoration:none;
    color:inherit;
    background:white;
    border-radius:12px;
    overflow:hidden;
    box-shadow:0 5px 18px rgba(0,0,0,.08);
    transition:.3s;
}

.related-card img{
    width:100%;
    height:180px;
    object-fit:cover;
}

.related-card:hover{
    transform:translateY(-6px);
}

 @media (max-width: 768px) {
    .badge {
        margin-top : 100x;
    }
 }

</style>
<?php $__env->stopPush(); ?>


<?php $__env->startPush('scripts'); ?>
<script>

function copyLink(){
    navigator.clipboard.writeText(window.location.href);
    alert("Link berhasil disalin!");
}

// Reading progress
window.addEventListener('scroll', function(){
    const winScroll=document.documentElement.scrollTop;
    const height=document.documentElement.scrollHeight - document.documentElement.clientHeight;
    const scrolled=(winScroll/height)*100;

    let bar=document.getElementById('progressBar');

    if(!bar){
        bar=document.createElement('div');
        bar.id='progressBar';
        bar.style.cssText='position:fixed;top:0;left:0;height:4px;background:#0d6efd;z-index:9999;';
        document.body.appendChild(bar);
    }

    bar.style.width=scrolled+"%";
});

</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.berita', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\SMK-MK\resources\views/berita/show.blade.php ENDPATH**/ ?>