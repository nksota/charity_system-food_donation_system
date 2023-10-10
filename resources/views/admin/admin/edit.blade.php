@extends('layouts.admin')

@section('section')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Update Admin Form</h1>
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
              <h3 class="card-title">Update Admin</h3>
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
            <form method="POST" action="{{ url('admin/admin/'.$user->id) }}">
                @csrf
                @method('PUT')
                <div class="card-body">
                  <div class="form-group">
                      <label for="name">First Name</label>
                      <input type="text" name="name" id="name" value="{{ $user->name }}" class="form-control">
                  </div>
                  <div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" name="email" id="email" value="{{ $user->email }}" class="form-control">
                  </div>
                  <button type="submit" class="btn btn-info">Update Admin</button>
            </form>
              </div>



        </div>
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
@endsection