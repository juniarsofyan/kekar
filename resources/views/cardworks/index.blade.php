@extends('layouts.master')

@section('title')
    <title>Manajemen Kartu Kerja</title>
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
        <h1> Manajemen Kartu Kerja </h1>
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li class="active">Kartu Kerja</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="filter">
            <form role="form" action="{{ route('cardwork.index') }}" method="GET">
                @csrf
                <div class="row">
                    <div class="col-md-3 col-xs-12" style="padding-right:0;">
                        <div class="form-group">
                            {!! Form::label('category', 'Pilih kategori laporan') !!}
                            {!! Form::select('category', $categories, $filters['category'] ? $filters['category'] : null, ['class' => 'form-control','placeholder' => '-- SEMUA KATEGORI --']) !!}
                        </div>
                    </div>

                    <div class="col-md-3 col-xs-12" style="padding-right:0;">
                        <div class="form-group">
                            {!! Form::label('customer', 'Pilih customer') !!}
                            {!! Form::select('customer', $customers, $filters['customer'] ? $filters['customer'] : null, ['class' => 'form-control','placeholder' => '-- SEMUA CUSTOMER --']) !!}
                        </div>
                    </div>

                    <div class="col-md-2 col-xs-12" style="padding-right:0;">
                        <div class="form-group">
                            {!! Form::label('date_start', 'Tanggal awal') !!}
                            {!! Form::date('date_start', $filters['date_start'] ? $filters['date_start'] : null, ['class' => 'form-control','placeholder' => '-- DARI --']) !!}
                        </div>
                    </div>
                    <div class="col-md-2 col-xs-12" style="padding-right:0;">
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
                    <div class="box-header">
                        <h3 class="box-title">List Kartu Kerja</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        @if (session('success'))
                            @alert(['type' => 'success'])
                                {!! session('success') !!}
                            @endalert
                        @endif

                        <div class="table-responsive">
                            <table id="datatable-full" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tanggal</th>
                                        <th>Kategori</th>
                                        <th>Nomor PO</th>
                                        <th>Barang</th>
                                        <th>Proses</th>
                                        <th>Customer</th>
                                        <th>Project</th>
                                        <th>Petugas</th>
                                        <th>Komponen</th>
                                        <th>Masalah</th>
                                        <th>Pengerjaan</th>
                                        <th>Jam</th>
                                        <th>Qty</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @php $no = 1;

                                        // echo "<pre>";
                                        // print_r ($cardworks);
                                        // echo "</pre>";
                                        // exit();
                                    @endphp
                                    @forelse ($cardworks as $row)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ date('d M Y', strtotime($row->date)) }} </td>
                                            <td>{{ $row->category }} </td>
                                            <td>{{ $row->po_number }} </td>
                                            <td>{{ $row->inventory }} </td>
                                            <td>{{ $row->proccess }} </td>
                                            <td>{{ str_limit($row->customer, 10) }} </td>
                                            <td>{{ $row->project }} </td>
                                            <td>{{ $row->officer }} </td>
                                            <td>{{ $row->component }} </td>
                                            <td>{{ $row->problem }} </td>
                                            <td>{{ $row->solution }} </td>
                                            <td>{{ $row->total_hours }} </td>
                                            <td>{{ $row->qty }} </td>
                                            <td>
                                                <a href="{{ route('cardwork.edit', $row->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                                <form action="{{ route('cardwork.destroy', $row->id) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="15" class="text-center">Tidak ada data</td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
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
