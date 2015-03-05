@extends('master')

@section('content')
    <div class="wrap-content">
        <div class="body-slider">
            @if (isset($gallery))
                <div class="flexslider">
                    <ul class="slides">
                        @foreach ($gallery->photos as $photo)
                            <?php
                            list($width,$height) = getimagesize(url($photo->photo));
                            ?>
                            <li>
                                <img src="{{ url($photo->photo) }}" class="@if ($height>$width)
                            slide-resize-height
                        @endif" />
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="slide-info">
                    <span id="current-slide"></span>/<span id="total-slides"></span>
                </div>
            @endif
        </div>
    </div>
@stop