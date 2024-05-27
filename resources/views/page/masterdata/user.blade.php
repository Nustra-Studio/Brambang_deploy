@extends('layout.master')
    @section('content')
    <div class="container">
        <!-- Title and Top Buttons Start -->
        <div class="page-title-container">
        <div class="row g-0">
            @php
                use App\Models\User;
                use App\Models\transaction;
                $data = User::all();
            @endphp
            <!-- Title Start -->
            <div class="col-auto mb-3 mb-md-0 me-auto">
            <div class="w-auto sw-md-30">
                <a href="#" class="muted-link pb-1 d-inline-block breadcrumb-back">
                <i data-acorn-icon="chevron-left" data-acorn-size="13"></i>
                <span class="text-small align-middle">Home</span>
                </a>
                <h1 class="mb-0 pb-0 display-4" id="title">Data Customer</h1>
            </div>
            </div>
            <!-- Title End -->

            <!-- Top Buttons Start -->
            <div class="w-100 d-md-none"></div>
            <div class="col-12 col-sm-12 col-md-auto d-flex align-items-end justify-content-end mb-2 mb-sm-0 order-sm-3">
            <button
                type="button"
                class="btn btn-outline-primary btn-icon btn-icon-start ms-0 ms-sm-1 w-100 w-md-auto"
                data-bs-toggle="modal"
                data-bs-target="#registerModal"
            >
                <i data-acorn-icon="plus"></i>
                <span>Tambah User</span>
            </button>
            
            </div>
            <!-- Top Buttons End -->
        </div>
        </div>
        <!-- Title and Top Buttons End -->

        <!-- Controls Start -->
        <div class="row mb-2">
        <div class="row">
        <div class="col-12 mb-5">
            <div class="card mb-2 bg-transparent no-shadow d-none d-lg-block">
            <div class="card-body pt-0 pb-0 sh-3">
                <div class="row g-0 h-100 align-content-center">
                <div class="col-12 col-lg-5 d-flex align-items-center mb-2 mb-lg-0 text-muted text-small">Jabatan</div>
                <div class="col-6 col-lg-5 d-flex align-items-center text-alternate text-medium text-muted text-small">Username</div>
                </div>
            </div>
            </div>
            <div id="checkboxTable">
            <!-- start LOOP -->
                <div class="card mb-2">
                    @if (session('status'))
                        <div class="alert alert-primary">
                            {{ session('status')}}
                        </div>
                    @elseif (session('hapus'))
                        <div class="alert alert-danger">
                            {{ session('hapus')}}
                        </div>
                    @endif
                    @foreach ($data as $item)
                    <div class="card-body py-4 py-lg-0 sh-lg-8">
                        <div class="row g-0 h-100 align-content-center">
                            <div class="col-11 col-lg-5 d-flex flex-column justify-content-center mb-2 mb-lg-0 order-1 order-lg-1 h-lg-100 position-relative">
                                <div class="text-muted text-small d-lg-none">Jabatan</div>
                                    <a href="#" class="text-truncate h-100 d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#discountDetailModal">
                                        {{ $item->name }}
                                    </a>
                                </div>
                                    <div class="col-6 col-lg-5 d-flex flex-column justify-content-center mb-2 mb-lg-0 order-3 order-lg-2">
                                        <div class="text-muted text-small d-lg-none">Username</div>
                                        <div class="text-alternate">{{$item->username}}</div>
                                    </div>
                                <div class="col-1 col-lg-1 d-flex flex-column justify-content-center align-items-lg-end mb-2 mb-lg-0 order-2 text-end order-lg-last">
                                <div class="container-fluid d-lg-flex flex-lg-row gap-1 gap-lg-2 justify-content-lg-end">
                                    <div class="col">
                                        <button class="btn btn-primary d-flex justi fy-content-center align-items-center border shadow fw-bold p-3 p-lg-2 p-xl-3" data-bs-toggle="modal" data-bs-target="#editUserModal{{$item->id}}">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                    </div>
                                    <div class="col">
                                        <button class="btn btn-danger d-flex justify-content-center align-items-center border shadow fw-bold p-3 p-lg-2 p-xl-3" data-bs-toggle="modal" data-bs-target="#deleteUserModal{{$item->id}}">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="editUserModal{{$item->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Data User</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{Route('user.update', $item->id)}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                <div class="mb-3">
                                    <label class="form-label"></label>
                                    <input type="text" class="form-control" name="username" value="{{$item->username}}" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Jabatan</label>
                                    <select name="jabatan" class="form-select" id="">
                                        <option value="owner" @if ($item->name === "owner")
                                            selected
                                        @endif>Owner</option>
                                        <option value="karyawan" @if ($item->name === "karyawan")
                                            selected
                                        @endif>Karyawan</option>
                                    </select>
                                    
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password" />
                                </div>
                                
                            </div>
                            <div class="modal-footer border-1">
                                <button class="btn btn-icon btn-icon-end btn-primary" type="submit">
                                    <span>Save</span>
                                    <i data-acorn-icon="save"></i>
                                </button>
                            </div>
                        </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="deleteUserModal{{$item->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title fw-bold">Hapus Data?</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Konfirmasi Hapus Data
                            </div>
                            <div class="modal-footer">
                                <form action="{{Route('user.destroy', $item->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger border shadow" type="submit">Hapus</button>
                                    <button class="btn btn-primary border-1" data-bs-dismiss="modal">Batal</button>
                                </form>
                            </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        </div>
        <!-- Discount List End -->

        <!-- Discount Detail Modal Start -->
        

        <!-- Discount Detail Modal End -->

        <!-- Delete Modal -->
        
        <!-- Delete Modal End -->

        <!-- Discount Add Modal Start -->
        <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">Tambahkan User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('user.store') }}" id="registerForm">
                            @csrf
                            <div class="form-group my-2">
                                <label for="name">Jabatan</label>
                                <select name="jabatan" id="" class="form-select" required>
                                    <option value="owner">Owner</option>
                                    <option value="karyawan">Karyawan</option>
                                </select>
                                @error('jabatan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group my-2">
                                <label for="username">Username</label>
                                <input required type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username') }}" required autocomplete="username">
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group my-2">
                                <label for="password">Password</label>
                                <input required type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group my-2">
                                <label for="password-confirm">Confirm Password </label>
                                <input type="password" class="form-control" id="password-confirm" name="password_confirmation" required autocomplete="new-password">
                                <span class="invalid-feedback" role="alert" id="passwordMismatch">
                                    <strong>Password Tidak Sama</strong>
                                </span>
                            </div>
                            <div class="form-group mt-2">
                                <button type="submit" class="btn btn-primary" id="submitButton" disabled>Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            const password = document.getElementById('password');
            const passwordConfirm = document.getElementById('password-confirm');
            const submitButton = document.getElementById('submitButton');
            const passwordMismatch = document.getElementById('passwordMismatch');
            let timeout;
        
            function validatePasswords() {
    
                    if (password.value === passwordConfirm.value) {
                        passwordMismatch.classList.add('d-none');
                        submitButton.disabled = false;
                    } else {
                        passwordMismatch.classList.remove('d-none');
                        submitButton.disabled = true;
                    }
    
            }
        
            password.addEventListener('input', validatePasswords);
            passwordConfirm.addEventListener('input', validatePasswords);
        </script>
        
        <!-- Discount Add Modal End -->
    </div>
    @endsection