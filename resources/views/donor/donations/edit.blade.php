@extends('layouts.donor')

@section('section')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Update Donation Form</h1>
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
              <h3 class="card-title">Update Donation</h3>
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
            <form method="POST" action="{{ route('donor.donations.update', $donation->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $donation->name }}" required>
                    </div>
        
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea name="description" id="description" class="form-control" required>{{ $donation->description }}</textarea>
                    </div>
        
                    <div class="form-group">
                      <label for="image">Image</label>
                      <img src="{{ asset($donation->image) }}" alt="Donation Image" width="100">
                      <input type="file" class="form-control-file" id="image" name="image">
                      <small class="form-text text-muted">Change image</small>
                  </div>
        
                    <div class="form-group">
                        <label for="quantity">Quantity:</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" value="{{ $donation->quantity }}" required>
                    </div>
        
                    <div class="form-group">
                        <label for="status">Status:</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="Available" {{ $donation->status === 'Available' ? 'selected' : '' }}>Available</option>
                            <option value="Taken" {{ $donation->status === 'Taken' ? 'selected' : '' }}>Taken</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-info">Update Donation</button>
                </div>
                 
            </form>
              </div>



        </div>
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
@endsection