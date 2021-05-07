@extends('layouts.master')

@section('title', 'Kiểm tra')

@section('content')
    <div class="exam__container">
        <div class="container exam__content">

            {{-- Translate --}}
            <div class="exam__translate">
                <h4>5 Câu hỏi tự luận</h4>
    
                <div class="exam__translate__detail">

                    {{-- @foreach ($cards as $card)
                        @if ($cards->search($card) < 5)
                        <div class="form-group exam__translate__question">
                            <p><span style="font-weight: bold">{{ $cards->search($card) + 1 }}.</span> {{ $card->front }}</p>
                                <input type="text" class="form-control" 
                                    name="exam_translate">
                            <label for="exam_translate">nhập đáp án của bạn</label>    
                        </div>
                        @else
                            @break
                        @endif
                        
                    @endforeach --}}

                    @foreach ($cardsForTranslate as $card)
                        <div class="form-group exam__translate__question">
                            <p><span style="font-weight: bold">{{ $cardsForTranslate->search($card) + 1 }}.</span> {{ $card->front }}</p>
                                <input type="text" class="form-control" 
                                    name="exam_translate">
                            <label for="exam_translate">nhập đáp án của bạn</label>    
                        </div>
                        
                    @endforeach
                    
                </div>
            </div>

            {{-- Matching --}}
            {{-- @if (count($cards) > 5) --}}
            @if (count($cardsForTranslate) >= 5)
                <div class="exam__matching">
                    <h4>5 Câu hỏi ghép thẻ</h4>
    
                    <div class="exam__matching__detail">

                        <div class="exam__matching__answer">
                            @for ($i = 0; $i < 5; $i++)
                                <div class="answer__detail">
                                    <span class="result--true"><i class="fa fa-check"></i></span>
                                    <span class="result--false"><i class="fa fa-times"></i></span>
                                    <span>{{ $i +1 }}.
                                    <input type="text">
                                    <span>{{ $cardsForMatching[$i]->front }}</span>
                                    <p>Đáp án: {{ $cardsForMatching[$i]->back }}</p>
                                </div>
                            @endfor
                        </div>

                        <div class="exam__matching__question">
                            <p>
                                <span style="font-weight: bold">{{  chr(65)}}.</span> 
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
                <h4>5 Câu hỏi lựa chọn</h4>
    
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
                <h4>5 Câu hỏi Đúng/Sai</h4>
    
                <div class="exam__choofal__detail">
                    @for ($i = 0; $i < 5; $i++)
                        <div class="exam__choofal__question">
                            <p><span style="font-weight: bold">{{ $i + 1 }}. </span> {{ $cardsForChoofal[$i]->front }} -> {{ $cardsRandom[$i] = $cardsForChoofal[random_int (0, 4)]->back }}</p>
                        </div>

                        <div class="exam__choofal__answer">
                            <input type="radio" name="choofal_answer_{{$i}}" value="true">
                            <span>Đúng</span>
                            <br>
                            <input type="radio" name="choofal_answer_{{$i}}" value="false">
                            <span>Sai</span>
                        </div>

                        <div class="result">
                            <p class="result--warning">Chưa có đáp án</p>

                            <p class="result--true"><span><i class="fa fa-check"></i></span> Đúng</p>

                            <p class="result--false"><span><i class="fa fa-times"></i></span> Sai</p>

                        </div>

                        <div class="answer">
                            <h4>Câu trả lời</h4>
                            <p>Sai</p>
                            <p>Câu trả lời như sau: ->{{ $cardsForChoofal[$i]->back }}</p>
                        </div>

                    @endfor
                </div>

            </div>
            @endif
            

            <button class="btn btn--show-answer">Đáp án</button>
        </div>
    </div>
@endsection

@section('script')
    <script>
        const btnAnswer = document.querySelector('.btn--show-answer');
        btnAnswer.addEventListener('click', checkAnswerSelection);
        btnAnswer.addEventListener('click', checkAnswerChooFal);

        // Matching check
        const answerForMatching = {!! json_encode($answersForMatching) !!};
        const cardsForMatching = {!! json_encode($cardsForMatching) !!};

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
                
                for (let btn of btnRadioChoofal) {

                    btn.disabled = true;
                    
                    if (btn.checked) {

                        if(answersForChoofal[i] == btn.value) {
                            choofalResultTrue[i].style.display = 'block';
                        }
                        else {
                            choofalResultFalse[i].style.display = 'block';
                            showAnswerChoofal[i].style.display = 'block';
                        }
                    }
                    else {
                        resultWaringChoofal[i].style.display = 'block';
                        showAnswerChoofal[i].style.display = 'block';
                    }
                }
            }
        }   
        
    </script>
@endsection