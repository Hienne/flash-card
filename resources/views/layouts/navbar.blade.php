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
          <!-- Button to Open the Modal -->
          <div class="dropdown-item dropdown__item--size">
            <button type="button" class="btn btn--dropdown" data-toggle="modal" data-target="#folderForm">
              <i style="padding-right: 0.5rem" class="fa fa-folder"> </i>Thư mục
            </button>
          </div>
          

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

    {{-- Pop Up Create Folder --}}
    <!-- The Modal -->
    <div class="modal" id="folderForm">
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Tạo thư mục mới</h4>
            <button type="button" data-dismiss="modal"><i class="fa fa-times fa-2x"></i></button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <form action="{{ route('folder.create') }}" method="POST">
              @csrf
              <div class="form_creater">
                <div class="form-group">
                    <input type="text" class="form-control" 
                      id="folder_title" name="folder_title" placeholder="Nhập tiêu đề">
                      <label for="folder_title">tiêu đề</label>
                </div>

                <div class="form-group">
                  <input type="text" class="form-control" 
                  id="folder_des" name="folder_des" placeholder="Mô tả">

                  <label for="folder_des">mô tả</label>
                </div>
              </div>

              <button id="btn_create_folder" type="submit" class="btn btn--disable" disabled>Tạo thư mục</button>
            </form>

          </div>

        </div>
      </div>
    </div>
  </nav>