@extends('layouts.orphanage')

@section('section')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Donation Details</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
          </ol>
        </div>
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

    <!-- Default box -->
    <div class="card card-solid">
      <div class="card-body">
        <div class="row">
          <div class="col-12 col-sm-6">
            <h3 class="d-inline-block d-sm-none">{{ $donation->name }}</h3>
            <div class="col-12">
              <img src="{{ asset($donation->image) }}" class="product-image" alt="Product Image">
            </div>
          </div>
          <div class="col-12 col-sm-6">
            <h3 class="my-3">{{ $donation->name }}</h3>
            <p>
                {{ $donation->description }}
            </p>

            <hr>

            <div class="bg-gray py-2 px-3 mt-4">
              <h2 class="mb-0">
                {{ $donation->quantity }} KG
              </h2>
              <h4 class="mt-0">
                <small>Donor details</small>
              </h4>
              <h4 class="mt-0">
                <small>{{ $donation->user->name }} {{ $donation->user->email }}</small>
              </h4>
            </div>

            <div class="mt-4">
              <div class="btn btn-lg btn-flat">
                <form method="POST" action="{{ route('donations.add-to-cart', ['donation' => $donation]) }}">
                  @csrf
                  <button type="submit" class="btn btn-primary">Claim</button>
              </form>
              
              </div>

              <div class="btn btn-default btn-lg btn-flat">
                <i class="fas fa-heart fa-lg mr-2"></i>
                Add to Wishlist
              </div>
            </div>

          </div>
        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->

@endsection