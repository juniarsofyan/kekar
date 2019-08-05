@extends('layouts.master')

@section('title')
<title>Manajemen Tipe User</title>
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Manajemen Tipe User </h1>
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li class="active">Tipe User</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- right column -->
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">List Tipe User</h3>
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
                                    <th>Nama</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php $no = 1; @endphp
                                @forelse ($roles as $row)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $row->name }} </td>
                                        <td>
                                            <a href="{{ route('role.edit', $row->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>

                                            {!! Form::open(['method' => 'DELETE', 'route' => ['role.destroy', $row->id],'style'=>'display:inline']) !!}
                                                {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm']) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Tidak ada data</td>
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
