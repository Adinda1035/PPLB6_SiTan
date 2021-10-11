@extends('layouts.master')

@section('title') Edit Kandang @endsection

@section('kandang-active') active @endsection

@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Kandang</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{route("dashboard")}}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{route("admin-index-kandang")}}">Kandang</a></div>
                    <div class="breadcrumb-item active">Edit Kandang</div>
                </div>
            </div>

            <div class="section-body">
{{--                <h2 class="section-title">Petunjuk Pengisian Form</h2>--}}
{{--                    <ul class="section-lead">--}}
{{--                        <li>Username wajib diisi minimal 6 karakter.</li>--}}
{{--                        <li>Password wajib diisi minimal 8 karakter.</li>--}}
{{--                    </ul>--}}


                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Form Edit User</h4>
                            </div>
                            <form method="post" action="{{route("admin-update-kandang", $row->id)}}" id="form-create-kandang">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="no_kandang">Nomor Kandang</label>
                                        <input type="text" id="no_kandang" name="no_kandang" class="form-control phone-number" value="{{$row->no_kandang}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="jumlah_bebek">Jumlah Bebek</label>
                                        <input type="text" id="jumlah_bebek" name="jumlah_bebek" class="form-control phone-number" value="{{$row->jumlah_bebek}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="tanggal_lahir">Tanggal Lahir Bebek</label>
                                        <input type="text" id="tanggal_lahir" name="tanggal_lahir" class="form-control datepicker" value="{{$row->tanggal_lahir}}">
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="role">Karyawan Penanggung Jawab</label>
                                            <select class="form-control select2" name="id_karyawan" form="form-create-kandang">
                                                @foreach($data as $karyawan)
                                                    @if($karyawan->id == $row->id_karyawan)
                                                        <option value="{{$karyawan->id}}" selected>{{$karyawan->nama}}</option>
                                                    @else
                                                        <option value="{{$karyawan->id}}">{{$karyawan->nama}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
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




