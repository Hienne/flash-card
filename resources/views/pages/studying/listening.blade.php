@extends('layouts.master')

@section('title', 'Kiểm tra')

@section('content')

    <div class="writing-container">
        <div class="container">
            <div class="row justify-content-around">
                <section class="right__writing col-2">
                
                    <div class="right__writing__back">
                        <a href="{{ route('subject', ['id'=>$subjectId]) }}"><i class="fa fa-chevron-left"></i>Trở về</a>
                    </div>

                    <hr>
        
                    <div class="right__writing__title">
                        <h5>Chính tả</h5>
                    </div>
        
                    <div class="right__writing__range">
                        <div class="writing__range__item">
                            <div class="progress rest__range">
                                <div class="progress-bar" role="progressbar" style="width: 100%"></div>
                            </div>
                            <div class="writing__range--status row justify-content-between">
                                <p>Còn lại</p>
                                <p>{{ $numOfCard }}</p>
                            </div>
                        </div>

                        <div class="writing__range__item">
                            <div class="progress wrong__range">
                                <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="" aria-valuemin="0" aria-valuemax="{{ $numOfCard }}"></div>
                            </div>
                            <div class="writing__range--status row justify-content-between">
                                <p>Sai</p>
                                <p>0</p>
                            </div>
                        </div>

                        <div class="writing__range__item">
                            <div class="progress true__range">
                                <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="{{ $numOfCard }}"></div>
                            </div>
                            <div class="writing__range--status row justify-content-between">
                                <p>Đúng</p>
                                <p>0</p>
                            </div>
                        </div>
                    </div>
                </section>

                @foreach ($cards as $card)

                    @if ($cards->search($card) == $cards->search($cards->first()))
                        <section class="study__writing writing--active col-9">
                    @else
                        <section class="study__writing col-9">
                    @endif
                            <div class="study__writing__question row justify-content-between ml-1">
                                <div class="question__container">
                                    <button type="button" class="btn--speak btn-listen-question"><i class="fa fa-volume-up"></i></button>
                                    <p>Click button to listen</p>
                                </div>
                            </div>
                    
                            <hr>

                            <div class="study__writing__answer">
                                <div class="answer__container row justify-content-between">
                                    <div class="form-group form-writing col-9">
                                        <input class="form-control" type="text" placeholder="Nhập những gì bạn nghe thấy">
                                        <input type="hidden" value="{{ $card->back }}">
                                        <label class="form-label">Nhập đáp án</label>
                                    </div>
                            
                                    <button class="btn btn--writing-answer col-2">Đáp án</button>
                                </div>
                            </div>

                            <div class="show__answer">
                                <div class="writing__question">
                                    <p class="show__answer--lable">Câu hỏi</p>
                                    <p>{{ $card->front }}</p>
                                </div>

                                <hr>

                                <div class="writing__answer row justify-content-between align-items-center">
                                    <div>
                                        <p class="show__answer--lable">Đúng</p>
                                        <p>{{ $card->back }}</p>
                                    </div>

                                    <button type="button" class="btn--speak"><i class="fa fa-volume-up"></i></button>
                                </div>
                        
                                <div class="mx-auto">
                                    <button class="btn btn--continue">Tiếp tục</button>
                                </div>
                            </div>
                        </section>
                    
                @endforeach
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        var synth = window.speechSynthesis;
        const btnListenQuestion = document.querySelectorAll('.btn-listen-question');
        const btnUnknow = document.querySelectorAll('.btn--unknow');
        const studyWriting = document.querySelectorAll('.study__writing');
        const formWriting = document.querySelectorAll('.form-writing');
        const btnWritingAnswer = document.querySelectorAll('.btn--writing-answer');

        const restProgressBar = document.querySelector('.rest__range');
        const numOfRest = restProgressBar.nextElementSibling.lastElementChild;

        const wrongProgressBar = document.querySelector('.wrong__range');
        const numOfWrong = wrongProgressBar.nextElementSibling.lastElementChild;

        const trueProgressBar = document.querySelector('.true__range');
        const numOfTrue = trueProgressBar.nextElementSibling.lastElementChild;

        var numOfTrueAnswer = 0;
        var numOfWrongAnswer = 0;
        const numOfCard = btnWritingAnswer.length;

        for (let i = 0; i < numOfCard; i++) {
            let trueAnswer = formWriting[i].firstElementChild.nextElementSibling;

            btnListenQuestion[i].addEventListener('click', function() {
                speak(trueAnswer.value);
            })
        }
        

        for (let i = 0; i < numOfCard; i++) {
            
            btnWritingAnswer[i].addEventListener('click', function() {
                
                let userAnswer = formWriting[i].firstElementChild;
                let trueAnswer = userAnswer.nextElementSibling;

                restProgressBar.firstElementChild.style.width = `${(numOfCard - (i + 1)) / numOfCard * 100}%`;
                numOfRest.innerHTML = `${(numOfCard - (i + 1))}`;

                if (userAnswer.value == trueAnswer.value) {
                    numOfTrueAnswer++;
                    trueProgressBar.firstElementChild.style.width = `${ numOfTrueAnswer / numOfCard * 100 }%`;
                    numOfTrue.innerHTML = numOfTrueAnswer;

                    showNextQuestion(i);
                }

                else {
                    numOfWrongAnswer++;
                    wrongProgressBar.firstElementChild.style.width = `${ numOfWrongAnswer / numOfCard * 100 }%`;
                    numOfWrong.innerHTML = numOfWrongAnswer;
                    
                    //study__writing__question
                    studyWriting[i].firstElementChild.style.display = 'none';
                    
                    //hr
                    studyWriting[i].firstElementChild.nextElementSibling.style.display = 'none';
                    
                    //study__writing__answer
                    studyWriting[i].firstElementChild.nextElementSibling.nextElementSibling.style.display = 'none';
                    
                    //show__answer
                    studyWriting[i].lastElementChild.style.display = 'block';
                    btnContinue = studyWriting[i].lastElementChild.lastElementChild.firstElementChild;
                    btnSpeak = studyWriting[i].lastElementChild.firstElementChild.nextElementSibling.nextElementSibling.lastElementChild;

                    btnContinue.addEventListener('click', function() {
                        showNextQuestion(i);
                    })

                    //Speak
                    btnSpeak.addEventListener('click', () => {
                        speak(trueAnswer.value);
                    })
                }
            })
        }

        function showNextQuestion(i) {
            studyWriting[i].classList.toggle('writing--active');
            studyWriting[i + 1].classList.toggle('writing--active');
            
            if(i + 1 < numOfCard) {
                let trueAnswrNext = formWriting[i+1].firstElementChild.nextElementSibling;
                speak(trueAnswrNext.value);
            }
        }

        function speak(text) {
            var toSpeak = new SpeechSynthesisUtterance(text);
            var voice = synth.getVoices()[4];
            toSpeak.voice = voice;
            synth.speak(toSpeak);
        }
    </script>
@endsection

