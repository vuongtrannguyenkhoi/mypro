@extends('master')
@section('body-head')
    {{ $box['google-map']->content }}
@stop
@section('content')
    <div class="body-contact padding-top-bottom-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact-content">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="contact-form-text">
                                    {{ $box['lien-he-left']->content }}
                                </div>
                                <hr/>
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
                                <div class="contact-form">
                                    {{ Form::open(array(
                                           'url' => 'contact',
                                           'class' => 'form-horizontal'
                                       )) }}
                                        <div class="form-group">
                                            <label for="name" class="col-sm-3 control-label">Họ tên</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="name" name="name">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="email" class="col-sm-3 control-label">Email</label>
                                            <div class="col-sm-9">
                                                <input type="email" class="form-control" id="email" name="email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone" class="col-sm-3 control-label">Số điện thoại</label>
                                            <div class="col-sm-9">
                                                <input type="tel" class="form-control" id="phone" name="phone">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="subject" class="col-sm-3 control-label">Tiêu đề</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="subject" name="subject">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="subject" class="col-sm-3 control-label">Nội dung</label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control" rows="10" name="body"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-3 col-sm-9">
                                                <button type="submit" class="btn btn-default">Gửi</button>
                                            </div>
                                        </div>
                                    {{ Form::close() }}
                                </div>
                            </div>
                            <div class="col-lg-6">
                                {{ $box['lien-he-right']->content }}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop