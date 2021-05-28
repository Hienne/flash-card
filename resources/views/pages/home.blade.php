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
                @if (count($recentSub) == 0)
                    <h3>Không có học phần nào được truy cập gần đây.</h3>
                @else
                    <div class="home__main__content row justify-content-between">
                        @foreach ($recentSub as $subject)
                            <div class="home__main__item col-12 col-sm-6">
                                <a href="{{ route('subject', ['id'=>$subject->id]) }}">
                                    <h4>{{ $subject->name }}</h4>
                                    <p>{{ $subject->cards->count() }} {{ __('app.card') }}</p>
                                    <p>{{ $subject->name }}</p>
                                </a>
                            </div>
                        @endforeach
                    
                    </div>
                @endif
            </div>
        </div>
    </div>
    
@endsection