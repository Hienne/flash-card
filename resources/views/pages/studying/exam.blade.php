@extends('layouts.master')

@section('title', 'Kiểm tra')

@section('content')
    <div class="exam__container">
        <div class="container exam__content">

            <h3 class="exam-score">{{ __('app.score') }}: <span></span> </h3>
            {{-- Translate --}}
            <div class="exam__translate">
                <h4>5 {{ __('app.essay_question') }}</h4>
    
                <div class="exam__translate__detail">

                    @foreach ($cardsForTranslate as $card)
                        <div class="form-group exam__translate__question">
                            <p><span style="font-weight: bold">{{ $cardsForTranslate->search($card) + 1 }}.</span> {{ $card->front }}</p>
                            <span class="result--true"><i class="fa fa-check"></i></span>
                            <span class="result--false"><i class="fa fa-times"></i></span>
                            <input type="text" class="form-control" name="exam_translate">
                            <p class="alert-for-translate"></p>
                            <label for="exam_translate">{{ __('app.enter_answer') }}</label>   
                            <p class="show-answer"></p> 
                        </div>
                        
                    @endforeach
                    
                </div>
            </div>

            {{-- Matching --}}
            @if (count($cardsForTranslate) >= 5)
                <div class="exam__matching">
                    <h4>5 {{ __('app.matching_question') }}</h4>
    
                    <div class="exam__matching__detail">

                        <div class="exam__matching__answer">
                            @for ($i = 0; $i < 5; $i++)
                                <div class="answer__detail">
                                    <span class="result--true"><i class="fa fa-check"></i></span>
                                    <span class="result--false"><i class="fa fa-times"></i></span>
                                    <span>{{ $i +1 }}.
                                    <input type="text" min="1" max="1">
                                    <span>{{ $cardsForMatching[$i]->front }}</span>
                                    <p class="alert-for-matching">{{ __('app.invalid_answer') }}</p>
                                    <p class="show-answer"></p>
                                </div>
                            @endfor
                        </div>

                        <div class="exam__matching__question">
                            <p>
                                <span style="font-weight: bold">{{ chr(65) }}.</span> 
                                {{ $cardsForMatching[($answersForMatching[0] = $cardsForMatching->search($cardsForMatching->random()))]->back }}
                            </p>
                            <span {{$copyCardsForMatching = $cardsForMatching->slice(0)}}></span>
                            @for ($i = 1; $i < 5; $i++)
                                <p>
                                    <span style="font-weight: bold">{{  chr(65 + $i )}}.</span>
                                    {{ $cardsForMatching[($answersForMatching[$i] = $cardsForMatching->search(Arr::except($copyCardsForMatching, $answersForMatching)->random()))]->back }}
                                </p>
                            @endfor
                        </div>

                    </div>

                </div>
            @endif
            

            {{-- Selection --}}
            @if (count($cardsForTranslate) >= 5)
            <div class="exam__selection">
                <h4>5 {{ __('app.selection_question') }}</h4>
    
                <div class="exam__selection__detail">

                    @for ($i = 0; $i < 5; $i++)
                        <div class="exam__selection__question">
                            <p><span style="font-weight: bold">{{ $i + 1 }}. </span> {{ $cardsForSelection[$i]->front }}</p>
                        </div>

                        <div class="exam__selection__answer" {{ $answersForSelection[$i] = rand(0, 3)}}>
                            
                            @for ($j = 0; $j < 4; $j++)
                                <input type="radio" name="selection_answer_{{ $i }}">
                                @if ($answersForSelection[$i] == $j)
                                    <span>{{ $cardsForSelection[$i]->back }}</span>
                                    <span class="result--true"><i class="fa fa-check"></i></span>
                                @else
                                    <span>{{ $cards[array_rand(Arr::except($cards, array_search($cardsForSelection[$i], $cards)))]->back }}</span>
                                    <span class="result--false"><i class="fa fa-times"></i></span>
                                @endif
                                <br>
                            @endfor
                        </div>
                    @endfor
                
                </div>

            </div>
            @endif
            

            {{-- Choose / False --}}
            @if (count($cardsForTranslate) >= 5)
            <div class="exam__choofal">
                <h4>5 {{ __('app.choose_false_question') }}</h4>
    
                <div class="exam__choofal__detail">
                    @for ($i = 0; $i < 5; $i++)
                        <div class="exam__choofal__question">
                            <p><span style="font-weight: bold">{{ $i + 1 }}. </span> {{ $cardsForChoofal[$i]->front }} -> {{ $cardsRandom[$i] = $cardsForChoofal[random_int (0, 4)]->back }}</p>
                        </div>

                        <div class="exam__choofal__answer">
                            <input type="radio" name="choofal_answer_{{$i}}" value="true">
                            <span>{{ __('app.right') }}</span>
                            <br>
                            <input type="radio" name="choofal_answer_{{$i}}" value="false">
                            <span>{{ __('app.wrong') }}</span>
                        </div>

                        <div class="result">
                            <p class="result--warning">{{ __('app.no_answer') }}</p>

                            <p class="result--true"><span><i class="fa fa-check"></i></span> {{ __('app.right') }}</p>

                            <p class="result--false"><span><i class="fa fa-times"></i></span> {{ __('app.wrong') }}</p>

                        </div>

                        <div class="answer">
                            <h4>{{ __('app.answer') }}</h4>
                            <p>{{ __('app.wrong') }}</p>
                            <p>{{ __('app.answer_like') }} ->{{ $cardsForChoofal[$i]->back }}</p>
                        </div>

                    @endfor
                </div>

            </div>
            @endif
            
            <button class="btn btn--show-answer">{{ __('app.answer') }}</button>
        </div>
    </div>
@endsection

@section('script')
    <script>
        const btnAnswer = document.querySelector('.btn--show-answer');
        btnAnswer.addEventListener('click', checkAnswerSelection);
        btnAnswer.addEventListener('click', checkAnswerChooFal);
        btnAnswer.addEventListener('click', checkAnswerMatching);
        btnAnswer.addEventListener('click', checkAnswerTranslate);
        btnAnswer.addEventListener('click', showScore);

        // Show score
        var showScoreLabel = document.querySelector(".exam-score");
        var showDetailScore = document.querySelector(".exam-score span");

        var score = 0;
        function showScore() {
            showScoreLabel.style.display = 'unset'
            // showScore.innerHTML = `${ score/25 * 100 }%`
            showDetailScore.innerHTML = `${ Math.round(score/25 * 100) }%`;
        }

        // Translate check
        const cardsForTranslate = {!! json_encode($cardsForTranslate) !!};

        var translateResultTrue = document.querySelectorAll('.exam__translate__detail .result--true');
        var translateResultFalse = document.querySelectorAll('.exam__translate__detail .result--false');
        var answerForTranslate = document.querySelectorAll('.exam__translate__detail input');
        var showAnswerForTranslate = document.querySelectorAll('.exam__translate__detail .show-answer');
        var labelForTranslate = document.querySelectorAll('.exam__translate__detail label');
        var alertForTranslate = document.querySelectorAll('.exam__translate__detail .alert-for-translate')

        function checkAnswerTranslate() {
            for (let i = 0; i < answerForMatching.length; i++) {
                if (answerForTranslate[i].value === cardsForTranslate[i].back) {
                    translateResultTrue[i].style.display = "unset";
                    score++;
                }
                else {
                    translateResultFalse[i].style.display = "unset";
                    labelForTranslate[i].innerHTML = "Câu trả lời";
                    showAnswerForTranslate[i].innerHTML = `${ cardsForTranslate[i].back }`;

                    if (answerForTranslate[i].value.length === 0) {
                        alertForTranslate[i].innerHTML = "Chưa có câu trả lời";
                    }
                }
                
                answerForTranslate[i].disabled = true;
            }
        }

        // Matching check
        const answerForMatching = {!! json_encode($answersForMatching) !!};
        const cardsForMatching = {!! json_encode($cardsForMatching) !!};

        var userAnswerForMatching = document.querySelectorAll('.exam__matching__answer input');
        var alertForMatching = document.querySelectorAll('.alert-for-matching');
        const matchingResultTrue = document.querySelectorAll('.exam__matching__answer .result--true');
        const matchingResultFalse = document.querySelectorAll('.exam__matching__answer .result--false');
        const showAnswerMatching = document.querySelectorAll('.exam__matching__answer .show-answer');
        var arrIndexOfAnswer = [];

        //Upper case answer
        for (let i = 0; i < userAnswerForMatching.length; i++) {
            userAnswerForMatching[i].addEventListener('keyup', function(a) {
                userAnswerForMatching[i].value = userAnswerForMatching[i].value.toUpperCase();
                
                if (userAnswerForMatching[i].value.length > 1) {
                    btnAnswer.disabled = true;
                    alertForMatching[i].style.display = "block";
                }
                else {
                    btnAnswer.disabled = false;
                    alertForMatching[i].style.display = "none";
                }
            })
        }

        // convert user's answer to ascii for check
        function convertIndexOfAnswer(arrIndex, arrUserAnswer) {
            for (let i = 0; i < arrUserAnswer.length; i++) {
                arrIndex[i] = (arrUserAnswer[i].value.charCodeAt(0)) - 65;
            }
        }
        

        function checkAnswerMatching() {
            convertIndexOfAnswer(arrIndexOfAnswer, userAnswerForMatching);
            console.log(arrIndexOfAnswer);

            for (let i = 0; i < 5; i++) {
                if (arrIndexOfAnswer[i] === answerForMatching[i]) {
                    matchingResultTrue[i].style.display = "unset";
                    score++;
                }
                else {
                    matchingResultFalse[i].style.display = "unset";
                    showAnswerMatching[i].style.display = "block";
                    showAnswerMatching[i].innerHTML = `Đáp án: ${cardsForMatching[i].back}`;
                }

                userAnswerForMatching[i].disabled = true;
            }
        }

        // Selection Check
        const selectionResultTrue = document.querySelectorAll('.exam__selection__answer .result--true');

        const answersForSelection = {!! json_encode($answersForSelection) !!};
        const cardsForSelection = {!! json_encode($cardsForSelection) !!};


        function checkAnswerSelection() {
            for (let i = 0; i < 5; i++) {
                let btnRadioSelection = document.getElementsByName('selection_answer_' + i);
                
                for (let j = 0; j < 4; j++) {

                    btnRadioSelection[j].disabled = true;

                    if (btnRadioSelection[j].checked) {

                        btnRadioSelection[j].nextElementSibling.nextElementSibling.style.display = 'unset';

                        if (answersForSelection[i] !== j) {
                            selectionResultTrue[i].style.display = 'unset';
                            score++;
                        }
                    }
                    else {
                        selectionResultTrue[i].style.display = 'unset';
                    }
                }
            }
        }   

        // Choose False Check
        const resultWaringChoofal  = document.querySelectorAll('.exam__choofal__detail .result .result--warning');
        const choofalResultTrue = document.querySelectorAll('.exam__choofal__detail .result .result--true');
        const choofalResultFalse = document.querySelectorAll('.exam__choofal__detail .result .result--false');
        const showAnswerChoofal = document.querySelectorAll('.exam__choofal__detail .answer');

        const cardsRanChoofal = {!! json_encode($cardsRandom) !!};
        const cardsForChoofal = {!! json_encode($cardsForChoofal) !!};

        var answersForChoofal = cardsForChoofal.map((element, index) => {
            if (element.back === cardsRanChoofal[index]) {
                return 'true';
            }

            return 'false';
        });

        function checkAnswerChooFal() {
            for (let i = 0; i < 5; i++) {
                let btnRadioChoofal = document.getElementsByName('choofal_answer_' + i);
                let check = 0;
                
                for (let btn of btnRadioChoofal) {

                    btn.disabled = true;
                    
                    if (btn.checked === true) {
                        check = 1;

                        if(answersForChoofal[i] === btn.value) {
                            choofalResultTrue[i].style.display = 'block';
                            score++;
                        }
                        else {
                            choofalResultFalse[i].style.display = 'block';
                            showAnswerChoofal[i].style.display = 'block';
                        }
                    }
                }

                if (check === 0) {
                    resultWaringChoofal[i].style.display = 'block';
                    showAnswerChoofal[i].style.display = 'block';
                }
            }
        }   
        
    </script>
@endsection