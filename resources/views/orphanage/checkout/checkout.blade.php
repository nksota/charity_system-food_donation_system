@extends('layouts.orphanage')

@section('section')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1> Donation Checkout Form</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

<section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Donation Checkout</h3>
            </div>
            @if ($errors->any())
            <div class="alert alert-warning">
              @foreach ($errors->all() as $error)
                  <div>{{ $error }}</div>
              @endforeach
            </div>

            @endif
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" action="{{ route('orphanage.checkout.process') }}" enctype="multipart/form-data">
                @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="location">Location</label>
                  <input type="text" name="location" id="location" class="form-control" required>
              </div>
              <div class="form-group">
                <label>Select a Volunteer</label>
                <select name="volunteer" class="form-control select2" style="width: 100%;">
                    <option selected="selected">Select</option>
                    @foreach ($volunteers as $volunteer)
                        <option value="{{ $volunteer->id }}">{{ $volunteer->name }}</option>
                    @endforeach
                </select>
            </div>
            
              <!-- List of donations in the cart -->
              <div class="form-group">
                  <label for="cartDonations">My Donations</label>
                  <ul>
                      @foreach ($cart as $cartItem)
                          <li>{{ $cartItem->donation->name }}</li>
                      @endforeach
                  </ul>
              </div>
            <button type="submit" class="btn btn-info">Checkout </button>
              </div>
                
            </form>
              </div>



        </div>
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
@endsection
