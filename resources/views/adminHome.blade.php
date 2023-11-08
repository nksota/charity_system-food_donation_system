@extends('layouts.admin')

@section('section')
   <!-- Content Header (Page header) -->
   <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  @if (session('message'))
  <div class="alert alert-success" role="alert">
   {{ session('message') }}
 </div>
 @endif
 <section class="content">
    <div class="container-fluid">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fa-solid fa-circle-dollar-to-slot"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">All Donations</span>
              <span class="info-box-number">
                {{ $donationCount }}
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <!-- fix for small devices only -->
        <div class="clearfix hidden-md-up"></div>

        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">All Orders</span>
              <span class="info-box-number">{{ $orderCount }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">All Users</span>
              <span class="info-box-number">{{ $userCount }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- /.row -->

      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <div class="col-md-8">
         
          <!-- TABLE: LATEST ORDERS -->
          <div class="card">
            <div class="card-header border-transparent">
              <h3 class="card-title">Latest Orders</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table m-0">
                  <thead>
                  <tr>
                    <th>Order ID</th>
                    <th>Location</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  @foreach ($latestOrders as $item)
                  <tbody>
                  <tr>
                    <td>#{{ $item->id}}</td>
                    <td>{{ $item->location}}</td>
                    <td>
                        @php
                      $statusClass = '';
                      $statusText = '';
                      switch ($item->status) {
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
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
          
            <!-- /.card-footer -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->

        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div><!--/. container-fluid -->
  </section>
@endsection