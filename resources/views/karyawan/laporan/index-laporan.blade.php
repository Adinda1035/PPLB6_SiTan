@extends('layouts.master')

@section('title') Lihat Laporan Harian @endsection

@section('laporan-harian-active') active @endsection
@section('index-laporan-harian-active') active @endsection

@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1> Daftar Laporan Harian </h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{route("dashboard")}}">Dashboard</a></div>
                    <div class="breadcrumb-item active">Laporan Harian</div>
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
                                            <col span="1" style="width: 20%;">
                                            <col span="1" style="width: 15%;">
                                            <col span="1" style="width: 10%;">
                                            <col span="1" style="width: 10%;">
                                            <col span="1" style="width: 10%;">
                                            <col span="1" style="width: 20%;">
                                            <col span="1" style="width: 10%;">
                                        </colgroup>
                                        <thead>
                                        <tr>
                                            <th scope="col">No Kandang</th>
                                            <th scope="col">Tanggal Laporan</th>
                                            <th scope="col">Panen Harian</th>
                                            <th scope="col">Bebek Sakit</th>
                                            <th scope="col">Bebek Mati</th>
                                            <th scope="col">Kondisi Kandang</th>
                                            <th scope="col">Terakhir Diupdate</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($data as $row)
                                            <tr>
                                                <td>{{$row->no_kandang}}</td>
                                                <td>{{$row->tanggal_laporan}}</td>
                                                <td>{{$row->panen_harian}}</td>
                                                <td>{{$row->jumlah_bebek_sakit}}</td>
                                                <td>{{$row->jumlah_bebek_mati}}</td>
                                                <td class="text-capitalize">{{$row->kondisi_kandang}}</td>
                                                <td>{{$row->updated_at}}</td>
                                                <td>
                                                    <a style="cursor: pointer" class="btn btn-outline-primary btn-sm" title="Edit" href="{{route("edit-laporan-harian", $row->id)}}">
                                                        <i class="ion ion-edit" data-pack="default" data-tags="change, update, write, type, pencil"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection




