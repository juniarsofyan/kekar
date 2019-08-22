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
            <li><a a href="{{ route('cardwork.index') }}">Kartu Kerja</a></li>
            <li class="active">Edit</li>
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
                        <h3 class="box-title">Edit Kartu Kerja</h3>
                    </div>
                    <!-- /.box-header -->

                    <!-- form start -->
                    <form role="form" action="{{ route('cardwork.update', $cardworks->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
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

                            <div class="form-group">
                                {!! Form::label('date', 'Tanggal') !!}

                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    {!! Form::text('date', $cardworks->date, array('required', 'id' => 'datepicker', 'class'=>(($errors->has("date")) ? "is-invalid":"").' form-control pull-right')) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('category', 'Kategori') !!}
                                {!! Form::select('category', $categories, $cardworks->category_id, ['required', 'class' => 'form-control','placeholder' => '-- PILIH KATEGORI --']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('po_number', 'Nomor PO') !!}
                                {!! Form::text('po_number', $cardworks->po_number, array('class'=>(($errors->has("po_number")) ? "is-invalid":"").' form-control ')) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('inventory', 'Barang') !!}
                                {!! Form::select('inventory', $inventories, $cardworks->inventory_id, ['required', 'class' => 'form-control','placeholder' => '-- PILIH BARANG --']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('process', 'Proses') !!}
                                {!! Form::select('process', $processes, $cardworks->process_id, ['required', 'class' => 'form-control','placeholder' => '-- PILIH PROSES --']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('customer', 'Customer') !!}
                                {!! Form::select('customer', $customers, $cardworks->customer_id, ['required', 'class' => 'form-control','placeholder' => '-- PILIH CUSTOMER --']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('project', 'Project') !!}
                                {!! Form::select('project', $projects, $cardworks->project_id, ['required', 'class' => 'form-control','placeholder' => '-- PILIH PROJECT --']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('officer', 'Petugas') !!}
                                {!! Form::select('officer', $officers, $cardworks->officer_id, ['required', 'class' => 'form-control','placeholder' => '-- PILIH PETUGAS --']) !!}
                            </div>

                            {{-- CARDWORK DETAIL --}}

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('component', 'Komponen') !!}
                                        {!! Form::select('component', $components, isset($cardworks->component_id) ? $cardworks->component_id : null, ['class' => 'form-control','placeholder' => '-- PILIH KOMPONEN --']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('problem', 'Masalah') !!}
                                        {!! Form::textarea('problem', isset($cardworks->problem) ? $cardworks->problem : null, array('required', 'rows' => 4, 'cols' => 54, 'style' => 'resize:none', 'class'=>(($errors->has("problem")) ? "is-invalid":"").' form-control ')) !!}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('solution', 'Solusi') !!}
                                        {!! Form::textarea('solution', isset($cardworks->solution) ? $cardworks->solution : null, array('required', 'rows' => 4, 'cols' => 54, 'style' => 'resize:none', 'class'=>(($errors->has("solution")) ? "is-invalid":"").' form-control ')) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('total_hours', 'Total Jam') !!}
                                        <div class="input-group">
                                            {!! Form::text('total_hours', isset($cardworks->total_hours) ? $cardworks->total_hours : null, array('required', 'class'=>(($errors->has("total_hours")) ? "is-invalid":"").' form-control ')) !!}
                                            <span class="input-group-addon">Jam</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('qty', 'Qty') !!}
                                        <div class="input-group">
                                            {!! Form::text('qty', isset($cardworks->qty) ? $cardworks->qty : null, array('required', 'class'=>(($errors->has("qty")) ? "is-invalid":"").' form-control ')) !!}
                                            <span class="input-group-addon">Pcs</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="reset" class="btn btn-default">Cancel</button> &nbsp;&nbsp;
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
                <!-- /.box -->

            </div>
            <!--/.col (left) -->
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
