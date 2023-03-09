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
                <a href="{{ route('akun.index') }}">Data Akun Warga</a>
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

    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible" role="alert">
            <i class='bx bx-error bx-sm bx-flashing'></i> {{ session()->get('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('akun.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col mb-2">
                        <label for="warga" class="form-label">Nama Warga</label>
                        <select class="form-select data-warga" id="warga" name="wargas_id" aria-label="Default select example" required>
                            <option selected disabled>Silahkan Pilih Nama Warga</option>
                            @foreach ($warga as $item)
                                <option value="{{ $item->id }}" @if (old('wargas_id') == $item->id) selected @endif>{{ $item->nama_warga }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" id="email" class="form-control" name="email" placeholder="Masukkan Email" value="{{ old('email') }}" required />
                    </div>
                </div>
                <div class="mt-3">
                    <a type="button" href="{{ route('akun.index') }}" class="btn btn-outline-secondary">
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
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.data-warga').select2();
        });
    </script>
@endpush
@push('css')
    <style>
        .select2{
            width: 100%!important;
        }
    </style>
@endpush