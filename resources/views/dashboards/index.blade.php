@extends('layouts.master')

@section('title')
<title>Manajemen Kategori</title>
@endsection

@section('styles')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/plugins/buttons.dataTables.min.css') }}">
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Dashboard </h1>
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        @php
            $colors = array(
                "bg-aqua",
                "bg-green",
                "bg-yellow",
                "bg-red"
            );
        @endphp

        <!-- Small boxes (Stat box) -->
        <div class="row">

            @forelse ($total_hours as $key => $row)
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box {{ $colors[$key] }}">
                        <div class="inner">
                            <h3>{{ $row->total_hours}} Jam</h3>
                            <p>{{ $row->category}}</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-clock"></i>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-lg-12 col-xs-12">
                    <div class="small-box bg-red">
                        <div class="inner text-center">
                            <p>Tidak ada data</p>
                        </div>
                    </div>
                </div>
            @endforelse

        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection

@section('scripts')
<!-- DataTables -->
<script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('js/plugins/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('js/plugins/buttons.flash.min.js') }}"></script>
<script src="{{ asset('js/plugins/jszip.min.js') }}"></script>
<script src="{{ asset('js/plugins/pdfmake.min.js') }}"></script>
<script src="{{ asset('js/plugins/vfs_fonts.js') }}"></script>
<script src="{{ asset('js/plugins/buttons.html5.min.js') }}"></script>
<script src="{{ asset('js/plugins/buttons.print.min.js') }}"></script>
<script src="{{ asset('js/datatable.js') }}"></script>
@endsection
