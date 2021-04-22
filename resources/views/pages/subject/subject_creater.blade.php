@extends('layouts.master')

@section('title', 'create_subject')

@section('content')
    <div class="subject_creater">
        <div class="container">
            {{-- Subject Creater Title --}}
            <div class="subject_creater__title">
                <h3>Tạo học phần mới</h3>
            </div>

            {{-- Form Subject --}}
            <form action="" class="form_creater">
                <div class="form-group">
                    <input type="text" class="form-control" 
                            id="subject_title" name="subject_title" placeholder="Nhập tiêu đề">
                    <label for="subject_title">tiêu đề</label>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" 
                            id="subject_des" name="subject_des" placeholder="Thêm mô tả">
                    <label for="subject_title">mô tả</label>
                </div>

                <div class="form-group">
                    <select class="form-control" name="subject_folder" id="subject_folder">
                        <option disabled="disabled" selected="selected">Thư mục</option>
                        <option value="1">folder 1</option>
                        <option value="2">folder 2</option>
                    </select>
                    <label for="subject_folder">chọn thư mục</label>
                </div>
            </form>
        </div>
      
        <div class="card_creater container">
            <div>
                {{-- <form action="" class="row form_creater card_creater__item">
                    <div class="form-group col">
                        <input type="text" class="form-control" id="card_front" name="card_front">
                        <label for="card_front">Thuật ngữ</label>
                    </div>

                    <div class="form-group col">
                        <input type="text" class="form-control" id="card_back" name="card_back">
                        <label for="card_back">Định nghĩa</label>
                    </div>
                </form> --}}

                <form action="" class="row form_creater card_creater__item">
                    <div class="form-group col">
                        {{-- <input type="text" class="form-control" id="card_front" name="card_front"> --}}
                        <textarea class="form-control" id="card_front" name="card_front"></textarea>
                        <label for="card_front">Thuật ngữ</label>
                    </div>

                    <div class="form-group col">
                        {{-- <input type="text" class="form-control" id="card_back" name="card_back"> --}}
                        <textarea class="form-control" id="card_front" name="card_front"></textarea>
                        <label for="card_back">Định nghĩa</label>
                    </div>
                </form>

                {{-- <form action="" class="row form_creater card_creater__item">
                    <div class="form-group col">
                        <input type="text" class="form-control" id="card_front" name="card_front">
                        <label for="card_front">Thuật ngữ</label>
                    </div>

                    <div class="form-group col">
                        <input type="text" class="form-control" id="card_back" name="card_back">
                        <label for="card_back">Định nghĩa</label>
                    </div>
                </form>

                <form action="" class="row form_creater card_creater__item">
                    <div class="form-group col">
                        <input type="text" class="form-control" id="card_front" name="card_front">
                        <label for="card_front">Thuật ngữ</label>
                    </div>

                    <div class="form-group col">
                        <input type="text" class="form-control" id="card_back" name="card_back">
                        <label for="card_back">Định nghĩa</label>
                    </div>
                </form>

                <div class="btn-add">
                    <button type="button">+ thêm thẻ</button>
                </div> --}}
                
            </div>

        </div>
    </div>
@endsection