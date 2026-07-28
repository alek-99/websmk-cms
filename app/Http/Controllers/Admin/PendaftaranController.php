<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePendaftaranRequest;
// use App\Http\Requests\UpdatePendaftaranRequest;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PendaftaranController extends Controller
{
    // ─── Konstanta ────────────────────────────────────────────────────────────

    private const FILE_FIELDS = ['foto', 'scan_kk', 'scan_akta', 'scan_ijazah'];
    private const STATUS_LIST  = ['menunggu', 'diverifikasi', 'diterima', 'ditolak'];
    private const AGAMA_LIST   = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'];

    // ─── Index ─────────────────────────────────────────────────────────────────

    public function index(Request $request)
    {
        $query = Pendaftaran::query();

        // Filter pencarian
        if ($search = $request->search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('no_pendaftaran', 'like', "%{$search}%")
                  ->orWhere('nisn', 'like', "%{$search}%");
            });
        }

        // Filter status
        if ($status = $request->status) {
            $query->where('status', $status);
        }

        $pendaftarans = $query->latest()->paginate(15)->withQueryString();

        // Statistik ringkas
        $stats = [
            'total'       => Pendaftaran::count(),
            'menunggu'    => Pendaftaran::where('status', 'menunggu')->count(),
            'diverifikasi' => Pendaftaran::where('status', 'diverifikasi')->count(),
            'diterima'    => Pendaftaran::where('status', 'diterima')->count(),
            'ditolak'     => Pendaftaran::where('status', 'ditolak')->count(),
        ];

        return view('admin.pendaftaran.index', compact('pendaftarans', 'stats'));
    }

    // ─── Store ─────────────────────────────────────────────────────────────────

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

    return redirect()->route('admin.pendaftaran.index')->with('success', 'Data berhasil disimpan');
}

    // ─── Update ────────────────────────────────────────────────────────────────

  public function update(Request $request, Pendaftaran $pendaftaran)
{
    $validated = $request->validate($this->rules($pendaftaran->id));

    foreach (self::FILE_FIELDS as $field) {
        if ($request->hasFile($field)) {

            // Hapus file lama
            if ($pendaftaran->$field && Storage::disk('public')->exists($pendaftaran->$field)) {
                Storage::disk('public')->delete($pendaftaran->$field);
            }

            $file = $request->file($field);

            $filename = time() . '_' . $field . '.' . $file->getClientOriginalExtension();

            $validated[$field] = $file->storeAs(
                "pendaftaran/{$field}",
                $filename,
                'public'
            );
        }
    }

    $pendaftaran->update($validated);

    return redirect()->route('admin.pendaftaran.index')->with('success', 'Data pendaftaran berhasil diperbarui.');
}

    // ─── Update Status ─────────────────────────────────────────────────────────

    public function updateStatus(Request $request, $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $request->validate([
            'status' => ['required', Rule::in(self::STATUS_LIST)],
        ]);

        $pendaftaran->update(['status' => $request->status]);

        return redirect()->route('admin.pendaftaran.index')->with('success', "Status diubah menjadi \"{$request->status}\".");
    }

    // ─── Destroy ───────────────────────────────────────────────────────────────

    public function destroy($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        foreach (self::FILE_FIELDS as $field) {
            if ($pendaftaran->$field) {
                Storage::disk('public')->delete($pendaftaran->$field);
            }
        }

        $pendaftaran->delete();

        return back()->with('success', 'Data pendaftaran berhasil dihapus.');
    }

    // ─── Helper: Validation Rules ──────────────────────────────────────────────

    private function rules(?int $ignoreId = null): array
    {
        return [
            // DATA SISWA
            'nisn'          => ['required', 'digits_between:8,10', Rule::unique('pendaftarans', 'nisn')->ignore($ignoreId)],
            'nik'           => ['required', 'digits:16', Rule::unique('pendaftarans', 'nik')->ignore($ignoreId)],
            'nama_lengkap'  => ['required', 'string', 'max:255'],
            'jenis_kelamin' => ['required', Rule::in(['laki-laki', 'perempuan'])],
            'tempat_lahir'  => ['required', 'string', 'max:100'],
            'tanggal_lahir' => ['required', 'date', 'before:today'],
            'agama'         => ['required', 'string', 'max:50'],
            'alamat'        => ['required', 'string'],
            'no_hp'         => ['required', 'string', 'max:20'],
            'email'         => ['nullable', 'email', 'max:255'],
            // DATA SEKOLAH
            'asal_sekolah'   => ['required', 'string', 'max:255'],
            'npsn_sekolah'   => ['nullable', 'string', 'max:20'],
            'nilai_rata_rata' => ['nullable', 'numeric', 'min:0', 'max:100'],
            // DATA ORANG TUA
            'nama_ayah'      => ['required', 'string', 'max:255'],
            'pekerjaan_ayah' => ['nullable', 'string', 'max:100'],
            'nama_ibu'       => ['required', 'string', 'max:255'],
            'pekerjaan_ibu'  => ['nullable', 'string', 'max:100'],
            'no_hp_ortu'     => ['required', 'string', 'max:20'],
            // BERKAS
            'foto'        => ['nullable', 'image', 'max:2048'],
            'scan_kk'     => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
            'scan_akta'   => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
            'scan_ijazah' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
            // STATUS
            'status' => ['sometimes', Rule::in(self::STATUS_LIST)],
        ];
    }

    public function show($id){
        $pendaftaran = Pendaftaran::findOrFail($id);
        return view('admin.pendaftaran.show',compact('pendaftaran'));
    }
    public function edit($id){
        $pendaftaran = Pendaftaran::findOrFail($id);
        return view('admin.pendaftaran.edit',compact('pendaftaran'));
    }
}