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
                <a href="{{ route('aparat.index') }}">Data Aparat</a>
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
            <form action="{{ route('aparat.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col mb-2">
                        <label for="warga" class="form-label">Warga</label>
                        <select class="form-select data-warga" id="warga" name="wargas_id" aria-label="Default select example" required>
                            <option selected disabled>Silahkan Pilih Nama Warga</option>
                            @foreach ($warga as $item)
                                <option value="{{ $item->id }}" @if ($aparat->wargas_id == $item->id) selected @endif>{{ $item->nama_warga }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col mb-2">
                        <label for="jabatan" class="form-label">Jabatan</label>
                        <select class="form-select" id="jabatan" name="jabatans_id" aria-label="Default select example" required>
                            <option selected disabled>Silahkan Pilih Jabatan</option>
                            @foreach ($jabatan as $item)
                                <option value="{{ $item->id }}" @if ($aparat->jabatans_id == $item->id) selected @endif>{{ $item->jabatan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col mb-2 field-wilayah">
                        <label for="wilayah" class="form-label">Wilayah</label>
                        <select class="form-select form-wilayah" id="wilayah" name="wilayah_rts_id" aria-label="Default select example">
                            <option selected disabled>Silahkan Pilih Wilayah RT</option>
                            @foreach ($region as $item)
                                <option value="{{ $item->id }}" @if (old('wilayah_rts_id') == $item->id) selected @endif>{{ $item->wilayah }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="{{ route('aparat.index') }}" type="button" class="btn btn-outline-secondary">
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
            
            if ({{ $aparat->jabatans_id }} == 1) {
                $('.field-wilayah').attr('hidden', true);
            }

            $('#jabatan').on("change", function () {
                if ($(this).val() == 2) {
                    $('.field-wilayah').removeAttr('hidden');
                    $('#wilayah').attr('required', true);
                } else {
                    $('.field-wilayah').attr('hidden', true);
                    $('#wilayah').removeAttr('required');
                }
            })
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