<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePendaftaranRequest;
use App\Models\Pendaftaran;

class PpdbController extends Controller
{
   public function store(StorePendaftaranRequest $request)
{
    $data = $request->validated();

    $data['no_pendaftaran'] = Pendaftaran::generateNoPendaftaran();
    if ($request->hasFile('foto')) {
    $data['foto'] = $request->file('foto')->store('pendaftaran/foto', 'public');
}

if ($request->hasFile('scan_kk')) {
    $data['scan_kk'] = $request->file('scan_kk')->store('pendaftaran/scan_kk', 'public');
}

if ($request->hasFile('scan_akta')) {
    $data['scan_akta'] = $request->file('scan_akta')->store('pendaftaran/scan_akta', 'public');
}

if ($request->hasFile('scan_ijazah')) {
    $data['scan_ijazah'] = $request->file('scan_ijazah')->store('pendaftaran/scan_ijazah', 'public');
}
    Pendaftaran::create($data);

    return redirect()->back()->with('success', 'Data berhasil disimpan');
}

}
