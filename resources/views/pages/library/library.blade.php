@extends('layouts.master')

@section('title', 'library')

@section('content')
    <div class="library container">
        {{-- Title --}}
        <div class="library__title">
            <span class="user_logo logo_size">{{ strtoupper(Auth::user()->name[0]) }}</span>
            <h3>hienne99</h3>
        </div>

        {{-- List Item --}}
        <div class="library__list__item">
            <button class="tablinks active border_bottom" data-electronic="subject">{{ __('app.subject') }}</button>
            
            <button class="tablinks border_bottom" data-electronic="folder">{{ __('app.folder') }}</button>
        </div>
    </div>

    {{-- Detail --}}
    <div class="library__detail">
        <div class="library_wrapper">
            
            <div id="subject" class="container tabcontent active">
                <!-- Form search -->
                <form action="{{ route('library.search_subject') }}" method="GET">
                @csrf
                    <div class="form-group has-search">
                        <span class="fa fa-search form-control-feedback"></span>
                        <input type="text" name="subject_keyword" class="form-control" placeholder="Search">
                    </div>
                </form>

                <div  class="library__item">
                    @foreach ($subjects as $subject)
                        <a href="{{ route('subject', ['id'=>$subject->id]) }}" class="library__item__detail">
                            <div>
                                <div class="item__detail__title">
                                    <p>{{ $subject->cards()->count() }} {{ __('app.term') }}</p>
                                    <span class="user_logo logo_size">{{ strtoupper($subject->maker[0]) }}</span>
                                    <h3>{{ $subject->maker }}</h3>
                                </div>
        
                                <div class="item__detail__name">
                                    <h2>{{ $subject->name }}</h2>
                                </div>
                            </div>
                            

                            {{-- <ul class="subject_utitlity__item">
                                <li>
                                    
                                    <form action="{{ route('shared_subject.add') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="subjectId" value="{{ $subject->id }}">
                    
                                        <button type="submit" data-toggle="tooltip" data-placement="bottom" data-html="true" title="Thêm">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </form>
                                </li>
                            <li> --}}
                                {{-- <button type="button" class="btn btn--dropdown" data-toggle="modal" data-target="#deleteSubject">
                                    <i style="padding-right: 0.5rem" class="fa fa-trash"></i>
                                </button> --}}
                                {{-- <form action="{{ route('subject.delete') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="subjectId" value="{{ $subject->id }}">
                
                                    <button type="submit" data-toggle="tooltip" data-placement="bottom" data-html="true" title="Xóa">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </li>
                        </ul> --}}
                        </a>
                    @endforeach

                    {{ $subjects->links() }}
                </div>
            </div>

            <div id="folder" class="container tabcontent">
                <!-- Form search -->
                <form action="{{ route('library.search_folder') }}" method="GET">
                @csrf
                    <div class="form-group has-search">
                        <span class="fa fa-search form-control-feedback"></span>
                        <input type="text" name="folder_keyword" class="form-control" placeholder="Search">
                    </div>
                </form>

                <div  class="library__item">
                    @foreach ($folders as $folder)
                        {{-- <a href="#" class="library__item__detail"> --}}
                        <div class="library__item__detail">
                            <div>
                                <div class="item__detail__title">
                                    <p>{{ $folder->subjects->count() }} {{ __('app.subject') }}</p>
                                </div>
            
                                <div class="item__detail__name">
                                    <i style="padding-right: 0.5rem" class="fa fa-folder"> </i><h2>{{ $folder->name }}</h2>
                                </div>
                            </div>
                            
                            <ul class="subject_utitlity__item">
                                <li>
                                    <form action="{{ route('shared_subject.add') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="subjectId" value="{{ $subject->id }}">
                    
                                        <button type="submit" data-toggle="tooltip" data-placement="bottom" data-html="true" title="Thêm">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </form>
                                </li>
                            <li>
                                <button type="button" class="btn btn--dropdown btn--updateFolder" data-toggle="modal" data-target="#deleteFolder">
                                    <i style="padding-right: 0.5rem" class="fa fa-trash"></i>
                                </button>
                                {{-- <div class="modal" tabindex="-1" role="dialog" id="deleteFolder">
                                    <form action="{{ route('folder.delete') }}" method="post">
                                        @csrf
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header test">
                                                    <h5 class="modal-title">Bạn có chắc chắn muốn xóa thư mục này?</h5>
                                                    <input type="hidden" name="folderId" value="{{ $folder->id }}">
                                                    <button style="color: black;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-footer">
                                                    <button style="color: black;" type="submit" class="btn btn-secondary" data-dismiss="modal">OK</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    
                                </div> --}}
                                {{-- <form action="{{ route('subject.delete') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="subjectId" value="{{ $subject->id }}">
                
                                    <button type="submit" data-toggle="tooltip" data-placement="bottom" data-html="true" title="Xóa">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form> --}}
                            </li>
                        </ul>
                        {{-- </a> --}}
                    </div>

                    @endforeach

                    {{ $folders->links() }}
                </div>
            </div>

        </div>
    </div>

    <!-- Delete Subject Modal -->
    <div class="modal" tabindex="-1" role="dialog" id="deleteFolder">
        <form action="{{ route('folder.delete') }}" method="post">
            @csrf
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header test">
                        <h5 class="modal-title">Bạn có chắc chắn muốn xóa thư mục này?</h5>
                        <input type="hidden" name="folderId" value="3">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-footer">
                        <button type="Submit" class="btn btn-secondary" data-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </form>
        
    </div>
    
@endsection

@section('script')
    <script>
        var tabLinks = document.querySelectorAll(".tablinks");
        var tabContent = document.querySelectorAll(".tabcontent")

        tabLinks.forEach(el => {
            el.addEventListener("click", openTabs);
        });

        function openTabs(el) {
            var btn = el.currentTarget;
            var electronic = btn.dataset.electronic;

            tabContent.forEach(el => {
                el.classList.remove("active");
            });

            tabLinks.forEach(el => {
                el.classList.remove("active");
            });

            document.querySelector("#" + electronic).classList.add("active");

            btn.classList.add("active");
        }

    </script>
@endsection