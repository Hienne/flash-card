@extends('layouts.master')

@section('title', 'shared')

@section('content')
    {{-- Detail --}}
    <div class="library__detail">
        <div class="library_wrapper">
            
            <div id="subject" class="container tabcontent active">

                <div  class="library__item">

                    @if (count($sharedSubjects) <= 0) 
                        <h1>{{ __('app.no_search') }}</h1>
                    @endif

                    @foreach ($sharedSubjects as $subject)
                        <a href="{{ route('subject', ['id'=>$subject->subject_id]) }}" class="library__item__detail">
                            <div class="item__detail__title">
                                <p>{{ $subject->subject->cards()->count() }} {{ __('app.term') }}</p>
                                <span class="user_logo logo_size">{{ strtoupper($subject->subject->user->name[0]) }}</span>
                                <h3>{{ $subject->subject->user->name }}</h3>
                            </div>
    
                            <div class="item__detail__name">
                                <h2>{{ $subject->name }}</h2>
                            </div>
                        </a>
                    @endforeach

                    {{ $sharedSubjects->links() }}
                </div>
            </div>

        

        </div>
    </div>
    
@endsection

@section('script')
    <script>
        
    </script>
@endsection