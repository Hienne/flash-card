@extends('layouts.master')

@section('title', 'Kiểm tra')

@section('content')

    <div class="writing-container">
        <div class="container">
            <div class="row justify-content-around">
                <section class="right__writing col-2">
                
                    <div class="right__writing__back">
                        <a href="#"><i class="fa fa-chevron-left"></i>Trở về</a>
                    </div>

                    <hr>
        
                    <div class="right__writing__title">
                        <h5>Viết</h5>
                    </div>
        
                    <div class="right__writing__range">
                        <div class="writing__range__item">
                            <div class="progress rest__range">
                                <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="writing__range--status row justify-content-between">
                                <p>Còn lại</p>
                                <p>32</p>
                            </div>
                        </div>

                        <div class="writing__range__item">
                            <div class="progress wrong__range">
                                <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="writing__range--status row justify-content-between">
                                <p>Sai</p>
                                <p>32</p>
                            </div>
                        </div>

                        <div class="writing__range__item">
                            <div class="progress true__range">
                                <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="writing__range--status row justify-content-between">
                                <p>Đúng</p>
                                <p>32</p>
                            </div>
                        </div>
                    </div>
                </section>
        
                <section class="study__writing col-9">
        
                    <div class="study__writing__question row justify-content-between ml-1">
                        <div class="question__container">
                            <p>Định nghĩa</p>
                        </div>

                        <button class="btn btn--unknow">Không biết</button>
                    </div>
                    
                    <hr>

                    <div class="study__writing__answer">
                        <div class="answer__container row justify-content-between">
                            <div class="form-group col-9">
                                <input class="form-control" type="text" id="">
                                <label class="form-label">Nhập đáp án</label>
                            </div>
                            
                            <button class="btn btn--writing-answer col-2">Đáp án</button>
                        </div>
                    </div>

                    <div class="show__answer">
                        <div class="writing__question">
                            <p class="show__answer--lable">Câu hỏi</p>
                            <p>Định nghĩa</p>
                        </div>

                        <hr>

                        <div class="writing__answer row justify-content-between align-items-center">
                            <div>
                                <p class="show__answer--lable">Đúng</p>
                                <p>Thuật ngữ</p>
                            </div>
                            
                            <button type="button" class="btn--speak"><i class="fa fa-volume-up"></i></button>
                        </div>
                        
                        <div class="mx-auto">
                            <button class="btn btn--continue">Tiếp tục</button>
                        </div>
                        

                    </div>
        
                </section>
            </div>
        </div>
    </div>

@endsection