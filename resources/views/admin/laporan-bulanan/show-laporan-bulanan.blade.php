@extends('layouts.master')

@section('title') Lihat Detail Laporan Bulanan @endsection

@section('laporan-bulanan-active') active @endsection

@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1> Detail Laporan Bulan {{$tanggal_laporan}}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{route("dashboard")}}">Dashboard</a></div>
                    <div class="breadcrumb-item active">Lihat Detail Laporan Bulanan</div>
                </div>
            </div>

            <div class="section-body">
                <div id="app">
                    @include('flash-message')
                    @yield('messages')
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover" style="width: 100%">
                                        <colgroup>
                                            <col span="1" style="width: 5%;">
                                            <col span="1" style="width: 15%;">
                                            <col span="1" style="width: 15%;">
                                            <col span="1" style="width: 10%;">
                                            <col span="1" style="width: 10%;">
                                            <col span="1" style="width: 15%;">
                                            <col span="1" style="width: 30%;">
                                        </colgroup>
                                        <thead>
                                        <tr>
                                            <th scope="col">No Kandang</th>
                                            <th scope="col">Jumlah Panen Harian Kandang</th>
                                            <th scope="col">Rerata Panen Harian Kandang</th>
                                            <th scope="col">Jumlah Bebek Sakit</th>
                                            <th scope="col">Jumlah Bebek Mati</th>
                                            <th scope="col">Rata-rata Kondisi Kandang</th>
                                            <th scope="col">Nama Karyawan</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($data as $row)
                                            <tr>
                                                <td>{{$row->no_kandang}}</td>
                                                <td>{{$row->sum_panen_harian_kandang}}</td>
                                                <td>{{round($row->sum_panen_harian_kandang/30, 2)}}</td>
                                                <td>{{$row->sum_jumlah_bebek_sakit}}</td>
                                                <td>{{$row->sum_jumlah_bebek_mati}}</td>
                                                <td class="text-capitalize">{{$row->avg_kondisi_kandang}}</td>
                                                <td>{{$row->nama}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-2">{!! $data->links() !!}</div>
            </div>
        </section>
    </div>
@endsection




