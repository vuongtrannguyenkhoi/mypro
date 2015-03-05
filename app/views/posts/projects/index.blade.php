@extends('master')

@section('content')
    <div class="sub-nav">
        <a href='{{ url("{$parentCategory->controller}/{$parentCategory->slug}")}}'>Tất cả</a>
        @foreach ($subCategories as $subCategory)
            <a href='{{ url("{$parentCategory->controller}/{$parentCategory->slug}/{$subCategory->slug}") }}'>{{ $subCategory->name }}</a>
        @endforeach
        <div class="project-search-form">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Tìm dự án">
                  <span class="input-group-btn">
                    <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                  </span>
            </div><!-- /input-group -->
        </div>
    </div>
    <div class="body-projects padding-top-bottom-30">
        <div class="projects-content">
            @foreach ($posts as $post)
                <a href='{{ url("posts/{$post->category_slug}/{$post->id}/{$post->slug}") }}'>
                    <div class="project-item">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="project-item-content">
                                        <h3 class="project-title">{{ $post->name }}</h3>
                                <span class="project-date">
                                    <?php
                                    $date = new DateTime($post->event_date);
                                    ?>
                                    {{ $date->format('d.m.Y') }}
                                </span>
                                        <img src="{{ url($post->photo) }}" alt="" class="project-thumb"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@stop