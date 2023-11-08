@extends('layouts.orphanage')

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
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
  
              <div class="info-box-content">
                <span class="info-box-text">My Orders</span>
                <span class="info-box-number">{{ $orderCount }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- /.row -->
    </div><!--/. container-fluid -->
  </section>

@endsection