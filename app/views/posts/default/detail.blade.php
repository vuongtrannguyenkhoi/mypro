@extends('master')

@section('content')
    <div class="body-about padding-top-bottom-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="about-content">
                        {{ $post->content }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop