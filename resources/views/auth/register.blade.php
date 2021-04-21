@extends('layouts.master')

@section('title', 'Register')
    
@section('content')
  <div class="home__main container-fluid">
    <section class="signup" style="background-color: white">
      <div class="content">
          <div class="container">
            <div class="row">
              <div class="col-md-6">
                <img class="mx-auto d-block" src="{{ asset('storage/img/signup-image.jpg') }}" alt="Image" class="img-fluid">
              </div>
              <div class="col-md-6 contents">
                <div class="row justify-content-center">
                  <div class="col-md-12">
                    <div class="text-center mb-4">
                    <h3>Lập tài khoản</h3>
                    <p class="mb-4">Trải nghiệm học tập với Flash-card, phương pháp ghi nhớ thông minh đã được nghiên cứu</p>
                  </div>
                  <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="form-group first field--not-empty">
                      <label for="name">Tên người dùng</label>
                      <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
  
                      @error('name')
                          <div class="text-danger small">
                            {{ $message }}
                          </div>
                      @enderror
                    </div>
    
                    <div class="form-group field--not-empty">
                      <label for="date_of_birth">Ngày sinh</label>
                      <input type="date" name="date_of_birth" id="date_of_birth" class="form-control">
                      {{-- <input type="text" name="date_of_birth" id="date_of_birth" class="form-control auth" id="name" value="{{ auth()->user()->birth_of_date }}"> --}}
  
                      @error('date_of_birth')
                        <div class="text-danger small">
                          {{ $message }}
                        </div>
                        @enderror
                    </div>
    
                    <div class="form-group field--not-empty">
                      <label for="email">Email</label>
                      <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
  
                      @error('email')
                        <div class="text-danger small">
                          {{ $message }}
                        </div>
                        @enderror
                    </div>
    
                    <div class="form-group field--not-empty">
                      <label for="password">Mật khẩu</label>
                      <input type="password" class="form-control" id="password" name="password">
                    
                      @error('password')
                      <div class="text-danger small">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
    
                    <div class="form-group field--not-empty last mb-4">
                      <label for="password_confirmation">Xác nhận mật khẩu</label>
                      <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                      
                      @error('password_confirmation')
                      <div class="text-danger small">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
      
                    <input type="submit" value="Đăng ký" class="btn btn-block btn-primary">
      
                    <span class="d-block text-left my-4 text-muted">&mdash; hoặc đăng ký với &mdash;</span>
                    
                    <div class="social-login">
                      <a href="#" class="facebook">
                        <span class="icon-facebook mr-3"><i class="fa fa-facebook-f fa-2x"></i></span> 
                      </a>
                      <a href="#" class="google">
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

@section('script')
<script>
  // $( function() {
  //   $( "#date_of_birth" ).datepicker();
  // } );

// $(function() {
// 	'use strict';
	
//   $('.form-control').on('input', function() {
// 	  var $field = $(this).closest('.form-group');
// 	  if (this.value) {
// 	    $field.addClass('field--not-empty');
//       console.log(this);
// 	  } else {
// 	    $field.removeClass('field--not-empty');
// 	  }
// 	});

  // let a = document.querySelectorAll('.auth');
  // let b = document.querySelectorAll('.test')

  // function test(i) {
  //   console.log(this);
    // if(this.getAttribute('value') != null) {
    //   b[i].classList.add('field--not-empty');
    //   console.log('b[i]');
    // }
    // else {
    //   b[i].classList.remove('field--not-empty');
    //   console.log('b[i]');
    // }
  // }

  
  // console.log(b);
  // for(let i = 0; i < a.length; i++) {
  //   a[i].addEventListener("keypress", function() {
  //     test(i);
  //   });
  // }

  

});
</script>

@endsection