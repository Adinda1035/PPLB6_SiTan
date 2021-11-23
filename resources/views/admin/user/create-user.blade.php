@extends('layouts.master')

@section('title') Buat User @endsection

@section('user-active') active @endsection
@section('create-user-active') active @endsection

@section('content')
<!-- Main Content -->
<form method="post" action="{{route("admin-store-user")}}" id="form-create-user">
    @csrf
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Buat User</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{route("dashboard")}}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{route("admin-index-user")}}">User</a></div>
                    <div class="breadcrumb-item active">Buat User</div>
                </div>
            </div>

            <div class="section-body">
                <div id="app">
                    @include('flash-message')
                    @yield('messages')
                </div>
                <h2 class="section-title">Petunjuk Pengisian Form</h2>
                    <ul class="section-lead">
                        <li>Username wajib diisi minimal 6 karakter.</li>
                        <li>Password wajib diisi minimal 8 karakter.</li>
                    </ul>


                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Form Registrasi User</h4>
                            </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" id="username" name="username" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input type="text" id="nama" name="nama" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" id="email" name="email" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="role">Role</label>
                                            <select class="form-control select2" name="role" form="form-create-user">
                                                <option value="admin">Admin</option>
                                                <option value="karyawan">Karyawan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="telp">Nomor Telepon</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-phone"></i>
                                                </div>
                                            </div>
                                            <input type="text" id="telp" name="telp" class="form-control phone-number">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-lock"></i>
                                                </div>
                                            </div>
                                            <input type="password" id="password" name="password" class="form-control pwstrength" data-indicator="pwindicator">
                                        </div>
                                        <div id="pwindicator" class="pwindicator">
                                            <div class="bar"></div>
                                            <div class="label"></div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-center">
                                        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal-create">Submit</button>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modal-create" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary" id="exampleModalCenterTitle">Konfirmasi Pembuatan User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Yakin untuk menambahkan user ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->
</form>


@endsection




