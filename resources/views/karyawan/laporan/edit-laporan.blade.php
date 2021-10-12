@extends('layouts.master')

@section('title') Edit Laporan Harian @endsection

@section('laporan-harian-active') active @endsection

@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Laporan Harian</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{route("dashboard")}}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{route("index-laporan-harian")}}">Kandang</a></div>
                    <div class="breadcrumb-item active">Edit Laporan Harian</div>
                </div>
            </div>

            <div class="section-body">
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
                                <h4>Form Buat Laporan Harian</h4>
                            </div>
                            <form method="post" action="{{route("store-laporan-harian")}}" id="form-create-laporan-harian">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="no_kandang">Nomor Kandang</label>
                                            <select class="form-control select2" name="no_kandang" form="form-create-laporan-harian">
                                                @foreach($data as $kandang)
                                                    @if($row->no_kandang == $kandang->no_kandang)
                                                        <option value="{{$kandang->no_kandang}}" selected>{{$kandang->no_kandang}}</option>
                                                    @else
                                                        <option value="{{$kandang->no_kandang}}">{{$kandang->no_kandang}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="tanggal_laporan">Tanggal Laporan Harian</label>
                                        <input type="text" id="tanggal_laporan" name="tanggal_laporan" class="form-control datepicker" value="{{$row->tanggal_laporan}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="jumlah_bebek_sakit">Jumlah Bebek Sakit</label>
                                        <input type="number" id="jumlah_bebek_sakit" name="jumlah_bebek_sakit" class="form-control phone-number" value="{{$row->jumlah_bebek_sakit}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="jumlah_bebek_mati">Jumlah Bebek Mati</label>
                                        <input type="number" id="jumlah_bebek_mati" name="jumlah_bebek_mati" class="form-control phone-number" value="{{$row->jumlah_bebek_mati}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="panen_harian">Jumlah Panen Harian</label>
                                        <input type="number" id="panen_harian" name="panen_harian" step="any" class="form-control" value="{{$row->panen_harian}}">
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="kondisi_kandang">Kondisi Kebersihan Kandang</label>
                                            <select class="form-control select2" name="kondisi_kandang" form="form-create-laporan-harian">
                                                @if($row->kondisi_kandang == "bersih")
                                                    <option value="bersih">Bersih</option>
                                                    <option value="kotor">Kotor</option>
                                                @else
                                                    <option value="bersih">Bersih</option>
                                                    <option value="kotor" selected>Kotor</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_karyawan">Karyawan Penanggung Jawab</label>
                                        <input type="text" id="nama_karyawan" name="nama_karyawan" class="form-control" value="{{Auth::user()->nama}}" disabled>
                                    </div>
                                    <div class="card-footer text-center">
                                        <button class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
{{--                <div class="row">--}}
{{--                    <div class="col-12 col-md-6 col-lg-6">--}}
{{--                        <div class="card">--}}
{{--                            <div class="card-header">--}}
{{--                                <h4>Form Edit User</h4>--}}
{{--                            </div>--}}
{{--                            <form method="post" action="{{route("admin-update-kandang", $row->id)}}" id="form-create-kandang">--}}
{{--                                @csrf--}}
{{--                                <div class="card-body">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="no_kandang">Nomor Kandang</label>--}}
{{--                                        <input type="text" id="no_kandang" name="no_kandang" class="form-control phone-number" value="{{$row->no_kandang}}">--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="jumlah_bebek">Jumlah Bebek</label>--}}
{{--                                        <input type="text" id="jumlah_bebek" name="jumlah_bebek" class="form-control phone-number" value="{{$row->jumlah_bebek}}">--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="tanggal_lahir">Tanggal Lahir Bebek</label>--}}
{{--                                        <input type="text" id="tanggal_lahir" name="tanggal_lahir" class="form-control datepicker" value="{{$row->tanggal_lahir}}">--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label for="role">Karyawan Penanggung Jawab</label>--}}
{{--                                            <select class="form-control select2" name="id_karyawan" form="form-create-kandang">--}}
{{--                                                @foreach($data as $karyawan)--}}
{{--                                                    @if($karyawan->id == $row->id_karyawan)--}}
{{--                                                        <option value="{{$karyawan->id}}" selected>{{$karyawan->nama}}</option>--}}
{{--                                                    @else--}}
{{--                                                        <option value="{{$karyawan->id}}">{{$karyawan->nama}}</option>--}}
{{--                                                    @endif--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="card-footer text-center">--}}
{{--                                        <button class="btn btn-primary">Submit</button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </section>
    </div>

@endsection




