@extends('layouts.master')

@section('title') Lihat Laporan Bulanan @endsection

@section('laporan-bulanan-active') active @endsection
@section('index-laporan-bulanan-active') active @endsection

@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1> Daftar Laporan Bulanan </h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{route("dashboard")}}">Dashboard</a></div>
                    <div class="breadcrumb-item active">Laporan Bulanan</div>
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
                                            <col span="1" style="width: 25%;">
                                            <col span="1" style="width: 15%;">
                                            <col span="1" style="width: 15%;">
                                            <col span="1" style="width: 15%;">
                                            <col span="1" style="width: 30%;">
                                        </colgroup>
                                        <thead>
                                        <tr>
                                            <th scope="col">Laporan Bulan</th>
                                            <th scope="col">Jumlah Kandang</th>
                                            <th scope="col">Jumlah Bebek</th>
                                            <th scope="col">Total Panen</th>
                                            <th scope="col">Tanggal Dibuat</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($data as $row)
                                            <tr>
                                                <td>{{$row->laporan_untuk}}</td>
                                                <td>{{$row->jumlah_kandang}}</td>
                                                <td>{{$row->jumlah_bebek}}</td>
                                                <td>{{$row->sum_panen_harian}}</td>
                                                <td>{{$row->created_at}}</td>
                                                <td>
                                                    <a style="cursor: pointer" class="btn btn-outline-primary btn-sm" title="Edit" href="{{route("admin-show-laporan-bulanan", $row->id)}}">
                                                        <i class="ion ion-information-circled" data-pack="default" data-tags="change, update, write, type, pencil"></i>
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
                <div class="d-flex justify-content-center mt-2">{!! $data->links() !!}</div>
            </div>
        </section>
    </div>
@endsection




