@extends('layouts.master')

@section('title') Index Simulasi Pembuatan Telur @endsection

@section('simulasi-active') active @endsection
@section('index-simulasi-active') active @endsection

@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Index Simulasi Pembuatan Telur</h1>
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
                                            <col span="1" style="width: 20%;">
                                            <col span="1" style="width: 10%;">
                                        </colgroup>
                                        <thead>
                                        <tr>
                                            <th scope="col">Metode Pembuatan</th>
                                            <th scope="col">Tingkat Keasinan</th>
                                            <th scope="col">Jumlah Telur (butir)</th>
                                            <th scope="col">Tanggal Simulasi</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($data as $row)
                                            <tr>
                                                @if($row->metode_pembuatan == 1)
                                                    <td>Metode Bawang Putih</td>
                                                @elseif($row->metode_pembuatan == 2)
                                                    <td>Metode Basah</td>
                                                @elseif($row->metode_pembuatan == 3)
                                                    <td>Metode Batu Bata</td>
                                                @elseif($row->metode_pembuatan == 4)
                                                    <td>Metode Abu Gosok</td>
                                                @elseif($row->metode_pembuatan == 5)
                                                    <td>Metode Kulit Manggis</td>
                                                @endif

                                                @if($row->tingkat_keasinan == 1)
                                                    <td>Standar</td>
                                                @elseif($row->tingkat_keasinan == 2)
                                                    <td>Asin</td>
                                                @endif

                                                <td>{{$row->jumlah_telur}} butir</td>
                                                <td>{{$row->created_at}}</td>
                                                <td>
                                                    <a style="cursor: pointer" class="btn btn-outline-primary btn-sm" title="Detail" href="{{route("show-simulasi", $row->id)}}">
                                                        <i class="ion ion-information-circled" data-pack="default" data-tags="change, update, write, type, pencil"></i>
                                                    </a>
                                                    <a style="cursor: pointer" class="btn btn-outline-danger btn-sm" title="Delete" data-toggle="modal" data-target="#modal-delete-{{$row->id}}">
                                                        <i style="padding: 0px 2px" class="ion ion-trash-b" data-pack="default" data-tags="delete, remove, dump"></i>
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
    @foreach($data as $row)
        <!-- Modal -->
        <div class="modal fade" id="modal-delete-{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-danger" id="exampleModalCenterTitle">Konfirmasi Penghapusan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Yakin untuk menghapus simulasi ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <form action="{{route("destroy-simulasi", $row->id)}}" method="post">
                            @csrf
                            <input type="string" value="{{$row->id}}" hidden>
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection




