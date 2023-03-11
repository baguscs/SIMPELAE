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

    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible" role="alert">
            <i class='bx bx-error bx-sm bx-flashing'></i> {{ session()->get('error') }}
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
                        <th>Email</th>
                        <th width="100px">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $item->warga->nama_warga }}</td>
                                <td>{{ $item->jabatan->jabatan }}</td>
                                <td>{{ $item->email }}</td>
                                <td>
                                    <button type="button" class="btn btn-icon btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#largeModal{{ $loop->iteration }}">
                                        <span class="tf-icons bx bx-info-circle"></span>
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
                                            <h5 class="modal-title" id="exampleModalLabel3">Detail Data {{ $item->warga->nama_warga }}</h5>
                                            <button
                                                type="button"
                                                class="btn-close"
                                                data-bs-dismiss="modal"
                                                aria-label="Close"
                                            ></button>
                                        </div>
                                        <form action="" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col mb-2">
                                                        <label for="nameLarge" class="form-label">Nama Warga</label>
                                                        <input type="text" id="nameLarge" class="form-control" name="nama_warga" placeholder="Masukkan Nama" value="{{ $item->warga->nama_warga }}" readonly />
                                                    </div>
                                                </div>
                                                <div class="row g-2">
                                                    <div class="col mb-2">
                                                        <label for="alamat" class="form-label">Alamat</label>
                                                        <input type="text" id="alamat" name="alamat" class="form-control" placeholder="Masukkan Alamat" value="{{ $item->warga->alamat }}" readonly />
                                                    </div>
                                                    <div class="col mb-2">
                                                        <label for="wilayah_rt" class="form-label">Wilayah RT</label>
                                                        <input type="text" id="wilayah_rt" class="form-control" placeholder="Masukkan Wilayah RT" name="wilayah_rt" value="{{ $item->warga->wilayah_rt->wilayah }}" readonly />
                                                    </div>
                                                </div>
                                                <div class="row g-2">
                                                    <div class="col mb-2">
                                                        <label for="jabatan" class="form-label">Jabatan</label>
                                                        <input type="text" id="jabatan" name="jabatan" class="form-control" placeholder="Masukkan Jabatan" value="{{ $item->jabatan->jabatan }}" readonly />
                                                    </div>
                                                    <div class="col mb-2">
                                                        <label for="jabatan" class="form-label">Jabatan</label>
                                                        <select class="form-select" id="jabatan" name="jabatans_id" aria-label="Default select example" disabled>
                                                            <option selected disabled>Silahkan Pilih Jabatan</option>
                                                            @foreach ($jabatan as $value)
                                                                <option value="{{ $value->id }}" @if ($item->jabatans_id == $value->id) selected @endif>{{ $value->jabatan }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>                                             
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                    Tutup
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            {{-- modal hapus --}}
                            <div class="modal fade" id="smallModal{{ $loop->iteration }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable modal-md" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel2">Hapus Data Akun {{ $item->warga->nama_warga }}</h5>
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
                                                    Apakah anda yakin ingin menghapus data akun {{ $item->warga->nama_warga }} ?
                                                </p>
                                            </div>
                                        </div>
                                        <form action="{{ route('akun.destroy', $item->id) }}" method="POST">
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
            $('#dataTable').DataTable({
                
            });
        } );
    </script>
@endpush