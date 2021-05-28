<div class="show-card__list">
    <div class="container">
        <div class="show-card__list__title">
            <p>{{ __('app.term_in_subject') }} ({{ $cards->count() }})</p>
        </div>

        <div class="show-card__list__test">
            @foreach ($cards as $card)
                <div class="show-card__list__item">
                    <div class="row justify-content-between align-items-center">
                        <div class="show-card__item--detail col-10">
                            <div class="row justify-content-center">
                                <div class="font col-5 d-flex flex-column justify-content-center align-items-center">
                                    <?php echo  html_entity_decode($card->front); ?>
                                </div>
                                <div class="back col-5 d-flex flex-column justify-content-center align-items-center">
                                    <?php echo  html_entity_decode($card->back); ?>
                                </div>
                            </div>
                            
                            <div class="test">
                                <form action="{{ route('subject.card.update', ['id'=>$card->id]) }}" method="POST" class="form--update-card un-display">
                                    @method('PUT')
                                    @csrf
                                    <textarea class="update_editor" type="text" name="front" placeholder="{{ __('app.input_defi') }}">{{ $card->front }}</textarea>
                                    @if ($errors->has('front'))
                                        <label for="front" class="text-danger">{{ $errors->first('front') }}</label>
                                    @endif
                                    <textarea class="mt-2 update_editor" type="text" name="back" placeholder="{{ __('app.input_term') }}">{{ $card->back }}</textarea>
                                    @if ($errors->has('back'))
                                        <label for="backp" class="text-danger">{{ $errors->first('back') }}</label>
                                    @endif
                                    <button class="mt-3">Sửa</button>
                                </form>
                            </div>
                            
                        </div>
                        
                        <div class="btn_function col-2 justify-content-center">
                            <button type="button" class="btnSpeak"><i class="fa fa-volume-up"></i></button>

                            <button type="submit" class="btn--update"><i class="fa fa-pencil"></i></button>

                            <form action="{{ route('subject.card.delete') }}" method="post">
                                @csrf
                                <input type="hidden" name="cardDeleteId" value="{{ $card->id }}">
                                <input type="hidden" name="sujectDeleteId" value="{{ $subject->id }}">
                                <button type="submit" class="btn--delete"><i class="fa fa-trash"></i></button>
                            </form>
                            
                        </div>
                    </div>
                </div>

            @endforeach
        </div>
    </div>
</div>