@extends('layouts.master')

@section('title')
<title>Manajemen Petugas</title>
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Manajemen Petugas </h1>
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li class="active">Petugas</li>
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
                        <h3 class="box-title">Tambah Petugas</h3>
                    </div>
                    <!-- /.box-header -->

                    <!-- form start -->
                    <form role="form" action="{{ route('officer.store') }}" method="POST">
                        @csrf
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
                                <label for="name">Nama</label>
                                <input type="text" name="name"
                                    class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}"
                                    id="name" required>
                            </div>

                            <div class="form-group">
                                <label for="birthdate">Tanggal Lahir</label>
                                <input type="date" name="birthdate"
                                    class="form-control {{ $errors->has('birthdate') ? 'is-invalid':'' }}"
                                    id="birthdate" required>
                            </div>

                            <div class="form-group">
                                <label for="gender">Jenis Kelamin</label>
                                <input type="text" name="gender"
                                    class="form-control {{ $errors->has('gender') ? 'is-invalid':'' }}"
                                    id="gender" required>
                            </div>

                            <div class="form-group">
                                <label for="phone">Telepon</label>
                                <input type="phone" name="phone"
                                    class="form-control {{ $errors->has('phone') ? 'is-invalid':'' }}"
                                    id="phone" required>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email"
                                    class="form-control {{ $errors->has('email') ? 'is-invalid':'' }}"
                                    id="email" required>
                            </div>

                            <div class="form-group">
                                <label for="address">Alamat</label>
                                <textarea name="address" id="address"
                                    class="form-control {{ $errors->has('address') ? 'is-invalid':'' }}" cols="5"
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
