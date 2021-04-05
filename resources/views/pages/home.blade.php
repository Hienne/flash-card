@extends('layouts.master')

@section('title', 'Home')

@section('content')
<main class="home__main">
    <div class="container">
      <!-- Main Title -->
      <div class="home__main__title row justify-content-between align-items-center">
          <p style="color: black">Gần đây</p>
          <a href="#">Xem tất cả</a>
      </div>

      <!-- Main Content -->
      <div class="home__main__content row justify-content-between">
          <div class="home__main__item col-12 col-sm-6">
              <a href="#">
                  <h4>Học phần 1</h4>
                  <p>40 thuật ngữ</p>
                  <p>hienne99</p>
              </a>
          </div>

          <div class="home__main__item col-12 col-sm-6">
              <a href="#">
                  <h4>Học phần 1</h4>
                  <p>40 thuật ngữ</p>
                  <p>hienne99</p>
              </a>
          </div>

          <div class="home__main__item col-12 col-sm-6">
              <a href="#">
                  <h4>Học phần 1</h4>
                  <p>40 thuật ngữ</p>
                  <p>hienne99</p>
              </a>
          </div>

          <div class="home__main__item col-12 col-sm-6">
              <a href="#">
                  <h4>Học phần 1</h4>
                  <p>40 thuật ngữ</p>
                  <p>hienne99</p>
              </a>
          </div>
      </div>
  </div>
  
</main>
@endsection