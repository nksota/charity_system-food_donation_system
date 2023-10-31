@extends('layouts.donor')

@section('section')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Orphanage Profiles</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              
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
              <h3 class="card-title">Orphanage Profiles</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Logo</th>
                    <th>Names</th>
                    <th>Email</th>
                    <th>Phone</th>
                </tr>
                </thead>
                @foreach ($orphanages as $admin)
                <tbody>
                <tr>
                    <td>{{  $loop->iteration }}</td>
                    <td>
                        <img src="{{ asset('storage/profiles/' . $admin->orphanages->first()->profile) }}"  width="auto" height="100" alt="Orphanage Image">
                    </td>
                    <td>{{ $admin->name }}</td>
                    <td>{{ $admin->email ?? 'N/A' }}</td>
                    <td>{{ $admin->orphanages->first()->phone }}</td>

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