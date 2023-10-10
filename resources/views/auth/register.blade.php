@extends('layouts.app')

@section('content')
  <!-- /.login-logo -->
<div class="card-body">
  <p class="login-box-msg">Register</p>

  <form method="POST" action="{{ route('register') }}">
    @csrf
    <div class="input-group mb-3">
      <input placeholder="Full Name" id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

      @error('name')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
      <div class="input-group-append">
        <div class="input-group-text">
          <span class="fas fa-user"></span>
        </div>
      </div>
    </div>
    <div class="input-group mb-3">
      <input placeholder="Email" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

      @error('email')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
      <div class="input-group-append">
        <div class="input-group-text">
          <span class="fas fa-envelope"></span>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label for="type">{{ __('User Type') }}</label>
      <select id="type" name="type" class="form-control @error('type') is-invalid @enderror">
        <option value="" selected disabled>Select User Type</option>
          <option value="0" {{ old('type') == '0' ? 'selected' : '' }}>Volunteer</option>
          <option value="2" {{ old('type') == '2' ? 'selected' : '' }}>Donor</option>
          <option value="3" {{ old('type') == '3' ? 'selected' : '' }}>Orphanage</option>
      </select>
      @error('type')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
  </div>

    <div class="input-group mb-3">
      <input placeholder="Password" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

      @error('password')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
      <div class="input-group-append">
        <div class="input-group-text">
          <span class="fas fa-lock"></span>
        </div>
      </div>
    </div>
    <div class="input-group mb-3">
      <input placeholder="Confirm Password" id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
      <div class="input-group-append">
        <div class="input-group-text">
          <span class="fas fa-lock"></span>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-8">
      </div>
      <!-- /.col -->
      <div class="col-4">
        <button type="submit" class="btn btn-info btn-block">Register</button>
      </div>
      <!-- /.col -->
    </div>
  </form>

  <a href="{{ route('login') }}" class="text-center">Login</a>
</div>
<!-- /.form-box -->

@endsection
