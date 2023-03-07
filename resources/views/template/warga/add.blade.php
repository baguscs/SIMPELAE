@extends('template.core.master')
@section('content')
    <!-- Basic Breadcrumb -->
    <!-- Custom style1 Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('warga.index') }}">Data Warga</a>
            </li>
            <li class="breadcrumb-item active">{{ $titlePage }}</li>
        </ol>
    </nav>

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
            <form action="{{ route('warga.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col mb-2">
                        <label for="nameLarge" class="form-label">Nama Warga</label>
                        <input type="text" id="nameLarge" class="form-control" name="nama_warga" placeholder="Masukkan Nama" value="{{ old('nama_warga') }}" required />
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col mb-2">
                        <label for="nik" class="form-label">NIK</label>
                        <input type="number" id="nik" name="nik" class="form-control" placeholder="Masukkan NIK" value="{{ old('nik') }}" required />
                    </div>
                    <div class="col mb-2">
                        <label for="no_kk" class="form-label">Nomor Kartu Keluarga</label>
                        <input type="number" id="no_kk" class="form-control" placeholder="Masukkan Nomor Kartu Keluarga" name="no_kk" value="{{ old('no_kk') }}" required />
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col mb-2">
                        <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                        <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control" placeholder="Masukkan Tempat Lahir" value="{{ old('tempat_lahir') }}" required />
                    </div>
                    <div class="col mb-2">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" id="tanggal_lahir" class="form-control" placeholder="Masukkan Tanggal Lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required />
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col mb-2">
                        <label for="gender" class="form-label">Jenis Kelamin</label>
                        <select class="form-select" id="gender" name="jenis_kelamin" aria-label="Default select example" required>
                            <option selected disabled>Silahkan Pilih Jenis Kelamin</option>
                            <option value="Laki_Laki" @if (old('jenis_kelamin') == "Laki_Laki") selected @endif>Laki-Laki</option>
                            <option value="Perempuan" @if (old('jenis_kelamin') == "Perempuan") selected @endif>Perempuan</option>
                        </select>
                    </div>
                    <div class="col mb-2">
                        <label for="religion" class="form-label">Agama</label>
                        <select class="form-select" name="agama" id="religion" aria-label="Default select example" required>
                            <option selected disabled>Silahkan Pilih Agama</option>
                            <option value="Islam" @if (old('agama') == "Islam") selected @endif>Islam</option>
                            <option value="Kristen" @if (old('agama') == "Kristen") selected @endif>Kristen</option>
                            <option value="Katolik" @if (old('agama') == "Katolik") selected @endif>Katolik</option>
                            <option value="Hindhu" @if (old('agama') == "Hindhu") selected @endif>Hindhu</option>
                            <option value="Budha" @if (old('agama') == "Budha") selected @endif>Budha</option>
                            <option value="Konghucu" @if (old('agama') == "Konghucu") selected @endif>Konghucu</option>
                        </select>
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col mb-2">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" id="alamat" name="alamat" class="form-control" placeholder="Masukkan Alamat" value="{{ old('alamat') }}" required />
                    </div>
                    <div class="col mb-2">
                        <label for="gender" class="form-label">Wilayah RT</label>
                        <select class="form-select" id="gender" name="wilayah_rts_id" aria-label="Default select example" required>
                            <option selected disabled>Silahkan Pilih Wilayah RT</option>
                            @foreach ($region as $value)
                                <option value="{{ $value->id }}" @if (old('wilayah_rts_id') == $value->id) selected @endif>{{ $value->wilayah }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col mb-2">
                        <label for="no_telp" class="form-label">Nomor Telepon</label>
                        <input type="number" id="no_telp" name="no_telp" class="form-control" placeholder="Masukkan Nomor Telepon" value="{{ old('no_telp') }}" required />
                    </div>
                    <div class="col mb-2">
                        <label for="pekerjaan" class="form-label">Pekerjaan</label>
                        <input type="text" id="pekerjaan" class="form-control" placeholder="Masukkan Pekerjaan" name="pekerjaan" value="{{ old('pekerjaan') }}" required />
                    </div>
                    <div class="col mb-2">
                        <label for="kewarganegaraan" class="form-label">Kewarganegaraan</label>
                        <input type="text" id="kewarganegaraan" class="form-control" placeholder="Masukkan Kewarganegaraan" name="kewarganegaraan" value="{{ old('kewarganegaraan') }}" required />
                    </div>
                </div>  
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('titlePage')
    {{ $titlePage }}
@endpush