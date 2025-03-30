<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DetailSurat;
use App\Models\Mahasiswa;
use App\Models\PengajuanSurat;
use App\Models\Staff;
use App\Models\Kaprodi;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MhsAktifController extends Controller
{
    public function storeSurat1(Request $request)
{
    // Validasi request
    $request->validate([
        'semester' => 'required|integer|min:1|max:14',
        'address' => 'required|string|min:5',
        'purpose' => 'required|string|min:5',
    ]);

    // Ambil user yang sedang login
    $user = Auth::user();

    // Ambil data mahasiswa berdasarkan id_user
    $mahasiswa = Mahasiswa::where('id_user', $user->id_user)->first();

    if (!$mahasiswa) {
        return redirect()->back()->with('error', 'Mahasiswa tidak ditemukan.');
    }

    try {
        // Simpan data ke dalam tabel detail_surat
        $detailSurat = DetailSurat::create([
            'nama' => $mahasiswa->nama,
            'kategori_surat' => 1,
            'tanggal_surat' => now(),
            'semester' => $request->semester,
            'tujuan_surat' => $request->purpose,
            'alamat_mhs' => $request->address,
        ]);

        // Ambil staff dan kaprodi berdasarkan id_prodi mahasiswa
        $staff = Staff::where('id_prodi', $mahasiswa->id_prodi)->first();
        $kaprodi = Kaprodi::where('id_prodi', $mahasiswa->id_prodi)->first();

        if (!$staff || !$kaprodi) {
            return redirect()->back()->with('error', 'Staff atau Kaprodi tidak ditemukan.');
        }

        // Simpan data ke dalam tabel pengajuansurat
        PengajuanSurat::create([
            'status_surat' => 1,
            'tanggal_perubahan' => now(),
            'id_surat' => $detailSurat->id_surat,
            'nrp' => $mahasiswa->nrp,
            'id_staff' => $staff->id_staff,
            'id_kaprodi' => $kaprodi->id_kaprodi,
        ]);

        // Simpan data dalam session agar bisa ditampilkan di view
        session()->flash('nama', $mahasiswa->nama);
        session()->flash('nrp', $mahasiswa->nrp);
        session()->flash('semester', $request->semester);
        session()->flash('address', $request->address);
        session()->flash('purpose', $request->purpose);

        return redirect()->back()->with('success', 'Surat berhasil diajukan.');

    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
    }
}
}
