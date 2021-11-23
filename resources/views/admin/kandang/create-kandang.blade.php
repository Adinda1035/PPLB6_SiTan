@extends('layouts.master')

@section('title') Buat Kandang @endsection

@section('kandang-active') active @endsection
@section('create-kandang-active') active @endsection

@section('content')
<form method="post" action="{{route("admin-store-kandang")}}" id="form-create-kandang">
    @csrf
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Buat Kandang</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{route("dashboard")}}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{route("admin-index-kandang")}}">Kandang</a></div>
                    <div class="breadcrumb-item active">Buat Kandang</div>
                </div>
            </div>

            <div class="section-body">
                <div id="app">
                    @include('flash-message')
                    @yield('messages')
                </div>
                <h2 class="section-title">Petunjuk Pengisian Form</h2>
                    <ul class="section-lead">
                        <li>No. Kandang merupakan nomor dari kandang tersebut.</li>
                        <li>Jumlah bebek merupakan angka yang menandakan jumlah bebek dalam kandang tersebut.</li>
                        <li>Tanggal Lahir Bebek merupakan tanggal untuk memudahkan dalam penghitungan umur.</li>
                        <li>Nama karyawan merupakan karyawan yang bertanggung jawab penuh pada kandang tersebut.</li>
                    </ul>


                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Form Buat Kandang</h4>
                            </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="no_kandang">Nomor Kandang</label>
                                        <input type="text" id="no_kandang" name="no_kandang" class="form-control phone-number">
                                    </div>
                                    <div class="form-group">
                                        <label for="jumlah_bebek">Jumlah Bebek</label>
                                        <input type="text" id="jumlah_bebek" name="jumlah_bebek" class="form-control phone-number">
                                    </div>
                                    <div class="form-group">
                                        <label for="tanggal_lahir">Tanggal Lahir Bebek</label>
                                        <input type="text" id="tanggal_lahir" name="tanggal_lahir" class="form-control datepicker">
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="role">Karyawan Penanggung Jawab</label>
                                            <select class="form-control select2" name="id_karyawan" form="form-create-kandang">
                                                @foreach($data as $row)
                                                    <option value="{{$row->id}}">{{$row->nama}}</option>
                                                @endforeach
                                            </select>
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
                        <h5 class="modal-title text-primary" id="exampleModalCenterTitle">Konfirmasi Pembuatan Kandang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Yakin untuk menambahkan kandang ini?
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




