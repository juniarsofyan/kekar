@extends('layouts.master')

@section('title')
    <title>Manajemen Kartu Kerja</title>
@endsection

@section('styles')
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
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
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        @php
                            $title_prefix = isset($cardwork_detail) ? "Edit" : "Tambah";
                        @endphp

                        <h3 class="box-title">{{ $title_prefix }} Detail Kartu Kerja</h3>
                    </div>
                    <!-- /.box-header -->

                    @php if (!isset($cardwork_detail)): @endphp
                    <!-- form start, if mode is create -->
                    <form role="form" action="{{ route('cardworkdetail.store', $cardworks['id']) }}" method="POST">
                        @csrf
                    @php else: @endphp
                    <!-- form start, if mode is update -->
                    <form role="form" action="{{ route('cardworkdetail.update', $cardwork_detail->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                    @php endif @endphp

                        <div class="box-body">

                            {{-- IF SOMETHING WRONG HAPPENED --}}
                            @if ($errors->any())
                                @alert(['type' => 'danger'])
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li> {{ $error }} </li>
                                        @endforeach
                                    </ul>
                                @endalert
                            @endif

                            {!! Form::hidden('cardwork_id', $cardworks['id']) !!}

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('component', 'Komponen') !!}
                                        {!! Form::select('component', $components, isset($cardwork_detail->component_id) ? $cardwork_detail->component_id : null, ['class' => 'form-control','placeholder' => '-- PILIH KOMPONEN --']) !!}
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('material', 'Jenis Material') !!}
                                        {!! Form::select('material', $materials, isset($cardwork_detail->material_id) ? $cardwork_detail->material_id : null, ['class' => 'form-control','placeholder' => '-- PILIH JENIS MATERIAL --']) !!}
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('dimension', 'Dimensi') !!}
                                        {!! Form::text('dimension', isset($cardwork_detail->dimension) ? $cardwork_detail->dimension : null, array('class'=>(($errors->has("dimension")) ? "is-invalid":"").' form-control ')) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('problem', 'Masalah') !!}
                                        {!! Form::textarea('problem', isset($cardwork_detail->problem) ? $cardwork_detail->problem : null, array('required', 'rows' => 4, 'cols' => 54, 'style' => 'resize:none', 'class'=>(($errors->has("problem")) ? "is-invalid":"").' form-control ')) !!}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('solution', 'Solusi') !!}
                                        {!! Form::textarea('solution', isset($cardwork_detail->solution) ? $cardwork_detail->solution : null, array('required', 'rows' => 4, 'cols' => 54, 'style' => 'resize:none', 'class'=>(($errors->has("solution")) ? "is-invalid":"").' form-control ')) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('total_hours', 'Total Jam') !!}
                                        <div class="input-group">
                                            {!! Form::text('total_hours', isset($cardwork_detail->total_hours) ? $cardwork_detail->total_hours : null, array('required', 'class'=>(($errors->has("total_hours")) ? "is-invalid":"").' form-control ')) !!}
                                            <span class="input-group-addon">Jam</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('qty', 'Qty') !!}
                                        <div class="input-group">
                                            {!! Form::text('qty', isset($cardwork_detail->qty) ? $cardwork_detail->qty : null, array('required', 'class'=>(($errors->has("qty")) ? "is-invalid":"").' form-control ')) !!}
                                            <span class="input-group-addon">Pcs</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('weight', 'Berat') !!}
                                        <div class="input-group">
                                            {!! Form::text('weight', isset($cardwork_detail->weight) ? $cardwork_detail->weight : null, array('class'=>(($errors->has("weight")) ? "is-invalid":"").' form-control ')) !!}
                                            <span class="input-group-addon">KG</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            @php if (!isset($cardwork_detail)): @endphp
                                <button type="reset" class="btn btn-default">Cancel</button> &nbsp;&nbsp;
                            @php else: @endphp
                                <a href="{{ route('cardworkdetail.index', $cardworks['id']) }}" class="btn btn-default">Cancel</a>
                            @php endif @endphp
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- /.box -->

            </div>
            <!--/.col (left) -->
        </div>
        <!-- /.row -->

        <div class="row">
            <!-- right column -->
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Detail Kartu Kerja</h3>
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
                                    <th>#</th>
                                    <th>Komponen</th>
                                    <th>Material</th>
                                    <th>Dimensi</th>
                                    <th>Masalah</th>
                                    <th>Solusi</th>
                                    <th>Total Jam</th>
                                    <th>Qty</th>
                                    <th>Berat</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php $no = 1; @endphp
                                @forelse ($cardwork_details as $row)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $row->component }} </td>
                                        <td>{{ $row->material }} </td>
                                        <td>{{ $row->dimension }} </td>
                                        <td>{{ $row->problem }} </td>
                                        <td>{{ $row->solution }} </td>
                                        <td>{{ $row->total_hours }} </td>
                                        <td>{{ $row->qty }} </td>
                                        <td>{{ $row->weight }} </td>
                                        <td>
                                            <form action="{{ route('cardworkdetail.destroy', $row->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE">
                                                <a href="{{ route('cardworkdetail.edit', array("cardwork_id" => $cardworks['id'], "id" => $row->id)) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                                <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center">Tidak ada data</td>
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
    <!-- bootstrap datepicker -->
    <script src="{{ asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('js/datepicker.js') }}"></script>
@endsection
