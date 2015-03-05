@extends('admin.master')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Profile Manager
    </h1>

    @if ($profile)
    {{ link_to_route('admin.users.profiles.edit','Edit',array('user'=>$user,'profile'=>$profile->id),array('class'=>'btn btn-add btn-primary btn-xs') ) }}
    @else
    {{ link_to_route('admin.users.profiles.create','Create a profile',array('user'=>$user)) }}
    @endif
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <h1>User profile </h1>
                    @if (isset($profile))
                    <div>
                        @if ($profile->photo)
                        <img src="{{ url($profile->photo) }}" alt="" class="img-avata"/>
                        @else
                        <i class="fa fa-fw fa-user icon-avata"></i>
                        @endif
                    </div>
                    <p>Full name: {{ $profile->full_name }}</p>
                    <hr/>
                    <p>Information:</p>
                    <p>{{ $profile->content }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@stop