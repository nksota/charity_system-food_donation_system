@extends('layouts.reg')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3><b></b></h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Almost done!</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-2"></div>
          <!-- left column -->
          <div class="col-md-8">
            <!-- general form elements -->
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Fill</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
             <form method="POST" action="{{ route('donor.dashboard') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                      
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="exampleInputFile">Upload Profile Image</label>
                                <div class="input-group">
                                  <div class="custom-file">
                                    <input type="file" name="profile" class="custom-file-input" required>
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                  </div>
                                  <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                          <div class="form-group">
                              <label for="phone">{{ __('Phone Number') }}</label>
                              <input id="phone" type="text" class="form-control" name="phone" required>
                          </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="gender">{{ __('Gender') }}</label>
                          <select id="gender" name="gender" class="form-control" required>
                              <option value="" selected>{{ __('Select Gender') }}</option>
                              <option value="Male">{{ __('Male') }}</option>
                              <option value="Female">{{ __('Female') }}</option>
                              <option value="Other">{{ __('Other') }}</option>
                          </select>
                        </div>
                    </div>
                  </div>
                    <div class="row">
                      
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="dob">{{ __('Date of Birth') }}</label>
                                <input id="dob" type="date" class="form-control" name="dob" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="address">{{ __('Address') }}</label>
                                <input id="address" type="text" class="form-control" name="address" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                              <label for="address">{{ __('Current City') }}</label>
                              <input id="address" type="text" class="form-control" name="city" required>
                          </div>
                      </div>
                    </div>
                    <!-- Add more form fields for the remaining citizen attributes -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Submit</button>
                    </div>
                </div>
            </form>
               
            </div>
            <!-- /.card -->

          </div>
          <div class="col-md-2"></div>
          <!--/.col (left) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

@endsection
