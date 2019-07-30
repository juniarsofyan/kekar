@extends('layouts.master')

@section('title')
<title>Manajemen Kategori</title>
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Manajemen Kategori </h1>
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li class="active">Kategori</li>
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
                        <h3 class="box-title">Tambah Kategori</h3>
                    </div>
                    <!-- /.box-header -->

                    <!-- form start -->
                    <form role="form" action="{{ route('category.store') }}" method="POST">
                        @csrf
                        <div class="box-body">

                            {{-- IF SOMETHING WRONG HAPPENED --}}
                            @if (session('error'))
                                @alert(['type' => 'danger'])
                                    {!! session('error') !!}
                                @endalert
                            @endif

                            <div class="form-group">
                                <label for="category_name">Nama</label>
                                <input type="text" name="category_name"
                                    class="form-control {{ $errors->has('category_name') ? 'is-invalid':'' }}"
                                    id="category_name" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Deskripsi</label>
                                <textarea name="description" id="description"
                                    class="form-control {{ $errors->has('description') ? 'is-invalid':'' }}" cols="5"
                                    rows="5"></textarea>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="reset" class="btn btn-default">Cancel</button> &nbsp;&nbsp;
                            <button type="submit" class="btn btn-primary">Submit</button>
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
