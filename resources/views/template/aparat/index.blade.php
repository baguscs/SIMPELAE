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
                        <th>Jabatan</th>
                        <th>Pekerjaan</th>
                        <th width="100px">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $item->warga->nama_warga }}</td>
                                <td>{{ $item->jabatan->jabatan }} {{ $item->wilayah_rts_id }}</td>
                                <td>{{ $item->warga->pekerjaan }}</td>
                                <td>
                                    <a type="button" href="{{ route('aparat.edit', $item->id) }}" class="btn btn-icon btn-info">
                                        <span class="tf-icons bx bx-edit-alt"></span>
                                    </a>
                                    <button type="button" class="btn btn-icon btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#smallModal{{ $loop->iteration }}">
                                        <span class="tf-icons bx bx-trash"></span>
                                    </button>
                                </td>
                            </tr>

                            {{-- modal hapus --}}
                            <div class="modal fade" id="smallModal{{ $loop->iteration }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-md" role="document">
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
                                                <p>
                                                    Apakah anda yakin ingin menghapus data warga {{ $item->nama_warga }} ?
                                                </p>
                                            </div>
                                        </div>
                                        <form action="{{ route('warga.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                    Batal
                                                </button>
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </div>
                                        </form>
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
            $('#dataTable').DataTable();
        } );
    </script>
@endpush