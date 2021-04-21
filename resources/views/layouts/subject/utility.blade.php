<div class="subject_utility container">
    <div class="row justify-content-between align-items-center">
        <div class="subject__detail col-2">
            <p>Tạo bởi</p>
            <p>{{ $user->name }}</p>
        </div>

        <ul class="subject_utitlity__item">
            <li>
                <a href="#" data-toggle="tooltip" data-placement="bottom" title="Thêm">
                    <i class="fa fa-plus"></i>
                </a>
            </li>

            <li>
                <a href="#" data-toggle="tooltip" data-placement="bottom" title="Sửa">
                    <i class="fa fa-plus"></i>
                </a>
            </li>

            <li>
                <a href="#" data-toggle="tooltip" data-placement="bottom" data-html="true" title="Xóa">
                    <i class="fa fa-trash"></i>
                </a>
            </li>
        </ul>
    </div>
</div>