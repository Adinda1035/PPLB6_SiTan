@extends('layouts.master')

@section('title') Hasil Simulasi Pembuatan Telur @endsection

@section('simulasi-active') active @endsection

@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Hasil Simulasi Pembuatan Telur </h1>
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
                    <div class="col-lg-5">
                        <div class="card">
                            <div class="text-center text-primary mt-4">
                                <h6>Bahan Yang Dibutuhkan</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <center>
                                        <table class="table table-hover" style="width: 100%">
                                            <colgroup>
                                                <col span="1" style="width: 60%;">
                                                <col span="1" style="width: 40%;">
                                            </colgroup>
                                            <thead>
                                            <tr>
                                                <th scope="col">Nama Bahan</th>
                                                <th scope="col">Jumlah</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($ingredients as $key => $value)
                                                <tr>
                                                    <td>{{$key}}</td>
                                                    <td>{{$value}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </center>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="card">
                            <div class="text-center text-primary mt-4">
                                <h6>Langkah-langkah Pembuatan</h6>
                            </div>
                            <div class="card-body">
                                <ol>
                                    @foreach($steps as $row)
                                        <li>{{$row}}</li>
                                    @endforeach
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection




