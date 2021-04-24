<nav class="navbar navbar-expand-lg navbar-expand">
    <!-- Brand -->
    <a class="navbar-brand logo" href="{{ route('home') }}">Flash-Card</a>
  
    <!-- Left Nav -->
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="{{ route('home') }}">Trang chủ</a>
      </li>

      @auth
        <!-- Dropdown  Folder-->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
          Thư mục
        </a>
        <div class="dropdown-menu">
          @foreach ($folders = Auth::user()->folders()->get()->except(1) as $folder)
            <a class="dropdown-item dropdown__item--size" href="#">{{ $folder->name }}</a>
          @endforeach
          <div class="dropdown-divider"></div>
          <a class="dropdown-item dropdown__item--size" href="{{ route('library') }}">Tất cả thư mục</a>
        </div>
      </li>

      <!-- Dropdown Subject-->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
          Học phần
        </a>
        <div class="dropdown-menu">
          @foreach ($subjects = Auth::user()->subjects()->get() as $subject)
            <a class="dropdown-item dropdown__item--size" href="{{ route('subject', ['id'=>$subject->id]) }}">{{ $subject->name }}</a>
          @endforeach
          <div class="dropdown-divider"></div>
          <a class="dropdown-item dropdown__item--size" href="{{ route('library') }}">Tất cả học phần</a>
        </div>
      </li>
      @endauth
  
      <!-- Dropdown -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle dropdown--create" href="#" id="navbardrop" data-toggle="dropdown">
          Tạo
        </a>
        <div class="dropdown-menu">
          <a class="dropdown-item dropdown__item--size" href="#"><i style="padding-right: 0.5rem" class="fa fa-folder"> </i>Thư mục</a>
          <a class="dropdown-item dropdown__item--size" href="{{ route('subject.createIndex') }}"><i style="padding-right: 0.5rem" class="fa fa-copy"></i> Học phần</a>
        </div>
      </li>
    </ul>

    <!-- Form search -->
    <form class="form-inline my-2 my-lg-0">
      <div class="input-group">
        <div  class="input-group-prepend">
          <button class="btn btn--search" type="button"><i class="fa fa-search"></i></button>
        </div>
        <input type="text" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">
      </div>
    </form>

    <!-- Right Nav -->
    <ul class="navbar-nav">
      @auth
        <li class="nav-item">
          <a class="nav-link" href="#">{{ Auth::user()->name }}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('logout') }}">Đăng xuất</a>
        </li>
      @endauth

      @guest
        <li class="nav-item">
          <a class="nav-link" href="{{ route('login') }}">Đăng nhập</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('register') }}">Đăng ký</a>
        </li>
      @endguest
    </ul>
  </nav>