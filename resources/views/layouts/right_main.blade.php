<!-- Right Main -->
<ul class="navbar-nav right-main col-2" active>
    <li class="nav-item right-main__item">
      <div class="right-main__item--bg">
        <a href="#"><i style="padding-right: 0.5rem" class="fa fa-home"></i> {{ __('app.home') }}</a>
      </div>
    </li>
    <li class="nav-item right-main__item">
      <div class="right-main__item--bg">
        <a href="{{ route('library') }}"><i style="padding-right: 0.5rem" class="fa fa-copy"></i> {{ __('app.subject') }}</a>
      </div>
    </li>
    <li class="nav-item right-main__item">
      <div class="right-main__item--bg">
        <a href="{{ route('library') }}"><i style="padding-right: 0.5rem" class="fa fa-folder"> </i> {{ __('app.folder') }}</a>
      </div>
      <div class="right-main__sub">
        @foreach ($folders = Auth::user()->folders()->get()->except(1) as $folder)
          <div class="right-main__item--bg"><a href="{{ route('library') }}">{{ $folder->name }} ({{ $expiryCardsByFolder[$folder->id] }} {{ __('app.due_card') }})</a></div>
        @endforeach
      </div>
    </li>
  </ul>