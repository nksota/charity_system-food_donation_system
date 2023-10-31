@extends('layouts.orphanage')

@section('section')


<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Donations</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><button class="btn btn-info"><a  style="color: #fff;"href="{{ url('orphanage/cart')}}">View Cart</a></button></li>
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
    <style>
        /* Define styles for the product grid */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); /* Adjust the column width */
            gap: 5px;
            padding: 20px;
            text-align: center;
        }
    
        /* Define styles for individual product items */
        .product-item {
            width: 100%; /* Set the item width to 100% to span the entire column */
            max-width: 250px; /* Adjust the maximum width for each item */
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
            border-radius: 10px;
            box-sizing: border-box;
        }
    
          /* Define styles for product images */
        .product-image {
            width: 100px; /* Set a fixed width for the images */
            height: 100px; /* Set a fixed height for the images */
            object-fit: cover; /* Maintain aspect ratio and cover container */
            border-radius: 10px; /* Rounded corners for images */
        }
    
        /* Define styles for product titles */
        .product-title {
            font-weight: bold;
        }
    
        /* Define styles for product buttons */
        .product-buttons {
            display: flex;
            justify-content: space-between;
            padding: 10px;
        }
    
        /* Define styles for the "View" button */
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            text-decoration: none;
        }
    
        /* Define styles for the "View" button when it has the "info" background color */
        .btn-info {
            background-color: #17a2b8;
            color: #fff;
        }
    
        /* Define styles for the "Claim" button when it has the "primary" background color */
        .btn-primary {
            background-color: #007bff;
            color: #fff;
        }
    </style>
    
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
         
          <!-- /.card -->

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Donations</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              
                <div class="product-grid">
                    <div class="product-grid">
                        @foreach ($donations as $donation)
                            <div class="product-item">
                                <img class="product-image" src="{{ asset($donation->image) }}" alt="{{ $donation->name }}">
                                <div class="product-title">{{ $donation->name }}</div>
                                <div class="product-buttons">
                                    <a href="{{ route('donations.view', ['id' => $donation->id]) }}" class="btn btn-info">View</a>
                                    <form method="POST" action="{{ route('donations.add-to-cart', ['donation' => $donation]) }}">
                                      @csrf
                                      <button type="submit" class="btn btn-primary">Claim</button>
                                  </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
            
                    <!-- Add more product items as needed -->
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