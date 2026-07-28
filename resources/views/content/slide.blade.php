 {{-- Slider Container --}}
        <div class="max-w-6xl w-full">
            <div class="swiper gallerySwiper">
                <div class="swiper-wrapper">
                    {{-- Slide 1 --}}
                    <div class="swiper-slide">
                        <div class="relative h-[70vh] bg-gray-900 rounded-2xl overflow-hidden group">
                            <img src="{{ asset('storage/images/WhatsApp Image 2026-02-12 at 03.18.21.jpeg') }}" 
                                 alt="SMK Maulana Hasanudin - Gedung Sekolah" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                                 onerror="this.src='https://via.placeholder.com/1200x800/3b82f6/ffffff?text=Gedung+Sekolah'">
                            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 to-transparent p-8">
                                <h3 class="text-white text-3xl font-bold mb-2">Gedung SMK Maulana Hasanudin</h3>
                                <p class="text-white/80 text-lg">Fasilitas modern untuk pembelajaran berkualitas</p>
                            </div>
                        </div>
                    </div>
                    
                    {{-- Slide 2 --}}
                    <div class="swiper-slide">
                        <div class="relative h-[70vh] bg-gray-900 rounded-2xl overflow-hidden group">
                            <img src="{{ asset('storage/images/school-activity.jpg') }}" 
                                 alt="SMK Maulana Hasanudin - Kegiatan Siswa" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                                 onerror="this.src='https://via.placeholder.com/1200x800/10b981/ffffff?text=Kegiatan+Siswa'">
                            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 to-transparent p-8">
                                <h3 class="text-white text-3xl font-bold mb-2">Kegiatan Pembelajaran</h3>
                                <p class="text-white/80 text-lg">Siswa aktif dalam praktik dan pembelajaran</p>
                            </div>
                        </div>
                    </div>
                    
                    {{-- Slide 3 --}}
                    <div class="swiper-slide">
                        <div class="relative h-[70vh] bg-gray-900 rounded-2xl overflow-hidden group">
                            <img src="{{ asset('storage/images/laboratory.jpg') }}" 
                                 alt="SMK Maulana Hasanudin - Laboratorium" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                                 onerror="this.src='https://via.placeholder.com/1200x800/f59e0b/ffffff?text=Laboratorium'">
                            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 to-transparent p-8">
                                <h3 class="text-white text-3xl font-bold mb-2">Laboratorium Komputer</h3>
                                <p class="text-white/80 text-lg">Dilengkapi dengan peralatan teknologi terkini</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                {{-- Navigation Buttons --}}
                <div class="swiper-button-next !text-white !w-12 !h-12 !bg-white/20 hover:!bg-white/30 !rounded-full after:!text-xl backdrop-blur-sm"></div>
                <div class="swiper-button-prev !text-white !w-12 !h-12 !bg-white/20 hover:!bg-white/30 !rounded-full after:!text-xl backdrop-blur-sm"></div>
                
                {{-- Pagination --}}
                <div class="swiper-pagination !bottom-4"></div>
            </div>
            
            {{-- Photo Counter --}}
            <div class="text-center mt-6">
                <span class="text-white text-lg font-semibold">
                    <span id="currentSlide">1</span> / <span id="totalSlides">3</span>
                </span>
            </div>
        </div>
    </div>
</div>