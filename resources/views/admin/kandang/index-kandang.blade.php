@extends('layouts.master')

@section('title') Lihat Kandang @endsection

@section('kandang-active') active @endsection
@section('index-kandang-active') active @endsection

@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1> Daftar Kandang</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{route("dashboard")}}">Dashboard</a></div>
                    <div class="breadcrumb-item active">Kandang</div>
                </div>
            </div>

            <div class="section-body">
{{--                <h2 class="section-title">Petunjuk Pengisian Form</h2>--}}
{{--                    <ul class="section-lead">--}}
{{--                        <li>Username wajib diisi minimal 6 karakter.</li>--}}
{{--                        <li>Password wajib diisi minimal 8 karakter.</li>--}}
{{--                    </ul>--}}

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover" style="width: 100%">
                                        <colgroup>
                                            <col span="1" style="width: 5%;">
                                            <col span="1" style="width: 15%;">
                                            <col span="1" style="width: 20%;">
                                            <col span="1" style="width: 20%;">
                                            <col span="1" style="width: 20%;">
                                            <col span="1" style="width: 20%;">
                                        </colgroup>
                                        <thead>
                                        <tr>
                                            <th scope="col">No Kandang</th>
                                            <th scope="col">Jml Bebek</th>
                                            <th scope="col">Umur Bebek</th>
                                            <th scope="col">Petugas</th>
                                            <th scope="col">Terakhir Diupdate</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($data as $row)
                                            <tr>
                                                <td>{{$row->no_kandang}}</td>
                                                <td>{{$row->jumlah_bebek}}</td>
                                                <td>{{$row->diffMonth}} Bulan {{$row->diffDay}} Hari</td>
                                                <td>{{$row->nama}}</td>
                                                <td>{{$row->updated_at}}</td>
                                                <td>
                                                    <a style="cursor: pointer" class="btn btn-outline-primary btn-sm" title="Edit" href="{{route("admin-edit-kandang", $row->id)}}">
                                                        <i class="ion ion-edit" data-pack="default" data-tags="change, update, write, type, pencil"></i>
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
            @if ($data->hasPages())
                <nav>
                    <ul class="pagination">
                        {{-- Previous Page Link --}}
                        @if ($data->onFirstPage())
                            <li class="page-item disabled" aria-disabled="true">
                                <span class="page-link">@lang('pagination.previous')</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $data->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a>
                            </li>
                        @endif

                        {{-- Next Page Link --}}
                        @if ($data->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $data->nextPageUrl() }}" rel="next">@lang('pagination.next')</a>
                            </li>
                        @else
                            <li class="page-item disabled" aria-disabled="true">
                                <span class="page-link">@lang('pagination.next')</span>
                            </li>
                        @endif
                    </ul>
                </nav>
            @endif
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
                    Yakin untuk menghapus kandang nomor {{$row->no_kandang}}?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <form action="{{route("admin-destroy-kandang", $row->id)}}" method="post">
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




