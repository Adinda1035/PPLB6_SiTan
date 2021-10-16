@extends('layouts.master')

@section('title') Dashboard @endsection

@section('dashboard-active') active @endsection

@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{route("dashboard")}}">Dashboard</a></div>
                </div>
            </div>

            <div class="section-body">
                <div id="app">
                    @include('flash-message')
                    @yield('messages')
                </div>
                <h2 class="section-title">Daftar Kandang</h2>
                @if(Auth::user()->hasRole('admin'))
                    <p class="section-lead">
                        Berikut adalah kandang yang anda miliki beserta <i>overview</i> isi dari kandang tersebut.
                    </p>
                @else
                    <p class="section-lead">
                        Berikut adalah kandang yang berada dalam pengawasan anda beserta <i>overview</i> isi dari kandang tersebut.
                    </p>
                @endif

                <div class="row">
                    @if (!$data->isEmpty())
                        @foreach($data as $row)
                            @if ($row->laporan == null)
                                <div class="col-12 col-md-4 col-lg-4">
                                    <div class="card card-warning">
                                        <div class="card-header">
                                            <h4>Laporan Harian Kandang #{{$row->no_kandang}}</h4>
                                        </div>
                                        <div class="card-body">
                                            Belum ada laporan harian yang dibuat oleh karyawan yang bertugas. <br>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="col-12 col-md-4 col-lg-4">
                                    @if ($row->laporan->jumlah_bebek_mati > 0)
                                        <div class="card card-danger">
                                    @elseif ($row->laporan->jumlah_bebek_sakit > 0 || $row->laporan->kondisi_kandang == "buruk")
                                        <div class="card card-warning">
                                    @else
                                        <div class="card card-primary">
                                    @endif
                                        <div class="card-header">
                                            <h4>Laporan Harian Kandang #{{$row->no_kandang}}</h4>
                                        </div>
                                        <div class="card-body">
                                            <table>
                                                <tr>
                                                    <td>Tanggal Laporan</td>
                                                    <td>&ensp;:</td>
                                                    <td><b>&emsp;{{$row->laporan->tanggal_laporan}}</b></td>
                                                </tr>
                                                <tr>
                                                    <td>Panen Harian Terbaru</td>
                                                    <td>&ensp;:</td>
                                                    <td><b>&emsp;{{$row->laporan->panen_harian}}</b></td>
                                                </tr>
                                                <tr>
                                                    <td>Kondisi Kandang</td>
                                                    <td>&ensp;:</td>
                                                    <td class="text-capitalize"><b>&emsp;{{$row->laporan->kondisi_kandang}}</b></td>
                                                </tr>
                                                <tr>
                                                    <td>Jumlah Bebek Sakit</td>
                                                    <td>&ensp;:</td>
                                                    <td><b>&emsp;{{$row->laporan->jumlah_bebek_sakit}}</b></td>
                                                </tr>
                                                <tr>
                                                    <td>Jumlah Bebek Mati</td>
                                                    <td>&ensp;:</td>
                                                    <td><b>&emsp;{{$row->laporan->jumlah_bebek_mati}}</b></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="card-footer">
                                            {{$row->nama}}
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @else
                        <div class="col-12 col-md-4 col-lg-4">
                            <div class="card card-warning">
                                <div class="card-header">
                                    <h4>BELUM ADA KANDANG</h4>
                                </div>
                                <div class="card-body">
                                    Belum ada kandang yang dapat dilihat. <br>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </div>
@endsection




