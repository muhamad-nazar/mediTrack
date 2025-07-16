<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Visit;
use Illuminate\Support\Facades\Validator;

class AddController extends Controller
{
    //Tambah Data Pasien
    public function pasien(Request $request)
    {
        //Validasi
        $validator = Validator::make($request->all(), [
            'name'        => 'required|string|max:100',
            'nik'         => 'required|string|max:20|unique:patients,nik',
            'gender'      => 'required|in:L,P',
            'birth_date'  => 'required|date',
            'phone'       => 'required|string|max:15',
            'address'     => 'required|string',
        ]);

        if ($validator->fails()) {
            // Ambil error pertama untuk ditampilkan
            $errorMessage = $validator->errors()->first();
            return redirect()->back()->withInput()->with('error', $errorMessage);
        }

        // Simpan ke database
        Patient::create($validator->validated());

        return redirect()->route('data.pasien')->with('success', 'Data pasien berhasil ditambahkan.');
    }

    //Fungsi Tambah Data Daftar Kunjungan
    public function kunjungan(Request $request)
    {
        // Buat validasi manual
        $validator = Validator::make($request->all(), [
            'patient_id'  => 'required|exists:patients,id',
            'department'  => 'required|string|max:50',
            'doctor_name' => 'required|string|max:100',
            'visit_date'  => 'required|date',
            'complaint'   => 'required|string|max:1000',
        ]);

        // Jika gagal validasi
        if ($validator->fails()) {
            // Ambil pesan error pertama (bisa juga $validator->errors()->all() untuk semua)
            $firstError = $validator->errors()->first();

            return redirect()->back()
                ->withInput()
                ->with('error', $firstError); // ditangkap di blade
        }

        // Simpan ke database jika lolos validasi
        Visit::create([
            'patient_id'   => $request->patient_id,
            'department'   => $request->department,
            'doctor_name'  => $request->doctor_name,
            'visit_date'   => $request->visit_date,
            'complaint'    => $request->complaint,
        ]);

        return redirect()->route('data.kunjungan')->with('success', 'Daftar Kunjungan berhasil ditambahkan.');
    }

}
