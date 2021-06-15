<div class="subject_utility container">
    <div class="row justify-content-between align-items-center">
        <div class="subject__detail col-2">
            <p>{{ __('app.create_by') }}</p>
            <p>{{ $subject->maker }}</p>
        </div>

        <ul class="subject_utitlity__item">
            @if ($subject->user_id != auth()->user()->id)
                <li>
                    <form action="{{ route('shared_subject.add') }}" method="post">
                        @csrf
                        <input type="hidden" name="subjectId" value="{{ $subject->id }}">
    
                        <button type="submit" data-toggle="tooltip" data-placement="bottom" data-html="true" title="Thêm">
                            <i class="fa fa-plus"></i>
                        </button>
                    </form>
                </li>
            @endif
            <li>
                <a href="{{ route('subject.updateIndex', ['id'=>$subject->id]) }}"><i style="color: black;" class="fa fa-pencil"></i></a>
            </li>
            <li>

              <button type="button" class="btn btn--dropdown" data-toggle="modal" data-target="#deleteSubject">
                <i style="color: black;" class="fa fa-trash"></i>
              </button>
            </li>
        </ul>
    </div>
</div>



<!-- Modal -->
<!-- The Modal -->
<div class="modal" tabindex="-1" role="dialog" id="deleteSubject">
  
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header test">
                  <h5 class="modal-title">{{ __('app.delete_sub_title') }}</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <form action="{{ route('subject.delete') }}" method="post">
                @csrf
                <div class="modal-body">
                  <p>{{ __('app.delete_subject') }}</p>
                  
                </div>
                <div class="modal-footer">
                  <input type="hidden" name="subjectId" value="{{ $subject->id }}">
                  <button type="submit" class="btn btn-primary">{{ __('app.yes') }}</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('app.no') }}</button>
                </div>
              </form>
          </div>
      </div>
</div>