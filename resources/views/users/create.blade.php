@extends('layouts.master')

@section('title')
<title>Manajemen User</title>
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Manajemen User </h1>
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li class="active">User</li>
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
                        <h3 class="box-title">Tambah User</h3>
                    </div>
                    <!-- /.box-header -->

                    <!-- form start -->
                    {!! Form::open(array('route' => 'user.store', 'method'=>'POST', 'role' => 'form')) !!}
                        <div class="box-body">

                            {{-- IF SOMETHING WRONG HAPPENED --}}
                            @if ($errors->any())
                                @alert(['type' => 'danger'])
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li> {!! $error !!} </li>
                                        @endforeach
                                    </ul>
                                @endalert
                            @endif

                            <div class="form-group">
                                {!! Form::label('name', 'Nama') !!}
                                {!! Form::text('name', null, array('required', 'autofocus', 'class'=>(($errors->has("name")) ? "is-invalid":"").' form-control ')) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('email', 'E-Mail') !!}
                                {!! Form::email('email', null, array('required', 'class'=>(($errors->has("email")) ? "is-invalid":"").' form-control ')) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('password', 'Password') !!}
                                {!! Form::password('password', array('required', 'class'=>(($errors->has("password")) ? "is-invalid":"").' form-control ')) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('confirm-password', 'Confirm Password') !!}
                                {!! Form::password('confirm-password', array('required', 'class'=>(($errors->has("confirm-password")) ? "is-invalid":"").' form-control ')) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('roles', 'Roles') !!}
                                {!! Form::select('roles[]', $roles, [], array('class' => (($errors->has("confirm-password")) ? "is-invalid":"").' form-control', 'multiple')) !!}
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="reset" class="btn btn-default">Cancel</button> &nbsp;&nbsp;
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    {!! Form::close() !!}
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
