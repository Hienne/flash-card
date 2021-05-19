@extends('layouts.master')

@section('title', 'Login')
    
@section('content')
<div class="home__main container-fluid">
  <section class="signup" style="background-color: white">
    <div class="content">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <img style="padding: 0" class="mx-auto d-block" src="{{ asset('storage/img/signin-image.jpg') }}" alt="Image" class="img-fluid">
            </div>
            <div class="col-md-6 contents">
              <div class="row justify-content-center">
                <div class="col-md-12">
                  <div class="text-center mb-4">
                  <h3>{{ __('app.login') }}</h3>

                  @if (session()->has('status'))
                    <div class="text-danger small">
                        {{ session('status') }}
                    </div>
                  @endif
                </div>
                <form action="{{ route('login') }}" method="POST">
                  @csrf
                  <div class="form-group first field--not-empty">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">

                    @error('email')
                        <div class="text-danger small">
                          {{ $message }}
                        </div>
                    @enderror
                  </div>
  
                  <div class="form-group last field--not-empty mb-4">
                    <label for="password">{{ __('app.password') }}</label>
                    <input type="password" class="form-control" id="password" name="password">
                  
                    @error('password')
                    <div class="text-danger small">
                      {{ $message }}
                    </div>
                    @enderror
                  </div>

                  <input type="submit" value="{{ __('app.login') }}" class="btn btn-block btn-primary">
    
                  <span class="d-block text-left my-4 text-muted">&mdash; {{ __('app.login_by') }} &mdash;</span>
                  
                  <div class="social-login">
                    <a href="#" class="facebook">
                      <span class="icon-facebook mr-3"><i class="fa fa-facebook-f fa-2x"></i></span> 
                    </a>
                    <a href="{{ route('login.google') }}" class="google">
                      <span class="icon-google mr-3"><i class="fa fa-google fa-2x"></i></span> 
                    </a>
                  </div>
                </form>
                </div>
              </div>
              
            </div>
            
          </div>
        </div>
      </div>
</div>
@endsection