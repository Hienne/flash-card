@extends('layouts.master')

@section('title', 'Kiểm tra')

@section('content')
    <div class="exam__container">
        <div class="container exam__content">

            {{-- Translate --}}
            <div class="exam__translate">
                <h4>5 Câu hỏi tự luận</h4>
    
                <div class="exam__translate__detail">
                    @for ($i = 0; $i < 5; $i++)
                        <div class="form-group exam__translate__question">
                            <p><span style="font-weight: bold">{{ $i }}.</span> {{ $cards[$i]->front }}</p>
                            <input type="text" class="form-control" 
                                name="exam_translate">
                            <label for="exam_translate">nhập đáp án của bạn</label>
                        </div>
                    @endfor
                    
                </div>
            </div>

            {{-- Matching --}}
            <div class="exam__matching">
                <h4>5 Câu hỏi ghép thẻ</h4>
    
                <div class="exam__matching__detail">

                    <div class="exam__matching__answer">
                        @for ($i = 5; $i < 10; $i++)
                            <div class="answer__detail">
                                <span>{{ $i }}.
                                <input type="text">
                                <span>{{ $cards[$i]->front }}</span>
                            </div>
                        @endfor
                    </div>

                    <div class="exam__matching__question">
                        @for ($i = 5; $i < 10; $i++)
                            <p><span style="font-weight: bold">A.</span> {{ $cards[$i]->back }}</p>
                        @endfor
                    </div>

                </div>

            </div>

            {{-- Selection --}}
            <div class="exam__selection">
                <h4>5 Câu hỏi lựa chọn</h4>
    
                <div class="exam__selection__detail">

                    @for ($i = 10; $i < 15; $i++)
                        <div class="exam__selection__question">
                            <p><span style="font-weight: bold">1. </span> {{ $cards[$i]->front }}</p>
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

            {{-- Choose / False --}}
            <div class="exam__choofal">
                <h4>5 Câu hỏi Đúng/Sai</h4>
    
                <div class="exam__choofal__detail">
                    @for ($i = 15; $i < 20; $i++)
                        <div class="exam__choofal__question">
                            <p><span style="font-weight: bold">1. </span> {{ $cards[$i]->front }} -> {{ $cards[$i]->back }}</p>
                        </div>

                        <div class="exam__choofal__answer">
                            <input type="radio" name="choofal_answer">
                            <span>Đúng</span>
                            <br>
                            <input type="radio" name="choofal_answer">
                            <span>Sai</span>
                        </div>
                    @endfor
                </div>

            </div>

            <button class="btn btn--show-answer">Đáp án</button>
        </div>
    </div>
@endsection