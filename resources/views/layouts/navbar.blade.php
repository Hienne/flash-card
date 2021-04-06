<nav class="navbar navbar-expand-lg navbar-expand">
    <!-- Brand -->
    <a class="navbar-brand logo" href="#">Flash-Card</a>
  
    <!-- Left Nav -->
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="#">Trang chủ</a>
      </li>

      @auth
        <!-- Dropdown  Folder-->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
          Thư mục
        </a>
        <div class="dropdown-menu">
          <a class="dropdown-item dropdown__item--size" href="#">Thư mục 1</a>
          <a class="dropdown-item dropdown__item--size" href="#">Thư mục 2</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item dropdown__item--size" href="#">Tất cả thư mục</a>
        </div>
      </li>

      <!-- Dropdown Subject-->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
          Học phần
        </a>
        <div class="dropdown-menu">
          <a class="dropdown-item dropdown__item--size" href="#">Học phần 1</a>
          <a class="dropdown-item dropdown__item--size" href="#">Học phần 2</a>
          <a class="dropdown-item dropdown__item--size" href="#">Học phần 3</a>
          <a class="dropdown-item dropdown__item--size" href="#">Học phần 4</a>
          <a class="dropdown-item dropdown__item--size" href="#">Học phần 5</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item dropdown__item--size" href="#">Tất cả học phần</a>
        </div>
      </li>
      @endauth
  
      <!-- Dropdown -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
          Tạo
        </a>
        <div class="dropdown-menu">
          <a class="dropdown-item dropdown__item--size" href="#"><i style="padding-right: 0.5rem" class="fa fa-folder"> </i>Thư mục</a>
          <a class="dropdown-item dropdown__item--size" href="#"><i style="padding-right: 0.5rem" class="fa fa-copy"></i> Học phần</a>
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
          <a class="nav-link" href="#">Hien</a>
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