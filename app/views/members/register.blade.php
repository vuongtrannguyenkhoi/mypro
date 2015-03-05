@extends('master')

@section('content')
<div class="body-content">
    <div class="container">
        <div class="row">
            <div class="content">
                <div class="col-lg-3">
                    <div class="aside-left">
                        <div class="row">
                            <div class="col-lg-12">
                                <h2 class="aside-left-header-title">DANH MỤC SẢN PHẨM</h2>
                                <div class="aside-nav">
                                    <ul>
                                        <li>
                                            <h3 class="aside-nav-title">BÉ GÁI</h3>
                                            <ul class="aside-nav-sub">
                                                @foreach ($girlCategories as $girlCategory)
                                                <li>
                                                    <a href="{{ url('posts/'.$girlCategory->slug) }}">{{ $girlCategory->name }}</a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        <li>
                                            <h3 class="aside-nav-title">BÉ TRAI</h3>
                                            <ul class="aside-nav-sub">
                                                @foreach ($boyCategories as $boyCategory)
                                                <li>
                                                    <a href="{{ url('posts/'.$boyCategory->slug) }}">{{ $boyCategory->name }}</a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="search-form">
                                <input class="form-control" type="text" placeholder="Tìm kiếm"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="box">
                                <div class="box-header">
                                    <h2 class="box-title">LIÊN HỆ</h2>
                                </div>
                                <div class="box-body">
                                    {{ $box['left-address']->content }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="col-lg-9">
                        <h2 class="content-header-title">
                            ĐĂNG KÝ THÀNH VIÊN
                        </h2>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-register">
                                    <form action="" method="POST" class="form-horizontal" role="form">
                                        <div class="form-group">
                                            <label for="username" class="col-sm-2 control-label">Tài khoản*</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="username" id="username" class="form-control" required="required">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="email" class="col-sm-2 control-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" name="email" id="email" class="form-control" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="password" class="col-sm-2 control-label">Mật khẩu</label>
                                            <div class="col-sm-10">
                                                <input type="password" name="password" id="password" class="form-control" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-10 col-sm-offset-2">
                                                <button type="submit" class="btn btn-primary">Đăng ký</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop