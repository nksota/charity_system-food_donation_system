@extends('layouts.admin')

@section('section')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>All Administrators</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><button class="btn btn-info"><a  style="color: #fff;"href="{{ url('admin/admin/add')}}">Add Admin</a></button></li>
            </ol>
        </div><!-- /.col -->
      </div>
    </div><!-- /.container-fluid -->
</section>
@if(session('message'))
<div class="alert alert-success alert-dismissible fade show">{{ session('message') }}</div>
@endif
@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show">{{ session('error') }}</div>
@endif
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
         
          <!-- /.card -->

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">All Administrators</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Names</th>
                    <th>Registration complete?</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
                </thead>
                @foreach ($admins as $admin)
                <tbody>
                <tr>
                    <td>{{  $loop->iteration }}</td>
                    <td>{{ $admin->name }}</td>
                    <td>
                      <span class="badge badge-{{ $admin->status === 'yes' ? 'success' : 'warning' }} badge-md">
                          {{ $admin->status }}
                      </span>
                    </td>
                    <td>{{ $admin->email ?? 'N/A' }}</td>
                  <td>
                    <div class="row">
                      <div class="col-md-4">
                         <a href="{{ url('admin/admin/'.$admin->id.'/edit') }}" class="btn btn-md btn-info"><i class="fa-solid fa-pen-to-square"></i></a>
                      </div>
                      <div class="col-md-4">
                        <a href="{{ url('admin/admin/'.$admin->id.'/delete') }}" onclick="return confirm('Are you sure you want to DELETE Admin?')" class="btn btn-md btn-danger"><i class="fa-solid fa-trash-can"></i></a>
                      </div>


                      </div>
                  </td>

                </tr>
                @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>

@endsection