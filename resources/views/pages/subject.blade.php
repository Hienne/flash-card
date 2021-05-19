@extends('layouts.master')

@section('title', 'Subject')

@section('content')
    <div class="subject-detail">
        <div class="show-card container">
            <h3 class="show-card__title">{{ $subject->name }} ({{ count($expiryCards) }} {{ __('app.due_card') }})</h3>
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
        
        var synth = window.speechSynthesis;
        var showCardListItems = document.querySelectorAll('.show-card__list__item');
        for (let item of showCardListItems) {
            let btnSpeak = item.firstElementChild.lastElementChild.firstElementChild;
            let txtBack = item.firstElementChild.firstElementChild.firstElementChild.lastElementChild;
            let btnUpdateCard = btnSpeak.nextElementSibling;
            let cardDetail = item.firstElementChild.firstElementChild.firstElementChild;
            let formUpdateCardWrapper = cardDetail.nextElementSibling;
            let formUpdateCard = cardDetail.nextElementSibling.firstElementChild;

            btnSpeak.addEventListener('click', () => {
                var toSpeak = new SpeechSynthesisUtterance(txtBack.innerHTML);
                var voice = synth.getVoices()[4];
                toSpeak.voice = voice;
                synth.speak(toSpeak);
            });

            btnUpdateCard.addEventListener('click', function() {
                this.classList.toggle('focus-color');
                cardDetail.classList.toggle('un-display');
                formUpdateCard.classList.toggle('un-display');
            });
        }
    </script>
@endsection

