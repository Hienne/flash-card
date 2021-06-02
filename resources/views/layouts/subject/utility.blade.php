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
                <form action="{{ route('subject.delete') }}" method="post">
                    @csrf
                    <input type="hidden" name="subjectId" value="{{ $subject->id }}">

                    <button type="submit" data-toggle="tooltip" data-placement="bottom" data-html="true" title="Xóa">
                        <i class="fa fa-trash"></i>
                    </button>
                </form>
            </li>
        </ul>
    </div>
</div>