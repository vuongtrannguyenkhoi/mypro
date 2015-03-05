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
                                <form action="{{ url('search') }}">
                                    <input class="form-control" type="text" placeholder="Tìm kiếm" name="q"/>
                                </form>
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
                    <h2 class="content-header-title">
                        LIÊN HỆ
                    </h2>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="content-content">
                                {{ isset($box['contact']) ? $box['contact']->content:'' }}
                            </div>
                            <hr/>
                            <div class="map">
                                {{ isset($box['google-map']) ? $box['google-map']->content:'' }}
                            </div>
                            <hr/>
                            <div class="contact-form">
                                <div class="row">
                                    <div class="col-lg-12">
                                        @if (Session::has('message'))
                                        <div class="alert alert-success alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <p>{{ Session::get('message') }}</p>
                                        </div>
                                        @endif
                                        @if( count($errors->all()) )
                                        <div class="alert alert-danger alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                <li class="danger alert">{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    {{ Form::open(array(
                                    'url' => 'form/lien-he',
                                    'class'=>'form-inline',
                                    )) }}
                                    <div class="form-group col-md-4">
                                        <label class="sr-only" for="name">Họ tên*</label>
                                        <input type="text" class="" name="name" id="name" placeholder="Họ tên*" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="sr-only" for="phone">Điện thoại*</label>
                                        <input type="text" class="" name="phone" id="phone" placeholder="Điện thoại" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="sr-only" for="email">Email</label>
                                        <input type="email" class="" name="email" id="email" placeholder="Email">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <textarea name="body"  placeholder="Messages*" required></textarea>
                                        <button type="submit" class="btn btn-primary btn-send pull-right">Gửi</button>
                                    </div>
                                    {{ Form::close() }}
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