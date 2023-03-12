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
                <div class="row">
                    <div class="col mt-2">
                        <label for="" class="form-label">Apakah data ini ingin ditambahkan ke akun warga?</label>
                        <div class="col-md">
                            <div class="form-check form-check-inline mt-3">
                                <input
                                class="form-check-input"
                                type="radio"
                                name="make-account"
                                id="inlineRadio1"
                                value="yes"
                                required
                                @if (old('make-account') == 'yes')
                                    checked
                                @endif
                                />
                                <label class="form-check-label" for="inlineRadio1">Ya</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input
                                class="form-check-input"
                                type="radio"
                                name="make-account"
                                id="inlineRadio2"
                                value="no"
                                required
                                @if (old('make-account') == 'no')
                                    checked
                                @endif
                                />
                                <label class="form-check-label" for="inlineRadio2">Tidak</label>
                            </div>
                        </div>
                        <input type="text" name="status_akun" value="0" class="status-akun" hidden>
                    </div>
                    <div class="col form-email" hidden>
                        <label for="email" class="form-label">E-Mail</label>
                        <input type="email" id="email" class="form-control input-email" placeholder="Masukkan Email" name="email" value="{{ old('email') }}"/>
                    </div>
                </div>  
                <div class="mt-4">
                    <a type="button" href="{{ route('warga.index') }}" class="btn btn-outline-secondary">
                        Batal
                    </a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('titlePage')
    {{ $titlePage }}
@endpush
@push('js')
    <script>
        $(document).ready(function () {
            $('.form-check-input').on("change", function () {
                if ($(this).val() == "yes") {
                    $('.form-email').attr('hidden', false);
                    $('.input-email').attr('required', true);
                    $('.status-akun').attr('value', '1');
                } else {
                    $('.form-email').attr('hidden', true);
                    $('.input-email').attr('required', false);
                    $('.status-akun').attr('value', '0');
                }
            })
        })
    </script>
@endpush