@extends('layouts.orphanage')

@section('section')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>My Orders</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"></li>
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
              <h3 class="card-title">My Orders</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Volunteer Names</th>
                            <th>Location</th>
                            <th>Goods</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $donation)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                  {{  $donation ->user ->name  }} 
                                </td>
                                <td>{{ $donation->location  }}</td>
                                <td>Order #{{ $donation->id  }}</td>
                                <td>
                                  @php
                                  $statusClass = '';
                                  $statusText = '';
                                  switch ($donation->status) {
                                      case 'pending':
                                          $statusClass = 'badge badge-secondary';
                                          $statusText = 'Processing';
                                          break;
                                      case 'confirmed':
                                          $statusClass = 'badge badge-primary';
                                          $statusText = 'Confirmed';
                                          break;
                                      case 'dispatched':
                                          $statusClass = 'badge badge-warning';
                                          $statusText = 'Dispatched';
                                          break;
                                      case 'delivered':
                                          $statusClass = 'badge badge-success';
                                          $statusText = 'Delivered';
                                          break;
                                  }
                                  @endphp
                                  <span class="{{ $statusClass }}">{{ $statusText }}</span>
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