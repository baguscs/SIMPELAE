@extends('template.core.master')
@section('content')
    <!-- Basic Breadcrumb -->
    <!-- Custom style1 Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1">
            <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Profil Akun</li>
        </ol>
    </nav>

    <div class="card mb-4">
        <div class="card-body">
            <form id="formAccountSettings" method="POST" onsubmit="return false">
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="name" class="form-label">Nama Warga</label>
                    <input
                        class="form-control"
                        type="text"
                        id="name"
                        name="nama_warga"
                        value="{{ Auth::user()->warga->nama_warga }}"
                        readonly
                    />
                </div>
                <div class="mb-3 col-md-6">
                    <label for="nik" class="form-label">Nomor Induk Kependudukan</label>
                    <input class="form-control" type="text" name="nik" id="nik" value="{{ Auth::user()->warga->nik }}" readonly/>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="no_kk" class="form-label">Nomor Kartu Keluarga</label>
                    <input
                        class="form-control"
                        type="text"
                        id="no_kk"
                        name="no_kk"
                        value="{{ Auth::user()->warga->no_kk }}"
                        readonly
                    />
                </div>
                <div class="mb-3 col-md-6">
                    <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                    <input
                        type="text"
                        class="form-control"
                        id="tempat_lahir"
                        name="tempat_lahir"
                        value="{{ Auth::user()->warga->tempat_lahir }}"
                        readonly
                    />
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="tanggal_lahir">Tanggal Lahir</label>
                    <input
                    type="text"
                    id="tanggal_lahir"
                    name="tanggal_lahir"
                    class="form-control"
                    value="{{ Auth::user()->warga->no_telp }}"
                    readonly
                    />
                </div>
                <div class="mb-3 col-md-6">
                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                    <input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin" value="{{ Auth::user()->warga->jenis_kelamin }}" readonly />
                </div>
                <div class="mb-3 col-md-6">
                    <label for="agama" class="form-label">Agama</label>
                    <input class="form-control" type="text" id="agama" name="agama" value="{{ Auth::user()->warga->agama }}" readonly/>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="pekerjaan" class="form-label">Pekerjaan</label>
                    <input
                        type="text"
                        class="form-control"
                        id="pekerjaan"
                        name="pekerjaan"
                        value="{{ Auth::user()->warga->pekerjaan }}"
                        readonly
                    />
                </div>
                <div class="mb-3 col-md-6">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input class="form-control" type="text" id="alamat" name="alamat" value="{{ Auth::user()->warga->alamat }}" readonly/>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="wilayah_rt" class="form-label">Wilayah RT</label>
                    <input
                        type="text"
                        class="form-control"
                        id="wilayah_rt"
                        name="wilayah_rt"
                        value="{{ Auth::user()->warga->wilayah_rt->wilayah }}"
                        readonly
                    />
                </div>
                <div class="mb-3 col-md-6">
                    <label for="warganegara" class="form-label">Kewarganegaraan</label>
                    <input class="form-control" type="text" id="warganegara" name="warganegara" value="{{ Auth::user()->warga->kewarganegaraan }}" readonly/>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input
                        type="text"
                        class="form-control"
                        id="email"
                        name="email"
                        value="{{ Auth::user()->email }}"
                    />
                </div>
            </div>
            <div class="mt-2 float-right">
                <button type="submit" class="btn btn-primary me-2">Simpan</button>
                <a type="button" href="{{ route('dashboard') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
            </form>
        </div>
    </div>
@endsection
@push('titlePage')
    {{ $titlePage }}
@endpush