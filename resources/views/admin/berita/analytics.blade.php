@extends('layouts.admin')

@section('title', 'Analytics Berita')

@section('content')
<div class="container mx-auto px-4 py-6">

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Analytics Berita</h1>
            <p class="text-gray-500">{{ $beritum->title }}</p>
        </div>

        <a href="{{ route('admin.berita.index') }}"
           class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg">
            ← Kembali
        </a>
    </div>

    {{-- SUMMARY CARDS --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

        {{-- Total Views --}}
        <div class="bg-white shadow rounded-xl p-6 border">
            <p class="text-gray-500 text-sm">Total Views</p>
            <h2 class="text-3xl font-bold text-blue-600">
                {{ number_format($totalViews) }}
            </h2>
        </div>

        {{-- Total Shares --}}
        <div class="bg-white shadow rounded-xl p-6 border">
            <p class="text-gray-500 text-sm">Total Shares</p>
            <h2 class="text-3xl font-bold text-green-600">
                {{ number_format($totalShares) }}
            </h2>
        </div>

        {{-- Avg Reading Time --}}
        <div class="bg-white shadow rounded-xl p-6 border">
            <p class="text-gray-500 text-sm">Rata-rata Waktu Baca</p>
            <h2 class="text-3xl font-bold text-purple-600">
                {{ round($avgReadingTime, 1) }} menit
            </h2>
        </div>

    </div>

    {{-- TABLE ANALYTICS --}}
    <div class="bg-white shadow rounded-xl border overflow-hidden">

        <div class="px-6 py-4 border-b bg-gray-50">
            <h3 class="font-semibold text-gray-700">
                Statistik 30 Hari Terakhir
            </h3>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left">

                <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-3">Tanggal</th>
                        <th class="px-6 py-3">Views</th>
                        <th class="px-6 py-3">Shares</th>
                        <th class="px-6 py-3">Avg Reading Time</th>
                    </tr>
                </thead>

                <tbody class="divide-y">

                    @forelse ($analytics as $data)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                {{ \Carbon\Carbon::parse($data->date)->format('d M Y') }}
                            </td>

                            <td class="px-6 py-4 font-medium text-blue-600">
                                {{ number_format($data->views) }}
                            </td>

                            <td class="px-6 py-4 font-medium text-green-600">
                                {{ number_format($data->shares) }}
                            </td>

                            <td class="px-6 py-4 text-purple-600">
                                {{ round($data->avg_reading_time, 1) }} menit
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4"
                                class="text-center py-8 text-gray-500">
                                Belum ada data analytics
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

    </div>

</div>
@endsection
