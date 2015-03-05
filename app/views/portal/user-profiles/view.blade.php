<div class="content">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            @if (!isset($userProfile))
            <div class="alert alert-info">
                <p>Hiện tại bạn chưa cập nhật thông tin bản thân, <a href="#user/profile/create" class="">cập nhật</a></p>
            </div>
            @else
            <div class="well well-sm">
                <p>First name: {{ $userProfile->first_name }}</p>
                <p>Last name: {{ $userProfile->last_name }}</p>
                <hr/>
                <a href="#user/profile/edit">thay đổi thông tin</a>
            </div>
            @endif
        </div>
    </div>
</div>
