@extends('layouts.master')

@section('title', 'Home')

@section('content')
    <div class="home__main container-fluid">
        <div class="row">
            @include('layouts.right_main')

            <div class="col-10 left-main">
                <!-- Main Title -->
                <div class="home__main__title row justify-content-between align-items-center">
                    <p style="color: black">{{ __('app.recently') }}</p>
                    <a href="{{ route('library') }}">{{ __('app.show_all') }}</a>
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
        </div>
    </div>
    
@endsection