@extends('layouts.volunteer')

@section('section')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>All Orders</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                        <div class="btn-group">
                          <a href="{{ route('volunteer.delivery.pending') }}" class="btn btn-sm btn-warning mx-2">Pending</a>
                          <a href="{{ route('volunteer.delivery.confirmed') }}" class="btn btn-sm btn-primary mx-2">Confirmed</a>
                          <a href="{{ route('volunteer.delivery.dispatched') }}" class="btn btn-sm btn-secondary mx-2">Dispatched</a>
                          <a href="{{ route('volunteer.delivery.delivered') }}" class="btn btn-sm btn-success mx-2">Delivered</a>
                        </div>
            </li>
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
              <h3 class="card-title">All Orders</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Order ID</th>
                    <th>Status</th>
                    <th>Location</th>
                    <th>Actions</th>
                </tr>
                </thead>
                @foreach ($confirmedDeliveries as $pp)
                <tbody>
                <tr>
                    <td>{{  $loop->iteration }}</td>
                    <td>Order #{{ $pp->id }}</td>
                    <td>
                      @php
                      $statusClass = '';
                      $statusText = '';
                      switch ($pp->status) {
                          case 'pending':
                              $statusClass = 'badge badge-warning';
                              $statusText = 'Pending Confirmation';
                              break;
                          case 'confirmed':
                              $statusClass = 'badge badge-primary';
                              $statusText = 'Confirmed';
                              break;
                          case 'dispatched':
                              $statusClass = 'badge badge-secondary';
                              $statusText = 'Dispatched';
                              break;
                          case 'delivered':
                              $statusClass = 'badge badge-success';
                              $statusText = 'Order Delivered';
                              break;
                      }
                      @endphp
                      <span class="{{ $statusClass }}">{{ $statusText }}</span>
                    </td>
                    <td>{{ $pp->location }}</td>
                    <td><a href="{{ route('volunteer.delivery.edit', $pp) }}" class="btn btn-primary">Update Order</a></td>
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