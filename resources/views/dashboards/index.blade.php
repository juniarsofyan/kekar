@extends('layouts.master')

@section('title')
<title>Manajemen Kategori</title>
@endsection

@section('styles')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('bower_components/morris.js/morris.css') }}">
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

        <div class="row">
            <div class="col-lg-12 col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Jumlah Kartu Kerja Per-Bulan</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        @if (session('success'))
                            @alert(['type' => 'success'])
                                {!! session('success') !!}
                            @endalert
                        @endif

                        <div class="chart tab-pane active" id="cardwork-chart" style="position: relative; height: 300px;"> </div>

                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
</div>
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection



@section('scripts')
<!-- Morris.js charts -->
<script src="{{ asset('bower_components/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('bower_components/morris.js/morris.min.js') }}"></script>
<script>
    $(function () {

    var area = new Morris.Area({
        element: 'cardwork-chart',
        resize: true,
        parseTime:false,
        data: {!! json_encode($total_card_works) !!},
        xkey: 'month',
        ykeys: ['total'],
        labels: ['Kartu Kerja'],
        lineColors: ['#a0d0e0'],
        hideHover: 'auto'
    });

})

</script>
@endsection
