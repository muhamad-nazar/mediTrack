<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Visit;

class DeleteController extends Controller
{
    //hapus data pasien
    public function pasien(Request $request)
    {
        // Validasi: pastikan field 'id' wajib dan ada di tabel patients
        $request->validate([
            'id' => 'required|exists:patients,id'
        ]);

        // Ambil data pasien berdasarkan ID
        $pasien = Patient::find($request->id);

        // Hapus data dari database
        $pasien->delete();

        // Redirect kembali ke halaman daftar dengan pesan sukses
        return redirect()->route('data.pasien')->with('success', 'Data pasien berhasil dihapus.');
    }

    //Hapus Data Kunjungan
    public function kunjungan(Request $request)
    {
        // Validasi: pastikan ID ada
        $request->validate([
            'id' => 'required|exists:visits,id'
        ]);

        // Hapus data kunjungan
        Visit::findOrFail($request->id)->delete();

        return redirect()->route('data.kunjungan')->with('success', 'Kunjungan berhasil dihapus.');
    }
}
