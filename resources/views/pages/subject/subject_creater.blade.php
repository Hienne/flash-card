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

                <form action="" class="row form_creater card_creater__item">
                    <div class="form-group col">
                        <textarea class="form-control resize-ta" 
                                id="card_front" name="card_front" rows="1">
                        </textarea>

                        <label for="card_front">Thuật ngữ</label>
                    </div>

                    <div class="form-group col">
                        <textarea class="form-control resize-ta"
                                id="card_front" name="card_front" rows="1">
                        </textarea>

                        <label for="card_back">Định nghĩa</label>
                    </div>
                </form>

                <form action="" class="row form_creater card_creater__item">
                    <div class="form-group col">
                        <textarea class="form-control resize-ta" 
                                id="card_front" name="card_front" rows="1">
                        </textarea>

                        <label for="card_front">Thuật ngữ</label>
                    </div>

                    <div class="form-group col">
                        <textarea class="form-control resize-ta"
                                id="card_front" name="card_front" rows="1">
                        </textarea>

                        <label for="card_back">Định nghĩa</label>
                    </div>
                </form>
                
                <form action="" class="row form_creater card_creater__item">
                    <div class="form-group col">
                        <textarea class="form-control resize-ta" 
                                id="card_front" name="card_front" rows="1">
                        </textarea>

                        <label for="card_front">Thuật ngữ</label>
                    </div>

                    <div class="form-group col">
                        <textarea class="form-control resize-ta"
                                id="card_front" name="card_front" rows="1">
                        </textarea>

                        <label for="card_back">Định nghĩa</label>
                    </div>
                </form>

                <form action="" class="row form_creater card_creater__item">
                    <div class="form-group col">
                        <textarea class="form-control resize-ta" 
                                id="card_front" name="card_front" rows="1">
                        </textarea>

                        <label for="card_front">Thuật ngữ</label>
                    </div>

                    <div class="form-group col">
                        <textarea class="form-control resize-ta"
                                id="card_front" name="card_front" rows="1">
                        </textarea>

                        <label for="card_back">Định nghĩa</label>
                    </div>
                </form>

                <div class="btn-add">
                    <button type="button">+ thêm thẻ</button>
                </div>
                
            </div>

            <div class="btn--create--wrapper">
                <button class="btn btn--create">Tạo</button>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function calcHeight(value) {
            let numberOfLineBreaks = (value.match(/\n/g) || []).length;
            let newHeight = 30 + numberOfLineBreaks * 20 + 12 +2;
            return newHeight;
        }

        let textareas = document.querySelectorAll(".resize-ta");
        for (let ta of textareas) {
            ta.addEventListener("keyup", () => {
                ta.style.height = calcHeight(ta.value) + "px";
            });
        }
    </script>
@endsection