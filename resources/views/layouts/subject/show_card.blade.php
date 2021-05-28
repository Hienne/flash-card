<div id="card_slider" class="show-card__left col-6 carousel slide" data-ride="carousel">
                
    <ul class="carousel-indicators">
      <li data-target="#card_slider" data-slide-to="0" class="active"></li>
      <li data-target="#card_slider" data-slide-to="1"></li>
      <li data-target="#card_slider" data-slide-to="2"></li>
      <li data-target="#card_slider" data-slide-to="3"></li>
    </ul>

    <div class="carousel-inner">

      <div class="show-card__card carousel-item active">
        <div class="show-card__inner">
          <div class="card--front">
            <?php echo  html_entity_decode($cards->first()->front); ?>
          </div>
          <div class="card--back">
            <?php echo  html_entity_decode($cards->first()->back); ?>
          </div>
        </div>
      </div>
        
      @foreach ($cards->take(1-$cards->count()) as $card)
        <div class="show-card__card carousel-item">
          <div class="show-card__inner">
            <div class="card--front">
              <?php echo  html_entity_decode($card->front); ?>
            </div>
            <div class="card--back">
              <?php echo  html_entity_decode($card->back); ?>
            </div>
          </div>
        </div>
      @endforeach

    </div>
    

    <a class="carousel-control-prev" style="width: 10%;" href="#card_slider" data-slide="prev">
      <i class="fa fa-caret-left"></i>
    </a>
    <a class="carousel-control-next" style="width: 10%;" href="#card_slider" data-slide="next">
      <i class="fa fa-caret-right"></i>
    </a>

</div>