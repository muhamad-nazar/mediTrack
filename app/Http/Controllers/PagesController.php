<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Patient;
use App\Models\Visit;
use Carbon\Carbon;

class PagesController extends Controller
{
    // title itu untuk judul Halaman
    // link itu untuk penanda halaman Aktif


    //Tampilkan Halaman Login
    public function login() {
        //Cek Jika sudah Login
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        // Jika Belum Maka Tampilkan Halaman Login
        else{
            return view('pages.auth.login', [
                "title" => "Login",
                "link" => "login"
            ]);
        }
    }

    //Tampilkan Halaman Dashboard
    public function index()
    {
        $totalPatients = Patient::count();

        $monthlyVisits = Visit::whereMonth('visit_date', now()->month)
                            ->whereYear('visit_date', now()->year)
                            ->count();

        $bulan = [];
        $jumlahKunjungan = [];

        foreach (range(1, 12) as $month) {
            $bulan[] = Carbon::create()->month($month)->format('M');
            $jumlahKunjungan[] = Visit::whereMonth('visit_date', $month)
                                    ->whereYear('visit_date', now()->year)
                                    ->count();
        }

        return view('pages.index', [
            'title' => 'Dashboard Medi Track',
            'link' => 'dash',
            'totalPatients' => $totalPatients,
            'monthlyVisits' => $monthlyVisits,
            'bulan' => $bulan,
            'jumlahKunjungan' => $jumlahKunjungan
        ]);
    }

    //Tampilkan Data Pasien
    public function pasien() {
        //Ambil Data Pasien
        $data = Patient::all();

        //Tampilkan Halaman
        return view('pages.admin.pasien', [
            "title" => "Medi Track | Data Pasien",
            "link" => "pasien",
            "data" => $data
        ]);

    }

    //Halaman Daftar Kunjungan
    public function kunjungan(Request $request)
    {
        $query = Visit::with('patient');

        // Jika request POST + ada filter dari user
        if ($request->isMethod('post') && $request->filled('from') && $request->filled('to')) {
            $query->whereBetween('visit_date', [$request->from, $request->to]);
        }
        // Jika GET atau belum filter → tampilkan bulan ini
        else {
            $query->whereMonth('visit_date', now()->month)
                ->whereYear('visit_date', now()->year);
        }

        $visits = $query->orderBy('visit_date', 'desc')->get();

        return view('pages.admin.kunjungan', [
            "title" => "Medi Track | Daftar Kunjungan",
            'link' => 'kunjungan',
            'patients' => Patient::all(),
            'visits' => $visits,
            'departments' => ['Umum', 'Gigi', 'Anak', 'Mata'],
            'doctors' => ['dr. A', 'dr. B', 'dr. C', 'dr. D'],
            'from' => $request->from,
            'to' => $request->to,
        ]);
    }


    //Halaman Detail Lengkap Kunjungan Pasien
    public function kunjunganDetail(Request $request)
    {
        // Cek jika bukan POST atau ID tidak ada
        if (!$request->isMethod('post') || !$request->filled('id')) {
            return redirect()->route('data.kunjungan')->with('error', 'Akses tidak valid atau ID tidak ditemukan.');
        }

        // Validasi ID ada di database
        $request->validate([
            'id' => 'required|exists:visits,id'
        ]);

        // Ambil data kunjungan beserta data pasien
        $visit = Visit::with('patient')->findOrFail($request->id);

        return view('pages.admin.data.kunjungan', [
            'visit' => $visit,
            'title' => 'Detail Kunjungan Pasien',
            'link' => 'kunjungan',
        ]);
    }


    //Halaman data Riwayat Kunjungan
    public function riwayat(Request $request)
    {
        $patients = Patient::all();
        $visits = null;

        if ($request->isMethod('post')) {
            $request->validate([
                'patient_id' => 'required|exists:patients,id'
            ]);

            $visits = Visit::where('patient_id', $request->patient_id)
                        ->orderBy('visit_date', 'desc')
                        ->get();
        }

        return view('pages.admin.riwayat', [
            'title' => 'Riwayat Kunjungan',
            'link' => 'riwayat',
            'patients' => $patients,
            'visits' => $visits,
            'selectedPatientId' => $request->patient_id,
        ]);
    }


    //Halaman Detail Lengkap riwayat kunjungan Pasien
    public function riwayatDetail(Request $request)
    {
        // Cek jika bukan POST atau ID tidak ada
        if (!$request->isMethod('post') || !$request->filled('id')) {
            return redirect()->route('data.riwayat')->with('error', 'Akses tidak valid atau ID tidak ditemukan.');
        }

        // Validasi ID ada di database
        $request->validate([
            'id' => 'required|exists:visits,id'
        ]);

        // Ambil data riwayat beserta data pasien
        $visit = Visit::with('patient')->findOrFail($request->id);

        return view('pages.admin.data.riwayat', [
            'visit' => $visit,
            'title' => 'Detail Riwayat Pasien',
            'link' => 'riwayat',
        ]);
    }

    //Halaman Profile
    public function profile()
    {
        return view('pages.auth.profile', [
            'title' => 'Profile Account',
            'link' => 'profile',
            'user' => auth()->user(),
        ]);
    }


}
