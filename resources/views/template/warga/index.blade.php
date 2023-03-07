@extends('template.core.master')
@section('content')
    <!-- Basic Breadcrumb -->
    <!-- Custom style1 Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1">
            <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">{{ $titlePage }}</li>
        </ol>
    </nav>

    @if (session()->has('message'))
        <div class="alert alert-primary alert-dismissible" role="alert">
            <i class='bx bx-check bx-sm bx-flashing'></i> {{ session()->get('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible" role="alert">
            <i class='bx bx-error bx-sm bx-flashing'></i> @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                  <table class="table" id="dataTable">
                    <thead>
                      <tr class="text-nowrap">
                        <th>Nama Warga</th>
                        <th width="250px">NIK</th>
                        <th>Wilayah RT</th>
                        <th>Akun</th>
                        <th width="100px">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $item->nama_warga }}</td>
                                <td>{{ $item->nik }}</td>
                                <td>{{ $item->wilayah_rt->wilayah }}</td>
                                <td>
                                    @if ($item->status_akun == 0)
                                        <span class="badge rounded-pill bg-label-danger">Belum Terdaftar</span>
                                    @else
                                        <span class="badge rounded-pill bg-label-primary">Terdaftar</span>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-icon btn-info" data-bs-toggle="modal"
                                    data-bs-target="#largeModal{{ $loop->iteration }}">
                                        <span class="tf-icons bx bx-edit-alt"></span>
                                    </button>
                                    <button type="button" class="btn btn-icon btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#smallModal{{ $loop->iteration }}">
                                        <span class="tf-icons bx bx-trash"></span>
                                    </button>
                                </td>
                            </tr>

                            {{-- modal edit --}}
                            <div class="modal fade" id="largeModal{{ $loop->iteration }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel3">Edit Data {{ $item->nama_warga }}</h5>
                                            <button
                                                type="button"
                                                class="btn-close"
                                                data-bs-dismiss="modal"
                                                aria-label="Close"
                                            ></button>
                                        </div>
                                        <form action="{{ route('warga.update', $item->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col mb-2">
                                                        <label for="nameLarge" class="form-label">Nama Warga</label>
                                                        <input type="text" id="nameLarge" class="form-control" name="nama_warga" placeholder="Masukkan Nama" value="{{ $item->nama_warga }}" required />
                                                    </div>
                                                </div>
                                                <div class="row g-2">
                                                    <div class="col mb-2">
                                                        <label for="nik" class="form-label">NIK</label>
                                                        <input type="number" id="nik" name="nik" class="form-control" placeholder="Masukkan NIK" value="{{ $item->nik }}" required />
                                                    </div>
                                                    <div class="col mb-2">
                                                        <label for="no_kk" class="form-label">Nomor Kartu Keluarga</label>
                                                        <input type="number" id="no_kk" class="form-control" placeholder="Masukkan Nomor Kartu Keluarga" name="no_kk" value="{{ $item->no_kk }}" required />
                                                    </div>
                                                </div>
                                                <div class="row g-2">
                                                    <div class="col mb-2">
                                                        <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                                        <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control" placeholder="Masukkan Tempat Lahir" value="{{ $item->tempat_lahir }}" required />
                                                    </div>
                                                    <div class="col mb-2">
                                                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                                        <input type="date" id="tanggal_lahir" class="form-control" placeholder="Masukkan Nomor Kartu Keluarga" name="tanggal_lahir" value="{{ $item->tanggal_lahir }}" required />
                                                    </div>
                                                </div>
                                                <div class="row g-2">
                                                    <div class="col mb-2">
                                                        <label for="gender" class="form-label">Jenis Kelamin</label>
                                                        <select class="form-select" id="gender" name="jenis_kelamin" aria-label="Default select example" required>
                                                            <option selected disabled>Silahkan Pilih Jenis Kelamin</option>
                                                            <option value="Laki_Laki" @if ($item->jenis_kelamin == "Laki_Laki") selected @endif>Laki-Laki</option>
                                                            <option value="Perempuan" @if ($item->jenis_kelamin == "Perempuan") selected @endif>Perempuan</option>
                                                        </select>
                                                    </div>
                                                    <div class="col mb-2">
                                                        <label for="religion" class="form-label">Agama</label>
                                                        <select class="form-select" name="agama" id="religion" aria-label="Default select example" required>
                                                            <option selected disabled>Silahkan Pilih Agama</option>
                                                            <option value="Islam" @if ($item->agama == "Islam") selected @endif>Islam</option>
                                                            <option value="Kristen" @if ($item->agama == "Kristen") selected @endif>Kristen</option>
                                                            <option value="Katolik" @if ($item->agama == "Katolik") selected @endif>Katolik</option>
                                                            <option value="Hindhu" @if ($item->agama == "Hindhu") selected @endif>Hindhu</option>
                                                            <option value="Budha" @if ($item->agama == "Budha") selected @endif>Budha</option>
                                                            <option value="Konghucu" @if ($item->agama == "Konghucu") selected @endif>Konghucu</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row g-2">
                                                    <div class="col mb-2">
                                                        <label for="alamat" class="form-label">Alamat</label>
                                                        <input type="text" id="alamat" name="alamat" class="form-control" placeholder="Masukkan Alamat" value="{{ $item->alamat }}" required />
                                                    </div>
                                                    <div class="col mb-2">
                                                        <label for="gender" class="form-label">Wilayah RT</label>
                                                        <select class="form-select" id="gender" name="wilayah_rts_id" aria-label="Default select example" required>
                                                            <option selected disabled>Silahkan Pilih Wilayah RT</option>
                                                            @foreach ($region as $value)
                                                                <option value="{{ $value->id }}" @if ($item->wilayah_rts_id == $value->id) selected @endif>{{ $value->wilayah }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row g-2">
                                                    <div class="col mb-2">
                                                        <label for="no_telp" class="form-label">Nomor Telepon</label>
                                                        <input type="number" id="no_telp" name="no_telp" class="form-control" placeholder="Masukkan Nomor Telepon" value="{{ $item->no_telp }}" required />
                                                    </div>
                                                    <div class="col mb-2">
                                                        <label for="pekerjaan" class="form-label">Pekerjaan</label>
                                                        <input type="text" id="pekerjaan" class="form-control" placeholder="Masukkan Pekerjaan" name="pekerjaan" value="{{ $item->pekerjaan }}" required />
                                                    </div>
                                                    <div class="col mb-2">
                                                        <label for="kewarganegaraan" class="form-label">Kewarganegaraan</label>
                                                        <input type="text" id="kewarganegaraan" class="form-control" placeholder="Masukkan Kewarganegaraan" name="kewarganegaraan" value="{{ $item->kewarganegaraan }}" required />
                                                    </div>
                                                </div>                                                
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                    Batal
                                                </button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            {{-- modal hapus --}}
                            <div class="modal fade" id="smallModal{{ $loop->iteration }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-sm" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel2">Hapus Data {{ $item->nama_warga }}</h5>
                                            <button
                                                type="button"
                                                class="btn-close"
                                                data-bs-dismiss="modal"
                                                aria-label="Close"
                                            ></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col mb-3">
                                                    <label for="nameSmall" class="form-label">Name</label>
                                                    <input type="text" id="nameSmall" class="form-control" placeholder="Enter Name" />
                                                </div>
                                            </div>
                                            <div class="row g-2">
                                                <div class="col mb-0">
                                                    <label class="form-label" for="emailSmall">Email</label>
                                                    <input type="text" class="form-control" id="emailSmall" placeholder="xxxx@xxx.xx" />
                                                </div>
                                                <div class="col mb-0">
                                                    <label for="dobSmall" class="form-label">DOB</label>
                                                    <input id="dobSmall" type="text" class="form-control" placeholder="DD / MM / YY" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                Close
                                            </button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endforeach
                    </tbody>
                  </table>
                </div>
        </div>
    </div>
@endsection
@push('titlePage')
    {{ $titlePage }}
@endpush
@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css">
@endpush
@push('js')
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#dataTable').DataTable({
                
            });
        } );
    </script>
@endpush