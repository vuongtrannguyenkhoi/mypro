@extends('admin.master')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Create a profile
    </h1>
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
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-5">
            <div class="box">
                {{ Form::open(array(
                    'route' => array('admin.users.profiles.store',$user),
                    'files'  => true,
                )) }}
                    <div class="box-body">
                        <div class="form-group">
                            {{ Form::label('full_name','Full name') }}
                            {{ Form::text('full_name',null,
                            array(
                            'id' => 'full_name',
                            'class' => 'form-control input-sm',
                            'placeholder' => 'Projectpage name',
                            )
                            )}}
                        </div>
                        <div class="form-group">
                            {{ Form::label('content','Information') }}
                            {{ Form::textarea('content',null,
                            array(
                            'id' => 'content',
                            'class' => 'form-control input-sm',
                            'placeholder' => 'Profile information',
                            'required'
                            )
                            )}}
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-sm btn-primary pull-left">Save</button>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</section>

@stop