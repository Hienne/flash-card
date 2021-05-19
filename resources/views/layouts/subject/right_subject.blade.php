<ul class="show-card__right navbar-nav col-2">
    <li class="nav-item show-card__right--bg">
        @if (count($expiryCards) > 0)
            <a href="{{ route('studying', ['id'=>$subject->id]) }}"><i style="color: rgb(66, 87, 178)" class="fa fa-undo"></i> {{ __('app.study') }}</a>    
        @else
            <a href="#" disabled><i class="fa fa-undo"></i> {{ __('app.no_due_card') }}</a>
        @endif
        
    </li>

    <li class="nav-item show-card__right--bg">
        <a href="{{ route('studying.writing', ['id'=>$subject->id]) }}"><i style="color: rgb(66, 87, 178)" class="fa fa-pencil"></i> {{ __('app.write') }}</a>
    </li>

    <li class="nav-item show-card__right--bg">
        <a href="{{ route('studying.listening', ['id'=>$subject->id]) }}"><i style="color: rgb(66, 87, 178)" class="fa fa-volume-up"></i> {{ __('app.spell') }}</a>
    </li>

    <li class="nav-item show-card__right--bg">
        <a href="{{ route('studying.exam', ['id'=>$subject->id]) }}"><i style="color: rgb(66, 87, 178)" class="fa fa-file"></i> {{ __('app.exam') }}</a>
    </li>
</ul>