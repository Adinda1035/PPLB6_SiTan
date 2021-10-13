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
                    @foreach($data as $row)
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
                                    {{$row->laporan->panen_harian}}
                                </div>
                                <div class="card-footer">
                                    {{$row->nama}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection




