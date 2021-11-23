@extends('layouts.master')

@section('title') Simulasi Pembuatan Telur @endsection

@section('simulasi-active') active @endsection
@section('create-simulasi-active') active @endsection

@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Simulasi Pembuatan Telur</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{route("dashboard")}}">Dashboard</a></div>
                    <div class="breadcrumb-item">Simulasi</div>
                </div>
            </div>

            <div class="section-body">
                <div id="app">
                    @include('flash-message')
                    @yield('messages')
                </div>
                <h2 class="section-title">Petunjuk Pengisian Form</h2>
                    <ul class="section-lead">
                        <li>Pilih salah satu metode pembuatan (bahan dan langkah-langkah yang dibutuhkan akan berbeda!).</li>
                        <li>Pilih salah satu tingkat keasinan yang diinginkan (jumlah bahan yang dibutuhkan akan berbeda!).</li>
                        <li>Jumlah telur merupakan jumlah telur yang akan digunakan (dalam butir).</li>
                    </ul>
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Form Simulasi Pembuatan Telur</h4>
                            </div>
                            <form method="post" action="{{route("store-simulasi")}}" id="form-create-simulasi">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="metode_pembuatan">Metode Pembuatan</label>
                                            <select class="form-control select2" id="metode_pembuatan" name="metode_pembuatan" form="form-create-simulasi">
                                                <option value="1">Metode Bawang Putih</option>
                                                <option value="2">Metode Basah</option>
                                                <option value="3">Metode Batu Bata</option>
                                                <option value="4">Metode Abu Gosok</option>
                                                <option value="5">Metode Kulit Manggis</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="tingkat_keasinan">Tingkat Keasinan</label>
                                            <select class="form-control select2" id="tingkat_keasinan" name="tingkat_keasinan" form="form-create-simulasi">
                                                <option value="1">Standar</option>
                                                <option value="2">Asin</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="jumlah_telur">Jumlah Telur</label>
                                        <input type="number" id="jumlah_telur" name="jumlah_telur" class="form-control phone-number">
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




