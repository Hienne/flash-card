<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Card Study</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/subject.css') }}" rel="stylesheet">
    <link href="{{ asset('css/card_study.css') }}" rel="stylesheet">
</head>
<body>
    <header class="container-fluid">        
        <!-- Button trigger modal -->
        <button type="button" class="btn btn--back" data-toggle="modal" data-target="#back_home">
            Trang chủ
        </button>

        <!-- Modal -->
        <div class="modal fade" id="back_home" tabindex="-1" role="dialog" aria-labelledby="back_home" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
        
                    <div class="modal-body">
                        Quá trình học sẽ không được lưu. Bạn có chắc chắn muốn quay về trang chủ?
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <a href="{{ route('home') }}"><button type="button" class="btn btn-primary">Trang chủ</button></a>
                    </div>
                </div>
            </div>
        </div>

        <button type="button" class="btn btn--back" data-toggle="modal" data-target="#back_subject">
            <i style="color: rgb(66, 87, 178);" class="fa fa-times"></i>
        </button>

        <!-- Modal -->
        <div class="modal fade" id="back_subject" tabindex="-1" role="dialog" aria-labelledby="back_subject" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
        
                    <div class="modal-body">
                        Quá trình học sẽ không được lưu. Bạn có chắc chắn muốn quay lại học phần?
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <a href="{{ route('subject', ['id'=>$subject->id]) }}"><button type="button" class="btn btn-primary">Học phần</button></a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main>
        <div class="container list__card__study">
            <form action="{{ route('studying.updateStudyingCard') }}" method="POST">
                @csrf
                @foreach ($cards as $card)

                    @if ($loop->first)
                        <div class="card-wrapper active">
                    @else
                        <div class="card-wrapper">
                    @endif
                            <div class="card__study">
                                <div class="show-card__card carousel-item active">
                                    <div class="show-card__inner">
                                        <div class="card--front">
                                            <p>{{ $card->front }}</p>
                                        </div>
                                        <div class="card--back">
                                            <p>{{ $card->back }}</p>
                                        </div>
                                    </div>

                                    <button class="btn--speak hidden" type="button"><i class="fa fa-volume-up"></i></button>
                                </div>
                            </div>
        
                            <button class="btn btn--answer active" type="button">Đáp án</button>
    
                            <div class="card__study__date" id="level-card-{{ $card->id }}">
                                <div class="choosen-level-card">
                                    <input class="checkbox-level-card" type="radio" name="level-card-{{$card->id}}" value="1">
                                    <label class="for-checkbox-level-card" for="level-1">
                                        <span>Lại</span>
                                        <br>
                                        1 ngày
                                    </label>
                                </div>
                        
                                <div class="choosen-level-card">
                                    <input class="checkbox-level-card" type="radio" name="level-card-{{$card->id}}" value="2">
                                    <label class="for-checkbox-level-card" for="level-2">
                                        <span>Khó</span>
                                        <br>
                                        {{ ($card->num_of_study + 1) * 2 }} ngày
                                    </label>
                                </div>
                        
                                <div class="choosen-level-card">
                                    <input class="checkbox-level-card" type="radio" name="level-card-{{$card->id}}" value="4">
                                    <label class="for-checkbox-level-card" for="level-3">
                                        <span>Được</span> 
                                        <br>
                                        {{ ($card->num_of_study + 1) * 4 }} ngày
                                    </label>
                                </div>
                        
                                <div class="choosen-level-card">
                                    <input class="checkbox-level-card" type="radio" name="level-card-{{$card->id}}" value="7">
                                    <label class="for-checkbox-level-card" for="level-4">
                                        <span>Dễ</span> 
                                        <br> 
                                        {{ ($card->num_of_study + 1) * 7 }} ngày
                                    </label>
                                </div>             
                            </div>

                        </div>

                @endforeach
                
                <div class="card-wrapper btn-submit-result">
                    <input type="hidden" name="subjectId" value="{{ $subject->id }}">
                    <button class="btn" type="submit">Kết thúc</button>
                </div>

            </form>
            
        </div>
    </main>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    
    <script>
        
        const btnAnswers = document.querySelectorAll(".btn--answer");
        var cardWrapper;
        var card;
        var cardStudyDate;
        var listCheckBox;
        var btnSpeak;
        
        for (let btn of btnAnswers) {
            btn.addEventListener('click', function (e) {
                //class show-card__inner
                card = btn.previousElementSibling.firstElementChild.firstElementChild;

                // class card__study__date
                cardStudyDate = btn.nextElementSibling;

                // class card-wrapper
                cardWrapper = btn.parentElement;

                // list choosen__level__card
                listCheckBox = btn.nextElementSibling.children;

                btnSpeak = btn.previousElementSibling.firstElementChild.lastElementChild;

                card.classList.toggle('is-flipped');
                card.addEventListener('click', function (e) {
                    card.classList.toggle('is-flipped');
                    btnSpeak.classList.toggle('hidden');
                });

                cardStudyDate.classList.add('active2');
                btnSpeak.classList.remove('hidden');
                btn.classList.add('hidden');

                for(let radio of listCheckBox) {
                    radio.addEventListener('click', function() {
                        cardWrapper.classList.add('hidden');
                        cardWrapper.nextElementSibling.classList.add('active')
                        radio.firstElementChild.checked = true;
                    })
                }
            })
        }

        var synth = window.speechSynthesis;
        var showCards = document.querySelectorAll('.show-card__card');
        for (let item of showCards) {
            let btnSpeak = item.lastElementChild;
            let txtBack = item.firstElementChild.lastElementChild.firstElementChild;

            btnSpeak.addEventListener('click', () => {
                var toSpeak = new SpeechSynthesisUtterance(txtBack.innerHTML);
                var voice = synth.getVoices()[4];
                toSpeak.voice = voice;
                synth.speak(toSpeak);
            })
        }
        
    </script>
</body>
</html>