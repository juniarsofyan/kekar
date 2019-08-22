@extends('layouts.master')

@section('title')
    <title>Laporan</title>
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
        <h1> Rekapitulasi Kategori Perbaikan  </h1>
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li><a href="#">Laporan</a></li>
            <li class="active">Kategori Perbaikan </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="filter">
            <form role="form" action="{{ route('report.bycategory') }}" method="GET">
                @csrf
                <div class="row">
                    <div class="col-md-4 col-xs-12" style="padding-right:0;">
                        <div class="form-group">
                            {!! Form::label('category', 'Pilih kategori laporan') !!}
                            {!! Form::select('category', $categories, $filters['category'] ? $filters['category'] : null, ['class' => 'form-control','placeholder' => '-- SEMUA KATEGORI --']) !!}
                        </div>
                    </div>

                    <div class="col-md-3 col-xs-12" style="padding-right:0;">
                        <div class="form-group">
                            {!! Form::label('date_start', 'Tanggal awal') !!}
                            {!! Form::date('date_start', $filters['date_start'] ? $filters['date_start'] : null, ['class' => 'form-control','placeholder' => '-- DARI --']) !!}
                        </div>
                    </div>
                    <div class="col-md-3 col-xs-12" style="padding-right:0;">
                        <div class="form-group">
                            {!! Form::label('date_end', 'Tanggal akhir') !!}
                            {!! Form::date('date_end', $filters['date_end'] ? $filters['date_end'] : null, ['class' => 'form-control','placeholder' => '-- SAMPAI --']) !!}
                        </div>
                    </div>
                    <div class="col-md-2 col-xs-12">
                        <div class="form-group">
                            {!! Form::label(' ', '&nbsp;') !!}
                            <button type="submit" class="btn btn-primary col-md-12 col-xs-12">Cari</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>




        <div class="row">
            <!-- right column -->
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header text-center">
                    <h3 class="box-title">Periode {{ date('d F Y', strtotime($filters['date_start'])) }} <small>s/d</small> {{ date('d F Y', strtotime($filters['date_end'])) }}</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        @if (session('success'))
                            @alert(['type' => 'success'])
                                {!! session('success') !!}
                            @endalert
                        @endif

                        <div class="row">
                            <!-- /.col -->
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="info-box bg-aqua">
                                    <span class="info-box-icon"><i class="fa fa-files-o"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Total Proses</span>
                                        <span class="info-box-number" style="font-size:2.5em;">{{ $total_processes }}</span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="info-box bg-green">
                                    <span class="info-box-icon"><i class="fa fa-clock-o"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Total Jam</span>
                                        <span class="info-box-number" style="font-size:2.5em;">{{ $total_hours }}</span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="info-box bg-yellow">
                                    <span class="info-box-icon"><i class="fa fa-refresh"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Total Frekuensi</span>
                                        <span class="info-box-number" style="font-size:2.5em;">{{ $total_frequencies }}</span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <!-- /.col -->
                        </div>

                        <table id="datatable-full" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Customer</th>
                                    <th>Nama Barang</th>
                                    <th class="text-center">Project</th>
                                    <th class="text-center">Proses</th>
                                    <th class="text-center">Jam</th>
                                    <th class="text-center">Frekuensi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @forelse ($results as $row)
                                    <tr>
                                        <td class="text-center">{{ $no++ }}</td>
                                        <td>{{ $row->customer }} </td>
                                        <td>{{ $row->inventory }} </td>
                                        <td class="text-center">{{ $row->project }} </td>
                                        <td class="text-center">{{ $row->process }} </td>
                                        <td class="text-center">{{ $row->total_hours }} </td>
                                        <td class="text-center">{{ $row->frequency }} </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Tidak ada data</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!--/.col (right) -->
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
