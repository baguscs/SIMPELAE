@extends('template.core.master')
@section('content')
    <!-- Basic Breadcrumb -->
    <!-- Custom style1 Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1">
            <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Ganti Password</li>
        </ol>
    </nav>

    @if (session()->has('message'))
        <div class="alert alert-primary alert-dismissible" role="alert">
            <i class='bx bx-check bx-sm bx-flashing'></i> {{ session()->get('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    @if (session()->has('invalid'))
        <div class="alert alert-danger alert-dismissible" role="alert">
            <i class='bx bx-error bx-sm bx-flashing'></i> {{ session()->get('invalid') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible" role="alert">
            <i class='bx bx-error bx-sm bx-flashing'></i> Konfirmasi Password Anda Salah
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-body">
            <form id="formAccountSettings" method="POST" action="{{ route('updatePassword') }}">
            @csrf
            <div class="row">
                <div class="mb-3 col-md-12">
                    <div class="form-password-toggle">
                        <label class="form-label" for="basic-default-password32">Password Lama</label>
                        <div class="input-group input-group-merge">
                          <input
                            type="password"
                            class="form-control"
                            id="basic-default-password32"
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                            aria-describedby="basic-default-password"
                            name="oldPassword"
                            required
                          />
                          <span class="input-group-text cursor-pointer" id="basic-default-password"
                            ><i class="bx bx-hide"></i
                          ></span>
                        </div>
                    </div>
                </div>
                <div class="mb-3 col-md-12">
                    <div class="form-password-toggle">
                        <label class="form-label" for="basic-default-password32">Password Baru</label>
                        <div class="input-group input-group-merge">
                          <input
                            type="password"
                            class="form-control"
                            id="basic-default-password32"
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                            aria-describedby="basic-default-password"
                            name="password"
                            required
                          />
                          <span class="input-group-text cursor-pointer" id="basic-default-password"
                            ><i class="bx bx-hide"></i
                          ></span>
                        </div>
                    </div>
                </div>
                <div class="mb-3 col-md-12">
                    <div class="form-password-toggle">
                        <label class="form-label" for="basic-default-password32">Konfirmasi Password Baru</label>
                        <div class="input-group input-group-merge">
                          <input
                            type="password"
                            class="form-control"
                            id="basic-default-password32"
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                            aria-describedby="basic-default-password"
                            name="password_confirmation"
                            required
                          />
                          <span class="input-group-text cursor-pointer" id="basic-default-password"
                            ><i class="bx bx-hide"></i
                          ></span>
                        </div>
                    </div>
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
@push('js')
    <script src="{{ asset('assets/js/ui-toasts.js') }}"></script>
@endpush