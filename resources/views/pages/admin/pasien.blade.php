@extends('partials.template')

@section('content')
<!-- Begin Page Content -->

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
        <button type="button" data-bs-toggle="modal" data-bs-target="#addModal" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-plus fa-sm text-white-50"></i> Tambah Pasien</button>
    </div>

    <!--Modal Tambah Data-->

    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="addModalLabel">Data Pasien</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('pasien.add') }}" method="POST">
                @csrf
                <div class="modal-body">

                    <label class="form-label d-block">
                        <span class="me-2"><i class="fas fa-user"></i></span> Nama
                    </label>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" name="name" class="form-control" maxlength="100" placeholder="Nama Lengkap" value="{{ old('name') }}" required>
                    </div>

                    <label class="form-label d-block">
                        <span class="me-2"><i class="fas fa-id-card"></i></span> NIK
                    </label>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                        <input type="text" name="nik" maxlength="20" class="form-control" placeholder="NIK" value="{{ old('nik') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label d-block">
                            <span class="me-2"><i class="fas fa-venus-mars"></i></span> Jenis Kelamin
                        </label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="genderL" value="L" {{ old('gender') == 'L' ? 'checked' : '' }} required>
                            <label class="form-check-label" for="genderL">Laki-laki</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="genderP" value="P" {{ old('gender') == 'P' ? 'checked' : '' }} required>
                            <label class="form-check-label" for="genderP">Perempuan</label>
                        </div>
                    </div>

                    <label class="form-label d-block">
                        <span class="me-2"><i class="fas fa-calendar"></i></span> Tanggal Lahir
                    </label>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                        <input type="date" name="birth_date" class="form-control" value="{{ old('birth_date') }}" required>
                    </div>

                    <label class="form-label d-block">
                        <span class="me-2"><i class="fas fa-phone"></i></span> No.Telepon
                    </label>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                        <input type="text" name="phone" class="form-control" maxlength="20" placeholder="No. Telepon" value="{{ old('phone') }}" required>
                    </div>

                    <label class="form-label d-block">
                        <span class="me-2"><i class="fas fa-home"></i></span> Alamat
                    </label>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-home"></i></span>
                        <textarea name="address" class="form-control" placeholder="Alamat" rows="2" required>{{ old('address') }}</textarea>
                    </div>

                </div>

                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Tambah Pasien</button>
                </div>

            </form>

          </div>
        </div>
    </div>

    <!--End Modal -->


    <!-- DataTales Pasien -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Pasien</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <th>Nama</th>
                            <th>NIK</th>
                            <th>Jenis Kelamin</th>
                            <th>Tgl Lahir</th>
                            <th>No. Telepon</th>
                            <th>Alamat</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <!--Looping-->
                        @forelse ($data as $index => $patient)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $patient->name }}</td>
                            <td>{{ $patient->nik }}</td>
                            <td class="text-center">
                                {{ $patient->gender === 'L' ? 'Laki-laki' : 'Perempuan' }}
                            </td>
                            <td>{{ \Carbon\Carbon::parse($patient->birth_date)->format('j M Y') }}</td>
                            <td>{{ $patient->phone }}</td>
                            <td>{{ $patient->address }}</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#UpdateModal{{ $patient->id }}">
                                    <i class="fas fa-pen-square"></i>
                                </button>
                                {{-- Form untuk menghapus pasien, tanpa menampilkan ID di URL --}}
                                <form action="{{ route('pasien.delete') }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus data pasien ini?')">
                                    @csrf
                                    @method('DELETE') {{-- Spoofing method agar jadi DELETE, karena HTML form hanya dukung GET & POST --}}

                                    {{-- Hidden input untuk mengirim ID pasien secara aman tanpa ditampilkan di URL --}}
                                    <input type="hidden" name="id" value="{{ $patient->id }}">

                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>


                            </td>

                            <!--Modal Update-->
                            <div class="modal fade" id="UpdateModal{{ $patient->id }}" tabindex="-1" aria-labelledby="UpdateModal{{ $patient->id }}Label" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h1 class="modal-title fs-5" id="UpdateModal{{ $patient->id }}Label">Data Pasien</h1>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <form action="{{ route('pasien.update') }}" method="POST">
                                    @csrf
                                    @method('PUT') {{-- Spoofing method agar dianggap sebagai PUT request (untuk update) --}}

                                    <div class="modal-body">

                                        {{-- Hidden input: ID pasien untuk diproses di backend --}}
                                        <input type="hidden" name="id" value="{{ $patient->id }}">

                                        {{-- Nama --}}
                                        <label class="form-label d-block">
                                            <span class="me-2"><i class="fas fa-user"></i></span> Nama
                                        </label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            <input type="text" name="name" class="form-control" placeholder="Nama" value="{{ $patient->name }}" required maxlength="100">
                                        </div>

                                        {{-- NIK --}}
                                        <label class="form-label d-block">
                                            <span class="me-2"><i class="fas fa-id-card"></i></span> NIK
                                        </label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                            <input type="text" name="nik" class="form-control" placeholder="NIK" value="{{ $patient->nik }}" required maxlength="20">
                                        </div>

                                        {{-- Jenis Kelamin --}}
                                        <div class="mb-3">
                                            <label class="form-label d-block">
                                                <span class="me-2"><i class="fas fa-venus-mars"></i></span> Jenis Kelamin
                                            </label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gender" id="genderL{{ $patient->id }}" value="L" {{ $patient->gender == 'L' ? 'checked' : '' }} required>
                                                <label class="form-check-label" for="genderL{{ $patient->id }}">Laki-laki</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gender" id="genderP{{ $patient->id }}" value="P" {{ $patient->gender == 'P' ? 'checked' : '' }} required>
                                                <label class="form-check-label" for="genderP{{ $patient->id }}">Perempuan</label>
                                            </div>
                                        </div>


                                        {{-- Tanggal Lahir --}}
                                        <label class="form-label d-block">
                                            <span class="me-2"><i class="fas fa-calendar"></i></span> Tanggal Lahir
                                        </label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                            <input type="date" name="birth_date" class="form-control" value="{{ $patient->birth_date }}" required>
                                        </div>

                                        {{-- No Telepon --}}
                                        <label class="form-label d-block">
                                            <span class="me-2"><i class="fas fa-phone"></i></span> No. Telepon
                                        </label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            <input type="text" name="phone" class="form-control" placeholder="No. Telepon" value="{{ $patient->phone }}" required maxlength="15">
                                        </div>

                                        {{-- Alamat --}}
                                        <label class="form-label d-block">
                                            <span class="me-2"><i class="fas fa-home"></i></span> Alamat
                                        </label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text"><i class="fas fa-home"></i></span>
                                            <textarea name="address" class="form-control" placeholder="Alamat" required>{{ $patient->address }}</textarea>
                                        </div>

                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form>


                                  </div>
                                </div>
                            </div>
                            <!--End Modal Update-->
                        </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Tidak ada data pasien.</td>
                            </tr>
                        @endforelse
                        <!--End Looping-->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<!-- /.container-fluid -->
@endsection
