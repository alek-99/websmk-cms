<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('Login') }} - SMK Maulana Hasanuddin</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased">

    <div class="min-h-screen w-full flex items-center justify-center bg-slate-100 px-4 py-8">
        <div class="w-full max-w-5xl bg-white rounded-3xl shadow-2xl overflow-hidden grid md:grid-cols-2">

            {{-- PANEL KIRI --}}
            <div class="relative bg-gradient-to-b from-emerald-800 to-emerald-900 text-white p-10 flex flex-col justify-between">
                <div class="flex flex-col items-center text-center">

                    {{-- Ikon sekolah (pengganti logo gambar) --}}
                    <div class="w-24 h-24 rounded-full bg-white/10 border border-white/20 flex items-center justify-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-amber-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l6.16-3.422A12.083 12.083 0 0121 15.5c0 1.02-.15 2.006-.428 2.938M12 14L5.84 10.578A12.083 12.083 0 003 15.5c0 1.02.15 2.006.428 2.938M12 14v7" />
                        </svg>
                    </div>

                    <h1 class="text-2xl md:text-3xl font-extrabold leading-tight tracking-wide">
                        SMK MAULANA HASANUDDIN
                    </h1>
                    <p class="mt-1 text-amber-300 font-medium text-sm tracking-wide">
                        Sekolah Berbasis Pesantren Industri
                    </p>

                    <div class="w-16 h-px bg-emerald-400/50 my-5"></div>

                    <p class="text-emerald-100 text-sm leading-relaxed max-w-xs">
                        Kelola informasi sekolah, berita, data pendaftaran dan sistem informasi lainnya dalam satu platform.
                    </p>
                </div>

                <div class="grid grid-cols-2 gap-4 mt-10">
                    <div class="flex flex-col items-center text-center gap-2">
                        <div class="w-11 h-11 rounded-xl bg-emerald-700/60 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v12a2 2 0 01-2 2zM7 8h10M7 12h10M7 16h6" />
                            </svg>
                        </div>
                        <p class="text-sm font-semibold">Kelola Berita</p>
                        <p class="text-[11px] text-emerald-200/80 leading-tight">Informasi terbaru sekolah</p>
                    </div>

                    <div class="flex flex-col items-center text-center gap-2">
                        <div class="w-11 h-11 rounded-xl bg-emerald-700/60 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m5-3.13a4 4 0 100-8 4 4 0 000 8zm6 2a4 4 0 10-8 0" />
                            </svg>
                        </div>
                        <p class="text-sm font-semibold">Pendaftaran</p>
                        <p class="text-[11px] text-emerald-200/80 leading-tight">Kelola data pendaftaran siswa</p>
                    </div>

                    <div class="flex flex-col items-center text-center gap-2">
                        <div class="w-11 h-11 rounded-xl bg-emerald-700/60 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                            </svg>
                        </div>
                        <p class="text-sm font-semibold">Data Sekolah</p>
                        <p class="text-[11px] text-emerald-200/80 leading-tight">Kelola data guru, siswa & akademik</p>
                    </div>

                    <div class="flex flex-col items-center text-center gap-2">
                        <div class="w-11 h-11 rounded-xl bg-emerald-700/60 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14" />
                            </svg>
                        </div>
                        <p class="text-sm font-semibold">Laporan</p>
                        <p class="text-[11px] text-emerald-200/80 leading-tight">Laporan & statistik terintegrasi</p>
                    </div>
                </div>
            </div>

            {{-- PANEL KANAN --}}
            <div class="p-8 md:p-12 flex flex-col justify-center">
                <div class="max-w-sm w-full mx-auto">

                    <h2 class="text-2xl font-bold text-emerald-800">Selamat Datang Kembali!</h2>
                    <p class="text-slate-500 text-sm mt-1 mb-6">Silakan masuk untuk melanjutkan ke dashboard</p>

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email Address -->
                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <x-input-label for="password" :value="__('Password')" />

                            <x-text-input id="password" class="block mt-1 w-full"
                                            type="password"
                                            name="password"
                                            required autocomplete="current-password" />

                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Remember Me -->
                        <div class="flex items-center justify-between mt-4">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-emerald-700 shadow-sm focus:ring-emerald-600" name="remember">
                                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                            </label>

                            @if (Route::has('password.request'))
                                <a class="text-sm text-emerald-700 hover:text-emerald-900 underline-offset-2 hover:underline rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-600" href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif
                        </div>

                        <div class="mt-6">
                            <button type="submit" class="w-full flex items-center justify-center gap-2 bg-emerald-700 hover:bg-emerald-800 text-white font-semibold py-3 rounded-xl transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 5v1a3 3 0 01-3 3H6a3 3 0 01-3-3V6a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                {{ __('Log in') }}
                            </button>
                        </div>
                    </form>

                    <p class="text-center text-xs text-slate-400 mt-8">
                        &copy; {{ date('Y') }} SMK Maulana Hasanuddin. All rights reserved.
                    </p>
                </div>
            </div>

        </div>
    </div>

</body>
</html>
