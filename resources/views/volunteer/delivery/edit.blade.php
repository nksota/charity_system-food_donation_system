@extends('layouts.volunteer')

@section('section')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Update Order Form</h1>
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
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Update Order</h3>
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
            <form method="POST" action="{{ route('volunteer.delivery.update', $passport) }}">
              @csrf
              @method('PUT')
              <div class="card-body">
              <div class="form-group">
                  <label for="status">Status</label>
                  <select id="status" name="status" class="form-control">
                      <option value="dispatched" {{ $passport->status == 'dispatched' ? 'selected' : '' }}>Out for Delivery</option>
                      <option value="delivered" {{ $passport->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                  </select>
              </div>
  
              <button type="submit" class="btn btn-primary">Update Order</button>
              </div>
          </form>
              </div>



        </div>
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
@endsection