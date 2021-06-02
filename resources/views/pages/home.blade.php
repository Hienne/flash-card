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
                    <h3>{{ __('app.recent_subject') }}</h3>
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

    <!-- Modal -->
    <div class="modal" tabindex="-1" role="dialog" id="alertModal">
        <form action="{{ route('sharedSub.create') }}" method="post">
            @csrf
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header test">
                        <h5 class="modal-title">{{ __('app.alert') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </form>
        
    </div>
    
@endsection

@section('script')
@if (session()->has('alert'))
<script>
    $(document).ready(function(){
        
        $("#alertModal").modal('show');

    });
</script>
@endif
@endsection