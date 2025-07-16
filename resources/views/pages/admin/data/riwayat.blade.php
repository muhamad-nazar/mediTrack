@extends('partials.template')

@section('content')

@if (session('error'))
<div class="alert alert-danger" role="alert">
    {{ session('error') }}
</div>
@endif

<form action="{{ route('data.riwayat') }}" method="POST" style="display:inline;">
    @csrf
    <input type="hidden" name="patient_id" value="{{ $visit->patient->id }}">
    <button type="submit" class="btn btn-info btn-sm">
        <i class="fas fa-arrow-left"></i> Kembali
    </button>
</form>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Detail Riwayat Kunjungan</h6>
    </div>
    <div class="card-body">
        <div class="row align-items-start">

            {{-- Kolom 1: Foto --}}
            <div class="col-md-3 text-center">
                @if ($visit->patient->gender == "L")
                <img src="{{ asset('assets/img/undraw_profile.svg') }}" class="rounded-circle img-thumbnail mb-2" alt="Foto">
                @else
                <img src="{{ asset('assets/img/undraw_profile_1.svg') }}" class="rounded-circle img-thumbnail mb-2" alt="Foto">
                @endif
            </div>

            {{-- Kolom 2: Data Pasien --}}
            <div class="col-md-4">
                <h5 class="mb-3"><strong>Data Pasien</strong></h5>
                <table class="table table-borderless mb-0">
                    <tr>
                        <th style="width: 150px;">Nama</th>
                        <td>: {{ $visit->patient->name }}</td>
                    </tr>
                    <tr>
                        <th>NIK</th>
                        <td>: {{ $visit->patient->nik }}</td>
                    </tr>
                    <tr>
                        <th>Jenis Kelamin</th>
                        <td>: {{ $visit->patient->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Lahir</th>
                        <td>: {{ \Carbon\Carbon::parse($visit->patient->birth_date)->format('j M Y') }}</td>
                    </tr>
                    <tr>
                        <th>No. Telepon</th>
                        <td>: {{ $visit->patient->phone }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>: {{ $visit->patient->address }}</td>
                    </tr>
                </table>

            </div>

            {{-- Kolom 3: Data Kunjungan --}}
            <div class="col-md-5">
                <h5 class="mb-3"><strong>Data Kunjungan</strong></h5>
                <table class="table table-borderless mb-0">
                    <tr>
                        <th style="width: 170px;">Tanggal Kunjungan</th>
                        <td>: {{ \Carbon\Carbon::parse($visit->visit_date)->format('j M Y') }}</td>
                    </tr>
                    <tr>
                        <th>Poli</th>
                        <td>: {{ $visit->department }}</td>
                    </tr>
                    <tr>
                        <th>Dokter</th>
                        <td>: {{ $visit->doctor_name }}</td>
                    </tr>
                    <tr>
                        <th>Keluhan</th>
                        <td>: {{ $visit->complaint }}</td>
                    </tr>
                </table>

            </div>

        </div>
    </div>
</div>

@endsection
