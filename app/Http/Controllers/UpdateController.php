<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Visit;
use Illuminate\Support\Facades\Validator;

class UpdateController extends Controller
{
    //Update Data Pasien
    public function pasien(Request $request)
    {
        // Validasi input
        $request->validate([
            'id'         => 'required|exists:patients,id',
            'name'       => 'required|string|max:100',
            'nik'        => 'required|string|max:20|unique:patients,nik,' . $request->id,
            'gender'     => 'required|in:L,P',
            'birth_date' => 'required|date',
            'phone'      => 'required|string|max:15',
            'address'    => 'required|string',
        ]);

        // Update data
        $patient = Patient::find($request->id);
        $patient->update($request->only(['name', 'nik', 'gender', 'birth_date', 'phone', 'address']));

        return redirect()->route('data.pasien')->with('success', 'Data pasien berhasil diupdate.');
    }

    //Update Data Kunjungan
    public function kunjungan(Request $request)
    {
        $request->validate([
            'id'           => 'required|exists:visits,id',
            'patient_id'   => 'required|exists:patients,id',
            'department'   => 'required|string|max:50',
            'doctor_name'  => 'required|string|max:100',
            'visit_date'   => 'required|date',
            'complaint'    => 'required|string|max:1000',
        ]);

        $visit = Visit::findOrFail($request->id);

        $visit->update($request->only([
            'patient_id', 'department', 'doctor_name', 'visit_date', 'complaint'
        ]));

        return redirect()->route('data.kunjungan')->with('success', 'Kunjungan berhasil diperbarui.');
    }
}
