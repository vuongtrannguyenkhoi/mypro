@extends('master')

@section('content')
    <section class="section-4">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="section-title-2">{{ $page->name }}</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    {{ $page->content }}
                </div>
            </div>
            <div class="row mb40 mt40">
                <div class="col-sm-12">
                    <div class="divider d2 d4"><span><i class="fa fa-ellipsis-h"></i></span></div>
                </div>
            </div>
        </div>
    </section>
@stop