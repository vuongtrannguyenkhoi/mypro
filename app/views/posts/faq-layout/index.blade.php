@extends('master')

@section('content')
    <div class="body-faq padding-top-bottom-30">
        <div class="faq-content">
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                @foreach ($posts as $post)
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingOne">
                            <h4 class="panel-title">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse-{{$post->id}}" aria-expanded="false" aria-controls="collapse-{{$post->id}}">
                                    {{ $post->name }}
                                </a>
                            </h4>
                        </div>
                        <div id="collapse-{{$post->id}}" class="panel-collapse collapse" role="tabpanel">
                            <div class="panel-body">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            {{ $post->content }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@stop