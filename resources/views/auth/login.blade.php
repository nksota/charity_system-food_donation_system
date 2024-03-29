@extends('layouts.login')

@section('content')
  <!-- /.login-logo -->
  @if(session('message'))
  <div class="alert alert-success alert-dismissible fade show">{{ session('message') }}</div>
  @endif
  @if(session('error'))
  <div class="alert alert-danger alert-dismissible fade show">{{ session('error') }}</div>
  @endif

  <div class="card card-primary">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in</p>

      <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="input-group mb-3">
          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
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
        <div class="input-group mb-3">
          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
          
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
        <div class="row">
          <div class="col-8">
              <p class="mb-0">
        <a href="{{ route('register') }}" class="text-center">Register</a>
      </p>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-info btn-block">Login</button>
          </div>
          <!-- /.col -->
        </div>
    

      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
@endsection
