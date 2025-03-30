<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailSurat;

class SuratController extends Controller
{
    // Menampilkan daftar pengajuan surat
    public function index()
    {
        // Ambil semua data dari tabel detailsurat
        $detailsurat = DetailSurat::all();

        // Kirim ke view status.blade.php
        return view('status', compact('detailsurat'));
    }

    // Menampilkan detail surat berdasarkan ID
    public function show($id)
    {
        // Cari data berdasarkan ID
        $detail = DetailSurat::findOrFail($id);

        // Kirim ke view detail surat (buat file `detail.blade.php` jika perlu)
        return view('detail', compact('detail'));
    }
}
