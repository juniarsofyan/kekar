@extends('layouts.master')

@section('title')
<title>Laporan</title>
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Laporan </h1>
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li class="active">Laporan</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- right column -->
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Laporan</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        @if (session('success'))
                            @alert(['type' => 'success'])
                                {!! session('success') !!}
                            @endalert
                        @endif

                        <table id="example1" class="table table-bordered table-striped">
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
