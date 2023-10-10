@extends('layouts.donor')

@section('section')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        
      </div>
    </div><!-- /.container-fluid -->
  </section>
  @if(session('message'))
  <div class="alert alert-success alert-dismissible fade show">{{ session('message') }}</div>
  @endif
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="card card-info card-outline">
            <div class="card-body box-profile">
              <div class="text-center">
                <img class="profile-user-img img-fluid img-circle"
                src="{{ asset('storage/profiles/' . $donor->profile) }}"
                     alt="User profile picture">
              </div>

              <h3 class="profile-username text-center">{{ $user->name }}</h3>

              <p class="text-muted text-center"> {{ $donor->dob }}</p>
              <p class="text-muted text-center">{{ $donor->gender }}</p>

            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card">
            <div class="card-header p-2">
              <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link {{ $redirectToTab === 'timeline' ? 'active' : '' }}" href="#timeline" data-toggle="tab">Quick settings</a></li>
                <li class="nav-item"><a class="nav-link {{ $redirectToTab === 'settings' ? 'active' : '' }}" href="#settings" data-toggle="tab">Settings</a></li>
              </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content">
                <!-- /.tab-pane -->
                <div class="tab-pane fade {{ $redirectToTab === 'timeline' ? 'active' : '' }}" id="timeline">
                  <!-- The timeline -->
                    <form class="form-horizontal" method="POST" action="{{ route('donor.profile.profile') }}">
                      @csrf
                      @method('PUT')
                    <div class="form-group row">
                      <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                      <div class="col-sm-10">
                        <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                      <div class="col-sm-10">
                        <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}">
                      </div>
                    </div>
                    <label for="inputpassword" class="col-sm-2 col-form-label">New Password</label>
                    <div class="form-group row">
                      <label for="inputpassword" class="col-sm-2 col-form-label">Password</label>
                      <div class="col-sm-10">
                        <input type="password" name="password" id="password" class="form-control">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputpassword" class="col-sm-2 col-form-label">Confirm Password</label>
                      <div class="col-sm-10">
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="offset-sm-2 col-sm-10">
                        <button type="submit" class="btn btn-danger">Submit</button>
                      </div>
                    </div>
                  </form>
                </div>
                <!-- /.tab-pane -->

                <div class="tab-pane fade {{ $redirectToTab === 'settings' ? 'active' : '' }}" id="settings">
                    <form class="form-horizontal" method="POST" action="{{ route('donor.profile.profile') }}">
                        @csrf
                        @method('PUT')
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Phone Number</label>
                        <div class="col-sm-10">
                          <input type="text" name="phone" id="phone" class="form-control" value="{{ $donor->phone }}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Current City</label>
                        <div class="col-sm-10">
                          <input type="text" name="city" id="city" class="form-control" value="{{ $donor->city }}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-10">
                          <input type="text" name="address" id="address" class="form-control" value="{{ $donor->address }}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Update</button>
                        </div>
                      </div>
                  </form>
                </div>
                <!-- /.tab-pane -->
              </div>
              <!-- /.tab-content -->
            </div><!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>

@endsection