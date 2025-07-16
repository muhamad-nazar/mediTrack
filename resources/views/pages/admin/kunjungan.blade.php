@extends('partials.template')

@section('content')

@if (session('success'))
<div class="alert alert-success" role="alert">
    {{ session('success') }}
</div>
@endif

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

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <button type="button" data-bs-toggle="modal" data-bs-target="#addModal" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Kunjungan
    </button>
</div>

<!-- Modal Tambah Kunjungan -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="addModalLabel">Form Kunjungan Pasien</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form action="{{ route('kunjungan.add') }}" method="POST">
            @csrf
            <div class="modal-body">

                {{-- Pasien --}}
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <select name="patient_id" class="form-select" required>
                        <option value="">-- Pilih Pasien --</option>
                        @foreach ($patients as $p)
                            <option value="{{ $p->id }}">{{ $p->name }} ({{ $p->nik }})</option>
                        @endforeach
                    </select>
                </div>

                {{-- Poli --}}
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fas fa-hospital"></i></span>
                    <select name="department" class="form-select" required>
                        <option value="">-- Pilih Poli --</option>
                        @foreach ($departments as $dept)
                            <option value="{{ $dept }}">{{ $dept }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Dokter --}}
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fas fa-user-md"></i></span>
                    <select name="doctor_name" class="form-select" required>
                        <option value="">-- Pilih Dokter --</option>
                        @foreach ($doctors as $doc)
                            <option value="{{ $doc }}">{{ $doc }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Tanggal --}}
                <label class="form-label d-block">
                        <span class="me-2"><i class="fas fa-calendar"></i></span> Tanggal Kunjungan
                </label>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                    <input type="date" name="visit_date" class="form-control" required>
                </div>

                {{-- Keluhan --}}
                <label class="form-label d-block">
                        <span class="me-2"><i class="fas fa-notes-medical"></i></span> Keluhan
                </label>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fas fa-notes-medical"></i></span>
                    <textarea name="complaint" class="form-control" placeholder="Keluhan Pasien" rows="2" required></textarea>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Tambah Daftar Kunjungan</button>
            </div>
        </form>
      </div>
    </div>
</div>
<!-- End Modal Tambah Kunjungan -->



<!--Search by tanggal-->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Filter Data Kunjungan</h6>
    </div>
    <div class="card-body">
        <!-- Filter Tanggal -->
        <form method="POST" action="{{ route('data.kunjungan') }}" class="mb-4">
            @csrf
           <div class="input-group mb-4">
                {{-- Dari Tanggal --}}
                <span class="input-group-text"><i class="fas fa-calendar-day"></i></span>
                <input type="date" name="from" class="form-control" value="{{ old('from', $from ?? '') }}" required>

                {{-- Sampai Tanggal --}}
                <span class="input-group-text"><i class="fas fa-calendar-day"></i></span>
                <input type="date" name="to" class="form-control" value="{{ old('to', $to ?? '') }}" required>

                {{-- Tombol Filter & Reset --}}
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('data.kunjungan') }}" class="btn btn-secondary">Reset</a>
            </div>

        </form>

    </div>

</div>
<!--End Search-->



<!-- Tabel Data Kunjungan -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Kunjungan</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="text-center">
                    <tr>
                        <th>#</th>
                        <th>Pasien</th>
                        <th>Tanggal</th>
                        <th>Poli</th>
                        <th>Dokter</th>
                        <th>Keluhan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($visits as $index => $v)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $v->patient->name ?? '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($v->visit_date)->format('j M Y') }}</td>
                        <td>{{ $v->department }}</td>
                        <td>{{ $v->doctor_name }}</td>
                        <td>{{ $v->complaint }}</td>
                        <td class="text-center">
                            {{-- Tombol Detail --}}
                            <form action="{{ route('kunjungan.detail') }}" method="POST" style="display:inline;">
                                @csrf
                                <input type="hidden" name="id" value="{{ $v->id }}">
                                <button type="submit" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </form>


                            {{-- Tombol Edit / Update --}}
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#UpdateModal{{ $v->id }}">
                                <i class="fas fa-pen-square"></i>
                            </button>

                            {{-- Tombol Delete --}}
                            <form action="{{ route('kunjungan.delete') }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus kunjungan ini?')">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="{{ $v->id }}">
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>

                        <!-- Modal Update -->
                        <div class="modal fade" id="UpdateModal{{ $v->id }}" tabindex="-1" aria-labelledby="UpdateModalLabel{{ $v->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                            <form action="{{ route('kunjungan.update') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                <h5 class="modal-title" id="UpdateModalLabel{{ $v->id }}">Edit Kunjungan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <input type="hidden" name="id" value="{{ $v->id }}">

                                    {{-- Pasien --}}
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        <select name="patient_id" class="form-select" required>
                                            <option value="">-- Pilih Pasien --</option>
                                            @foreach ($patients as $p)
                                                <option value="{{ $p->id }}" {{ $p->id == $v->patient_id ? 'selected' : '' }}>
                                                    {{ $p->name }} ({{ $p->nik }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- Poli --}}
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><i class="fas fa-hospital"></i></span>
                                        <select name="department" class="form-select" required>
                                            <option value="">-- Pilih Poli --</option>
                                            @foreach ($departments as $dept)
                                                <option value="{{ $dept }}" {{ $v->department == $dept ? 'selected' : '' }}>
                                                    {{ $dept }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- Dokter --}}
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><i class="fas fa-user-md"></i></span>
                                        <select name="doctor_name" class="form-select" required>
                                            <option value="">-- Pilih Dokter --</option>
                                            @foreach ($doctors as $doc)
                                                <option value="{{ $doc }}" {{ $v->doctor_name == $doc ? 'selected' : '' }}>
                                                    {{ $doc }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- Tanggal --}}
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                        <input type="date" name="visit_date" class="form-control" value="{{ $v->visit_date }}" required>
                                    </div>

                                    {{-- Keluhan --}}
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><i class="fas fa-notes-medical"></i></span>
                                        <textarea name="complaint" class="form-control" rows="2" required>{{ $v->complaint }}</textarea>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </form>
                            </div>
                        </div>
                        </div>
                        <!-- End Modal Update -->


                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Belum ada data kunjungan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
