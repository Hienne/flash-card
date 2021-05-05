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
                                    <span>{{ $i +1 }}.
                                    <input type="text">
                                    <span>{{ $cardsForMatching[$i]->front }}</span>
                                </div>
                            @endfor
                        </div>

                        <div class="exam__matching__question">
                            <p><span style="font-weight: bold">A.</span> {{ $cardsForMatching[0]->back }}</p>
                            <p><span style="font-weight: bold">B.</span> {{ $cardsForMatching[1]->back }}</p>
                            <p><span style="font-weight: bold">C.</span> {{ $cardsForMatching[2]->back }}</p>
                            <p><span style="font-weight: bold">D.</span> {{ $cardsForMatching[3]->back }}</p>
                            <p><span style="font-weight: bold">E.</span> {{ $cardsForMatching[4]->back }}</p>
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

                        <div class="exam__selection__answer">
                            <input type="radio" name="selection_answer">
                            <span>thuật ngữ</span>
                            <br>
                            <input type="radio" name="selection_answer">
                            <span>thuật ngữ</span>
                            <br>
                            <input type="radio" name="selection_answer">
                            <span>thuật ngữ</span>
                            <br>
                            <input type="radio" name="selection_answer">
                            <span>thuật ngữ</span>
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

                            <p class="result--true">V Đúng</p>

                            <p class="result--false">X Sai</p>

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
        btnAnswer.addEventListener('click', checkAnswerChooFal);

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

                console.log(answersForChoofal[i]);
                
                for (let btn of btnRadioChoofal) {
                    
                    if (btn.checked) {
                        console.log(btn.value);

                        console.log(answersForChoofal[i] === btn.value);

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