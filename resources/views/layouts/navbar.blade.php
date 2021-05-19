<nav class="navbar navbar-expand-lg navbar-expand">
    <!-- Brand -->
    <a class="navbar-brand logo" href="{{ route('home') }}">Flash-Card</a>
  
    <!-- Left Nav -->
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="{{ route('home') }}">{{ __('app.home') }}</a>
      </li>

      @auth
        <!-- Dropdown  Folder-->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
          {{ __('app.folder') }}
        </a>
        <div class="dropdown-menu">
          @foreach ($folders = Auth::user()->folders()->get()->except(1) as $folder)
            <a class="dropdown-item dropdown__item--size" href="#">{{ $folder->name }}</a>
          @endforeach
          <div class="dropdown-divider"></div>
          <a class="dropdown-item dropdown__item--size" href="{{ route('library') }}">{{ __('app.all_folder') }}</a>
        </div>
      </li>

      <!-- Dropdown Subject-->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
          {{ __('app.subject') }}
        </a>
        <div class="dropdown-menu">
          @foreach ($subjects = Auth::user()->subjects()->get() as $subject)
            <a class="dropdown-item dropdown__item--size" href="{{ route('subject', ['id'=>$subject->id]) }}">{{ $subject->name }}</a>
          @endforeach
          <div class="dropdown-divider"></div>
          <a class="dropdown-item dropdown__item--size" href="{{ route('library') }}">{{ __('app.all_subject') }}</a>
        </div>
      </li>
      @endauth
  
      <!-- Dropdown -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle dropdown--create" href="#" id="navbardrop" data-toggle="dropdown">
          {{ __('app.create') }}
        </a>
        <div class="dropdown-menu">
          <!-- Button to Open the Modal -->
          <div class="dropdown-item dropdown__item--size">
            <button type="button" class="btn btn--dropdown" data-toggle="modal" data-target="#folderForm">
              <i style="padding-right: 0.5rem" class="fa fa-folder"> </i>{{ __('app.folder') }}
            </button>
          </div>

          <a class="dropdown-item dropdown__item--size" href="{{ route('subject.createIndex') }}"><i style="padding-right: 0.5rem" class="fa fa-copy"></i> {{ __('app.subject') }}</a>
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

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
          {{ __('app.language') }}
        </a>
        <div class="dropdown-menu">
          <a class="dropdown-item dropdown__item--size" href="{{ url('locale/en') }}">{{ __('app.en') }}</a>
          <a class="dropdown-item dropdown__item--size" href="{{ url('locale/vn') }}">{{ __('app.vn') }}</a>
        </div>
      </li>

      @auth
        <li class="nav-item">
          <a class="nav-link" href="#">{{ Auth::user()->name }}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('logout') }}">{{ __('app.logout') }}</a>
        </li>
      @endauth

      @guest
        <li class="nav-item">
          <a class="nav-link" href="{{ route('login') }}">{{ __('app.login') }}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('register') }}">{{ __('app.register') }}</a>
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