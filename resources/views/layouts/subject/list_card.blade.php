<div class="show-card__list">
    <div class="container">
        <div class="show-card__list__title">
            <p>{{ __('app.term_in_subject') }} ({{ $cards->count() }})</p>
        </div>

        <div class="show-card__list__test">
            @foreach ($cards as $card)
                <div class="show-card__list__item">
                    <div class="row justify-content-between">
                        <div class="show-card__item--detail col-10">
                            <div class="row justify-content-center">
                                <p class="font col-5">{{ $card->front }}</p>
                                <p class="back col-5">{{ $card->back }}</p>
                            </div>
                            
                            <div class="test">
                                <form action="{{ route('subject.card.update', ['id'=>$card->id]) }}" method="POST" class="row form--update-card un-display">
                                    @method('PUT')
                                    @csrf
                                    <input class="col-4 ml-4" type="text" name="front" value="{{ $card->front }}">
                                    <input class="col-4 ml-3" type="text" name="back" value="{{ $card->back }}">
                                    {{-- <input type="hidden" name="cardUpdateId" value="{{ $card->id }}"> --}}
                                    <button class="col-1 ml-5">Sửa</button>
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