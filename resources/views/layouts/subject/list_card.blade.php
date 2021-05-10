<div class="show-card__list">
    <div class="container">
        <div class="show-card__list__title">
            <p>Thuật ngữ trong học phần này ({{ $cards->count() }})</p>
        </div>

        <div class="show-card__list__test">
            @foreach ($cards as $card)
                {{-- <div class="show-card__list__item row justify-content-between"> --}}
                <div class="show-card__list__item">
                    <div class="row justify-content-between">
                        <div class="show-card__item--detail col-9">
                            <div>
                                <p class="font col-4">{{ $card->front }}</p>
                                <p class="back col-6">{{ $card->back }}</p>
                            </div>
    
                            <div class="row">
                                <input class="col-5 ml-4" type="text" name="front" id="{{ $card->front }}">
                                <input class="col-5 ml-5" type="text" name="back" id="{{ $card->back }}">
                                <input type="hidden" name="cardUpdateId" value="{{ $card->id }}">
                            </div>
                        </div>
                        
                        <div class="btn_function col-3 justify-content-center">
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