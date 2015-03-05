@extends('master')

@section('content')
    <div class="body-blog padding-top-bottom-30">
        <div class="blog-content">
            @foreach ($posts as $post)
                <div class="post">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="post-content">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <a href='{{ url("posts/{$post->category_slug}/{$post->id}/{$post->slug}") }}'>
                                                <img src="{{ url($post->thumb) }}" alt="" class="post-thumb"/>
                                            </a>
                                        </div>
                                        <div class="col-lg-8">
                                            <a href='{{ url("posts/{$post->category_slug}/{$post->id}/{$post->slug}") }}'>
                                                <h3 class="post-title">{{ $post->name }}</h3>
                                            </a>
                                            <div class="post-description">
                                                {{ $post->description }}
                                            </div>
                                            <a href='{{ url("posts/{$post->category_slug}/{$post->id}/{$post->slug}") }}'>Chi tiết</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@stop