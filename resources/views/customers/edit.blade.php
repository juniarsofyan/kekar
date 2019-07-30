@extends('layouts.master')

@section('title')
<title>Manajemen Customer</title>
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Manajemen Customer </h1>
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li><a a href="{{ route('customer.index') }}">Customer</a></li>
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
                        <h3 class="box-title">Edit Customer</h3>
                    </div>
                    <!-- /.box-header -->

                    <!-- form start -->
                    <form role="form" action="{{ route('customer.update', $customers->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <div class="box-body">

                            {{-- IF SOMETHING WRONG HAPPENED --}}
                            @if (session('error'))
                                @alert(['type' => 'danger'])
                                    {!! session('error') !!}
                                @endalert
                            @endif

                            <div class="form-group">
                                <label for="customer_name">Nama</label>
                                <input type="text" name="customer_name"
                                    value="{{ $customers->name }}"
                                    class="form-control {{ $errors->has('customer_name') ? 'is-invalid':'' }}"
                                    id="customer_name" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Telepon</label>
                                <input type="tel" name="phone"
                                    value="{{ $customers->name }}"
                                    class="form-control {{ $errors->has('phone') ? 'is-invalid':'' }}"
                                    id="phone" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" name="email"
                                    value="{{ $customers->name }}"
                                    class="form-control {{ $errors->has('email') ? 'is-invalid':'' }}"
                                    id="email" required>
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea name="address" id="address"
                                    class="form-control {{ $errors->has('address') ? 'is-invalid':'' }}" cols="5"
                                    rows="5">{{ $customers->address }}
                                </textarea>
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
