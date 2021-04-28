@extends('layouts.master')

@section('title', 'Kiểm tra')

@section('content')
    <div class="exam__container">
        <div class="container exam__content">

            {{-- Translate --}}
            <div class="exam__translate">
                <h4>5 Câu hỏi tự luận</h4>
    
                <div class="exam__translate__detail">

                    <div class="form-group exam__translate__question">
                        <p><span style="font-weight: bold">1.</span> Định nghĩa 1</p>
                        <input type="text" class="form-control" 
                            name="exam_translate">
                        <label for="exam_translate">nhập đáp án của bạn</label>
                    </div>

                    <div class="form-group exam__translate__question">
                        <p><span style="font-weight: bold">1.</span> Định nghĩa 1</p>
                        <input type="text" class="form-control" 
                            name="exam_translate">
                        <label for="exam_translate">nhập đáp án của bạn</label>
                    </div>

                    <div class="form-group exam__translate__question">
                        <p><span style="font-weight: bold">1.</span> Định nghĩa 1</p>
                        <input type="text" class="form-control" 
                            name="exam_translate">
                        <label for="exam_translate">nhập đáp án của bạn</label>
                    </div>

                    <div class="form-group exam__translate__question">
                        <p><span style="font-weight: bold">1.</span> Định nghĩa 1</p>
                        <input type="text" class="form-control" 
                            name="exam_translate">
                        <label for="exam_translate">nhập đáp án của bạn</label>
                    </div>

                    <div class="form-group exam__translate__question">
                        <p><span style="font-weight: bold">1.</span> Định nghĩa 1</p>
                        <input type="text" class="form-control" 
                            name="exam_translate">
                        <label for="exam_translate">nhập đáp án của bạn</label>
                    </div>
                    
                </div>
            </div>

            {{-- Matching --}}
            <div class="exam__matching">
                <h4>5 Câu hỏi ghép thẻ</h4>
    
                <div class="exam__matching__detail">

                    <div class="exam__matching__answer">
                        <div class="answer__detail">
                            <span>1.
                            <input type="text">
                            <span>định nghĩa</span>
                        </div>

                        <div class="answer__detail">
                            <span>1.
                            <input type="text">
                            <span>định nghĩa</span>
                        </div>

                        <div class="answer__detail">
                            <span>1.
                            <input type="text">
                            <span>định nghĩa</span>
                        </div>

                        <div class="answer__detail">
                            <span>1.
                            <input type="text">
                            <span>định nghĩa</span>
                        </div>

                        <div class="answer__detail">
                            <span>1.
                            <input type="text">
                            <span>định nghĩa</span>
                        </div>
                    </div>

                    <div class="exam__matching__question">
                        <p><span style="font-weight: bold">A.</span> thuật ngữ</p>
                        <p><span style="font-weight: bold">A.</span> thuật ngữ</p>
                        <p><span style="font-weight: bold">A.</span> thuật ngữ</p>
                        <p><span style="font-weight: bold">A.</span> thuật ngữ</p>
                        <p><span style="font-weight: bold">A.</span> thuật ngữ</p>
                    </div>

                </div>

            </div>

            {{-- Selection --}}
            <div class="exam__selection">
                <h4>5 Câu hỏi lựa chọn</h4>
    
                <div class="exam__selection__detail">
                    <div class="exam__selection__question">
                        <p><span style="font-weight: bold">1. </span> định nghĩa</p>
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

                    <div class="exam__selection__question">
                        <p><span style="font-weight: bold">1. </span> định nghĩa</p>
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

                    <div class="exam__selection__question">
                        <p><span style="font-weight: bold">1. </span> định nghĩa</p>
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

                    <div class="exam__selection__question">
                        <p><span style="font-weight: bold">1. </span> định nghĩa</p>
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

                    <div class="exam__selection__question">
                        <p><span style="font-weight: bold">1. </span> định nghĩa</p>
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
                
                </div>

            </div>

            {{-- Choose / False --}}
            <div class="exam__choofal">
                <h4>5 Câu hỏi Đúng/Sai</h4>
    
                <div class="exam__choofal__detail">
                    <div class="exam__choofal__question">
                        <p><span style="font-weight: bold">1. </span> định nghĩa -> thuật ngữ</p>
                    </div>

                    <div class="exam__choofal__answer">
                        <input type="radio" name="choofal_answer">
                        <span>Đúng</span>
                        <br>
                        <input type="radio" name="choofal_answer">
                        <span>Sai</span>
                    </div>

                    <div class="exam__choofal__question">
                        <p><span style="font-weight: bold">1. </span> định nghĩa -> thuật ngữ</p>
                    </div>

                    <div class="exam__choofal__answer">
                        <input type="radio" name="choofal_answer">
                        <span>Đúng</span>
                        <br>
                        <input type="radio" name="choofal_answer">
                        <span>Sai</span>
                    </div>

                    <div class="exam__choofal__question">
                        <p><span style="font-weight: bold">1. </span> định nghĩa -> thuật ngữ</p>
                    </div>

                    <div class="exam__choofal__answer">
                        <input type="radio" name="choofal_answer">
                        <span>Đúng</span>
                        <br>
                        <input type="radio" name="choofal_answer">
                        <span>Sai</span>
                    </div>

                    <div class="exam__choofal__question">
                        <p><span style="font-weight: bold">1. </span> định nghĩa -> thuật ngữ</p>
                    </div>

                    <div class="exam__choofal__answer">
                        <input type="radio" name="choofal_answer">
                        <span>Đúng</span>
                        <br>
                        <input type="radio" name="choofal_answer">
                        <span>Sai</span>
                    </div>

                    <div class="exam__choofal__question">
                        <p><span style="font-weight: bold">1. </span> định nghĩa -> thuật ngữ</p>
                    </div>

                    <div class="exam__choofal__answer">
                        <input type="radio" name="choofal_answer">
                        <span>Đúng</span>
                        <br>
                        <input type="radio" name="choofal_answer">
                        <span>Sai</span>
                    </div>
                
                </div>

            </div>

            <button class="btn btn--show-answer">Đáp án</button>
        </div>
    </div>
@endsection