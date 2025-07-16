@extends('partials.template')

@section('content')
<!-- Begin Page Content -->
    @if ($errors->any())
    <div class="alert alert-danger" role="alert">
        <h3>Gagal!!!</h3>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Form Pencarian Pasien -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Cari Nama Pasien</h6>
        </div>
        <div class="card-body">
           <form action="{{ route('data.riwayat') }}" method="POST">
            @csrf
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <select name="patient_id" class="form-select" required>
                        <option value="">-- Pilih Pasien --</option>
                        @foreach ($patients as $p)
                            <option value="{{ $p->id }}"
                                {{ (isset($selectedPatientId) && $selectedPatientId == $p->id) ? 'selected' : '' }}>
                                {{ $p->name }} ({{ $p->nik }})
                            </option>
                        @endforeach
                    </select>
                    <button class="btn btn-success" type="submit">Search</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabel Riwayat Kunjungan -->
    @if(isset($visits))
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Riwayat Kunjungan</h6>
        </div>
        <div class="card-body">
            @if($visits->isEmpty())
                <p class="text-center">Tidak ada riwayat kunjungan untuk pasien ini.</p>
            @else
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead class="text-center">
                        <tr>
                            <th>#</th>
                            <th>Tanggal Kunjungan</th>
                            <th>Poli</th>
                            <th>Dokter</th>
                            <th>Keluhan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($visits as $index => $v)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ \Carbon\Carbon::parse($v->visit_date)->format('j M Y') }}</td>
                            <td>{{ $v->department }}</td>
                            <td>{{ $v->doctor_name }}</td>
                            <td>{{ $v->complaint }}</td>
                            <td class="text-center">
                                <form action="{{ route('riwayat.detail') }}" method="POST" style="display:inline;">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $v->id }}">
                                    <button type="submit" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </form>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>
    @endif
<!-- /.container-fluid -->
@endsection
