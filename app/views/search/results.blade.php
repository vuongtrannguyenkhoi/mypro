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
                        Tìm kiếm
                    </h2>
                    @foreach ($posts as $post)
                    <div class="row">
                        <div class="col-md-2">
                            <img src="{{ url($post->thumb) }}" alt="" style="width:100%"/>
                        </div>
                        <div class="col-md-10">
                            <h4>{{ $post->name }}</h4>
                            <div>
                                {{ $post->description }}
                            </div>
                        </div>
                    </div>
                    <hr/>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@stop