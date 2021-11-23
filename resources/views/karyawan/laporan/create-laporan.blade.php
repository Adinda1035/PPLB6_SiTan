@extends('layouts.master')

@section('title') Buat Laporan Harian @endsection

@section('laporan-harian-active') active @endsection
@section('create-laporan-harian-active') active @endsection

@section('content')
    <!-- Main Content -->
<form method="post" action="{{route("store-laporan-harian")}}" id="form-create-laporan-harian">
    @csrf
    <script>
        let available = @json($available);
    </script>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Buat Laporan Harian</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{route("dashboard")}}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{route("index-laporan-harian")}}">Laporan Harian</a></div>
                    <div class="breadcrumb-item active">Buat Laporan Harian</div>
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
{{--                    $table->integer('no_kandang');--}}
{{--                    $table->double('panen_harian', 8, 2);--}}
{{--                    $table->integer('jumlah_bebek_sakit');--}}
{{--                    $table->integer('jumlah_bebek_mati');--}}
{{--                    $table->string('kondisi_kandang');--}}
{{--                    $table->bigInteger('id_karyawan');--}}

                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Form Buat Laporan Harian</h4>
                            </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="no_kandang">Nomor Kandang</label>
                                            <select class="form-control select2" id="dropdown-no-kandang" name="no_kandang" form="form-create-laporan-harian">
                                                <option value="" aria-hidden>--Pilih satu kandang dibawah ini--</option>
                                                @foreach($data as $row)
                                                    <option value="{{$row->no_kandang}}">{{$row->no_kandang}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="tanggal_laporan">Tanggal Laporan Harian</label>
                                        <input type="text" id="tanggal_laporan" name="tanggal_laporan" class="form-control datepicker">
                                    </div>
                                    <div class="form-group">
                                        <label for="jumlah_bebek_sakit">Jumlah Bebek Sakit</label>
                                        <input type="number" id="jumlah_bebek_sakit" name="jumlah_bebek_sakit" class="form-control phone-number">
                                    </div>
                                    <div class="form-group">
                                        <label for="jumlah_bebek_mati">Jumlah Bebek Mati</label>
                                        <input type="number" id="jumlah_bebek_mati" name="jumlah_bebek_mati" class="form-control phone-number">
                                    </div>
                                    <div class="form-group">
                                        <label for="panen_harian">Jumlah Panen Harian</label>
                                        <input type="number" id="panen_harian" name="panen_harian" step="any" class="form-control" value="0">
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="kondisi_kandang">Kondisi Kandang</label>
                                            <select id="kondisi_kandang" class="form-control select2" name="kondisi_kandang" form="form-create-laporan-harian">
                                                <option value="baik">Baik</option>
                                                <option value="buruk">Buruk</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_karyawan">Karyawan Penanggung Jawab</label>
                                        <input type="text" id="nama_karyawan" name="nama_karyawan" class="form-control" value="{{Auth::user()->nama}}" disabled>
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
                    <h5 class="modal-title text-primary" id="exampleModalCenterTitle">Konfirmasi Pembuatan Laporan Harian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Yakin untuk menambahkan laporan harian ini?
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




