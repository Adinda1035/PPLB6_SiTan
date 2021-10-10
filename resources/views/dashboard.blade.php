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

            </div>
        </section>
    </div>
@endsection




