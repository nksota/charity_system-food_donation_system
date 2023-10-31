@extends('layouts.donor')

@section('section')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>My Donations</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><button class="btn btn-info"><a  style="color: #fff;"href="{{ url('donor/donations/create')}}">Add Donation</a></button></li>
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
              <h3 class="card-title">My Donations</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($donations as $donation)
                            <tr>
                                <td>
                                    <img src="{{ asset($donation->image) }}" alt="Donation Image" width="100">
                                </td>
                                <td>{{ $donation->name }}</td>
                                <td>{{ $donation->description }}</td>
                                <td>{{ $donation->quantity }} KG</td>
                                <td>{{ $donation->status }}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <a href="{{ route('donor.donations.edit', $donation->id) }}" class="btn btn-info btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                        </div>
                                        <div class="col-md-1"></div>
                                        <div class="col-md-4">
                                            <form action="{{ route('donor.donations.destroy', $donation->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this donation?')"><i class="fa-solid fa-trash"></i></button>
                                            </form>
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