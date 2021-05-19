@extends('layouts.master')

@section('title', 'create_subject')

@section('content')
<form action="{{ route('subject.create') }}" method="POST">
@csrf
    <div class="subject_creater">
        <div class="container">
            {{-- Subject Creater Title --}}
            <div class="subject_creater__title">
                <h3>{{ __('app.create_subject') }}</h3>
            </div>

            {{-- Form Subject --}}
            <div class="form_creater">
                <div class="form-group">
                    <input type="text" class="form-control" 
                            id="subject_title" name="subject_title" placeholder="{{ __('app.enter_title') }}">

                    @if ($errors->has('subject_title'))
                        <label for="subject_title" class="text-danger">{{ $errors->first('subject_title') }}</label>
                    @else
                        <label for="subject_title">{{ __('app.title') }}</label>
                    @endif
                            
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" 
                            id="subject_des" name="subject_des" placeholder="{{ __('app.add_des') }}">
                    <label for="subject_des">{{ __('app.des') }}</label>
                </div>

                <div class="form-group">
                    <select class="form-control" name="subject_folder" id="subject_folder">
                        <option disabled="disabled" selected="selected">{{ __('app.folder') }}</option>
                        @foreach ($folders = Auth::user()->folders()->get()->except(1) as $folder)
                            <option value="{{ $folder->id }}">{{ $folder->name }}</option>
                        @endforeach
                    </select>
                    <label for="subject_folder">{{ __('app.select_folder') }}</label>
                </div>
            </div>
        </div>

        <div class="card_creater container">
            <div id="card_creater__container">

                <div class="card_creater__item">
                    <div class="card_creater_feature">
                        <button class="btn_delete disabled" disabled="true">
                            <i class="fa fa-trash"></i>
                            <span class="tooltiptext">{{ __('app.delete_card') }}</span>
                        </button>
                    </div>

                    <div class="row form_creater">
                        <div class="form-group col">
                            <textarea class="form-control resize-ta" 
                                    id="card_backs" name="card_backs[]" rows="1">
                            </textarea>
    
                            @if ($errors->has('card_backs.*'))
                                <label for="card_fronts" class="text-danger">{{ $errors->first('card_backs.*') }}</label>
                            @else
                                <label for="card_backs">{{ __('app.term') }}</label>
                            @endif
                        </div>
    
                        <div class="form-group col">
                            <textarea class="form-control resize-ta"
                                    id="card_fronts" name="card_fronts[]" rows="1">
                            </textarea>
    
                            @if ($errors->has('card_backs.*'))
                                <label for="card_fronts" class="text-danger">{{ $errors->first('card_fronts.*') }}</label>
                            @else
                                <label for="card_fronts">{{ __('app.definition') }}</label>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="card_creater__item">
                    <div class="card_creater_feature">
                        <button class="btn_delete disabled" disabled="true">
                            <i class="fa fa-trash"></i>
                            <span class="tooltiptext">{{ __('app.delete_card') }}</span>
                        </button>
                    </div>

                    <div class="row form_creater">
                        <div class="form-group col">
                            <textarea class="form-control resize-ta" 
                                    id="card_backs" name="card_backs[]" rows="1">
                            </textarea>
    
                            @if ($errors->has('card_fronts.*'))
                                <label for="card_backs" class="text-danger">{{ $errors->first('card_backs.*') }}</label>
                            @else
                                <label for="card_backs">{{ __('app.term') }}</label>
                            @endif
                        </div>
    
                        <div class="form-group col">
                            <textarea class="form-control resize-ta"
                                    id="card_fronts" name="card_fronts[]" rows="1">
                            </textarea>
    
                            @if ($errors->has('card_backs.*'))
                                <label for="card_fronts" class="text-danger">{{ $errors->first('card_fronts.*') }}</label>
                            @else
                                <label for="card_fronts">{{ __('app.definition') }}</label>
                            @endif
                        </div>
                    </div>
                </div>
                
            </div>

            <div class="btn-add">
                <a type="button" id="btn_addCardForm">+ {{ __('app.add_card') }}</a>
            </div>

            <div class="btn--create--wrapper">
                <button type="submit" class="btn btn--create">{{ __('app.create') }}</button>
            </div>
        </div>
    </div>
</form>
@endsection

@section('script')
    <script>

        var test = document.querySelectorAll('.card_creater__item');

        //text area auto grow
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

        // check remove
        function checkNumOfForm() {
            btnDelete = document.querySelectorAll(".btn_delete");

            if (btnDelete.length > 2)
            {
                for (let btn of btnDelete) {
                    btn.disabled = false;
                    btn.classList.remove('disabled');
                }
            }

            else {
                for (let btn of btnDelete) {
                    btn.disabled = true;
                    btn.classList.add('disabled');
                }
            }
        }

        //create new card creater form
        var cardCreaterContainer = document.querySelector("#card_creater__container");
        var btnAddCardForm = document.querySelector("#btn_addCardForm");

        function addCardForm() {
            let div = createForm();
            cardCreaterContainer.appendChild(div);

            // check num of form
            checkNumOfForm();

            //update list btn_delete
            btnDelete = document.querySelectorAll(".btn_delete");

            for (let btn of btnDelete) {
                btn.addEventListener('click', deleteForm);
            }
        }

        function createForm() {

            let div = document.createElement('div');
            div.classList.add("card_creater__item");
            div.innerHTML = `<div class="card_creater_feature">
                        <button class="btn_delete">
                            <i class="fa fa-trash"></i>
                            <span class="tooltiptext">{{ __('app.delete_card') }}</span>
                        </button>
                    </div>

                    <div class="row form_creater">
                        <div class="form-group col">
                            <textarea class="form-control resize-ta" 
                                    id="card_backs" name="card_backs[]" rows="1">
                            </textarea>
    
                            @if ($errors->has('card_backs.*'))
                                <label for="card_backs" class="text-danger">{{ $errors->first('card_backs.*') }}</label>
                            @else
                                <label for="card_backs">{{ __('app.term') }}</label>
                            @endif
                        </div>
    
                        <div class="form-group col">
                            <textarea class="form-control resize-ta"
                                    id="card_fronts" name="card_fronts[]" rows="1">
                            </textarea>
    
                            @if ($errors->has('card_fronts.*'))
                                <label for="card_fronts" class="text-danger">{{ $errors->first('card_fronts.*') }}</label>
                            @else
                                <label for="card_fronts">{{ __('app.definition') }}</label>
                            @endif
                        </div>
                    </div>`

            return div;
        }

        btnAddCardForm.addEventListener('click', addCardForm);

        // Remove card creater form
        var btnDelete = document.querySelectorAll(".btn_delete");

        function deleteForm() {
            this.parentNode.parentNode.remove();
            
            checkNumOfForm();
        }

        for (let btn of btnDelete) {
            btn.addEventListener('click', deleteForm);
        }

    </script>
@endsection