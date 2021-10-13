@extends('layouts.master')

@section('title') Edit User @endsection

@section('user-active') active @endsection

@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit User</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{route("dashboard")}}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{route("admin-index-user")}}">User</a></div>
                    <div class="breadcrumb-item active">Edit User</div>
                </div>
            </div>

            <div class="section-body">
                <div id="app">
                    @include('flash-message')
                    @yield('messages')
                </div>
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Form Edit User</h4>
                            </div>
                            <form method="post" action="{{route("admin-update-user", $row->id)}}" id="form-create-user">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" id="username" name="username" class="form-control" value="{{$row->username}}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input type="text" id="nama" name="nama" class="form-control" value="{{$row->nama}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" id="email" name="email" class="form-control" value="{{$row->email}}">
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="role">Role</label>
                                            <select class="form-control select2" name="role" form="form-create-user" disabled>
                                                @if($row->getRoleNames()[0] == "admin")
                                                    <option value="admin" selected>Admin</option>
                                                    <option value="karyawan">Karyawan</option>
                                                @elseif ($row->getRoleNames()[0] == "karyawan")
                                                    <option value="admin">Admin</option>
                                                    <option value="karyawan" selected>Karyawan</option>
                                                @endif
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
                                            <input type="text" id="telp" name="telp" class="form-control phone-number" value="{{$row->telp}}">
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
                                        <button class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection




