@extends('layouts.master')

@section('title', 'Subject')

@section('content')
    <div class="subject-detail">
        <div class="show-card container">
            <h3 class="show-card__title">Subject Name</h3>
            <div class="row">
                <!-- Show card right -->
                @include('layouts.subject.right_subject')

                <!-- Show card left -->
                @include('layouts.subject.show_card')
            </div>
        </div>

        <!-- Subject utility -->
        @include('layouts.subject.utility')

        <!-- Show card list -->
        @include('layouts.subject.list_card')
    </div>
@endsection

@section('script')
    <script>
        const cards = document.querySelectorAll(".show-card__inner");

        for (let card of cards) {
            card.addEventListener("click", function (e) {
                card.classList.toggle('is-flipped');
            });
        }

        $('.carousel').carousel({
            interval: 0
        })
    </script>
@endsection

