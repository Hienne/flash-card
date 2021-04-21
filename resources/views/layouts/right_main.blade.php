<!-- Right Main -->
<ul class="navbar-nav right-main col-2" active>
    <li class="nav-item right-main__item">
      <div class="right-main__item--bg">
        <a href="#"><i style="padding-right: 0.5rem" class="fa fa-home"></i> Trang chủ</a>
      </div>
    </li>
    <li class="nav-item right-main__item">
      <div class="right-main__item--bg">
        <a href="{{ route('library') }}"><i style="padding-right: 0.5rem" class="fa fa-copy"></i> Học phần</a>
      </div>
    </li>
    <li class="nav-item right-main__item">
      <div class="right-main__item--bg">
        <a href="{{ route('library') }}"><i style="padding-right: 0.5rem" class="fa fa-folder"> </i>Thư mục</a>
      </div>
      <div class="right-main__sub">
        @foreach ($folders = Auth::user()->folders()->get()->except(1) as $folder)
          <div class="right-main__item--bg"><a href="#">{{ $folder->name }}</a></div>
        @endforeach
      </div>
    </li>
  </ul>