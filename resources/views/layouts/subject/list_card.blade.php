<div class="show-card__list">
    <div class="container">
        <div class="show-card__list__title">
            <p>Thuật ngữ trong học phần này ({{ $cards->count() }})</p>
        </div>

        <div class="show-card__list__test">
            @foreach ($cards as $card)
                <div class="show-card__list__item row justify-content-between">
                    <p class="font col-4">{{ $card->front }}</p>
                    <p class="back col-6">{{ $card->back }}</p>
                    <p class="col-1"><i class="fa fa-volume-up"></i></p>
                </div>
            @endforeach
        </div>
    </div>
</div>