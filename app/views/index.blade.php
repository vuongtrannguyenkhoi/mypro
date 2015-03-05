@extends('master')

@section('title')
    {{ $siteconfig->site_title }}
@stop
@section('description')
    {{ $siteconfig->site_meta_description }}
@stop
@section('keywords')
    {{ $siteconfig->site_meta_keywords }}
@stop
@section('canonical')
    http://www.maypro.vn
@stop
@section('body-head')
    <div id="video"></div>
@stop
@section('content')
    <div class="body-introduction">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="introduction padding-top-bottom-80 text-center">
                        {{ $box['introduction']->content }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="body-featured-projects">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="featured-projects margin-bottom-20">
                        <div class="row">
                            <div class="col-lg-12 margin-bottom-20">
                                <h2 class="lg-title">Dự Án Nổi Bật</h2>
                            </div>
                        </div>
                        <div class="row">
                            @foreach ($featuredProjects as $featuredProject)
                                <div class="col-lg-6 project">
                                    <a href='{{url("{$featuredProject->controller}/{$featuredProject->category_slug}/{$featuredProject->id}/{$featuredProject->slug}")}}'>
                                        <img src="{{$featuredProject->featured_thumb}}" alt=""/>
                                        <div class="project-cover">
                                            <div class="project-cover-content">
                                                <p>{{$featuredProject->name}}</p>
                                                <p><?php
                                                    $date = new DateTime($featuredProject->event_date);
                                                    ?>
                                                    {{ $date->format('d.m.Y') }}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{HTML::script('frontend/assets/plugins/videobg/jquery.videoBG.js')}}
    <script>
        $('#video').videoBG({
            position:	"absolute",
            zIndex:	0,
            ogv:	'http://maypro.app/upload/files/jm-intro-long.ogv',
            mp4:	'http://maypro.app/upload/files/jm-intro-long.mp4',
            webm:	'http://maypro.app/upload/files/jm-intro-long.webm',
            opacity:	1,
            height:	"100%"
        });
        $(function() { // runs after DOM has loaded

            vid_w_orig = parseInt($('video').attr('width'));
            vid_h_orig = parseInt($('video').attr('height'));

            $(window).resize(function () { resizeToCover(); });

        });

        function resizeToCover() {

            $('.videoBG').height(scale * vid_h_orig);
            $('.videoBG').width($(window).width());

            var scale_h = $(window).width() / vid_w_orig;
            var scale_v = $(window).height() / vid_h_orig;
            var scale = scale_h > scale_v ? scale_h : scale_v;

            if (scale * vid_w_orig < min_w) {scale = min_w / vid_w_orig;};

            $('video').css("top", "0");
            $('video').width(scale * vid_w_orig);
            $('video').height(scale * vid_h_orig);
            $('.videoBG').height($(window).height());
            $('.videoBG').scrollLeft(($('video').width() - $(window).width()) / 2);
            $('.videoBG').scrollTop(($('video').height() - $(window).height()) / 2);
        };

    </script>
@stop