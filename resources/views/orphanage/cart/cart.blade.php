@extends('layouts.orphanage')

@section('section')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>My Claims</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><button class="btn btn-info"><a  style="color: #fff;"href="{{ url('orphanage/donations')}}">Continue shopping</a></button></li>
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
              <h3 class="card-title">My Claims</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cart as $donation)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <img src="{{ asset($donation->donation->image ) }}" alt="Donation Image" width="100">
                                </td>
                                <td>{{ $donation->donation->name  }}</td>
                                <td>{{ $donation->quantity }}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-md-4">
                                          <form method="POST" action="{{ route('orphanage.cart.remove', ['donation' => $donation->donation->id]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Remove</button>
                                        </form>                                       
                                        </div>
                                    </div>
                                    
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
              </table>

              <div class="text-center">
                <a href="{{ route('orphanage.checkout') }}" class="btn btn-primary">Checkout</a>
            </div>
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