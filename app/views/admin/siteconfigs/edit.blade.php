<section class="content-header">
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
<section id="widget-grid">
    <div class="row">
        <article class="col-sm-12 col-md-12 col-lg-12">
            <div class="jarviswidget jarviswidget-color-blueDark"  data-widget-colorbutton="false" data-widget-editbutton="false" role="widget" style="">
                <!-- widget options:
                usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">
                data-widget-colorbutton="false"
                data-widget-editbutton="false"
                data-widget-togglebutton="false"
                data-widget-deletebutton="false"
                data-widget-fullscreenbutton="false"
                data-widget-custombutton="false"
                data-widget-collapsed="true"
                data-widget-sortable="false"
                -->
                <!-- widget div-->
                <header>
                    <h2>Settings</h2>
                </header>
                <div role="content">

                    <!-- widget edit box -->
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->
                    </div>
                    <!-- end widget edit box -->
                    <!-- widget content -->
                    <div class="widget-body no-padding">
                        {{ Form::model($siteconfig,array(
                        'class' =>'smart-form'
                        )) }}
                        <fieldset>
                            <div class="row">
                                <div class="col col-6">
                                    <section>
                                        {{ Form::label('site_title','Site title',array('class'=>'label')) }}
                                        <label class="input" for="">
                                            {{ Form::text('site_title',null,
                                            array(
                                            'id' => 'site_title',
                                            'class' => 'form-control input-sm',
                                            'placeholder' => 'Site title',
                                            )
                                            )}}
                                        </label>

                                    </section>
                                    <section>
                                        {{ Form::label('site_name','Site name',array('class'=>'label')) }}
                                        <label class="input" for="">
                                            {{ Form::text('site_name',null,
                                            array(
                                            'id' => 'site_name',
                                            'class' => 'form-control input-sm',
                                            'placeholder' => 'Site name',
                                            )
                                            )}}</label>
                                    </section>
                                    <section>
                                        {{ Form::label('company_receive_email','Email',array('class'=>'label')) }}
                                        <label class="input" for="">
                                            {{ Form::text('company_receive_email',null,
                                            array(
                                            'id' => 'company_receive_email',
                                            'class' => 'form-control input-sm',
                                            'placeholder' => 'Email',
                                            )
                                            )}}</label>
                                    </section>
                                    <section>
                                        {{ Form::label('pagination_perpage','Pagination',array('class'=>'label')) }}
                                        <label class="input" for="">
                                            {{ Form::text('pagination_perpage',null,
                                            array(
                                            'id' => 'pagination_perpage',
                                            'class' => 'form-control input-sm',
                                            'placeholder' => 'Pagination',
                                            )
                                            )}}</label>
                                    </section>


                                    <section>
                                        {{ Form::label('site_meta_description','Meta description',array('class'=>'label')) }}
                                        <label class="textarea" for="">
                                            {{ Form::textarea('site_meta_description',null,
                                            array(
                                            'id' => 'site_meta_description',
                                            'class' => 'form-control input-sm',
                                            'placeholder' => 'Meta description',
                                            )
                                            )}}</label>
                                    </section>
                                    <section>
                                        {{ Form::label('site_meta_keywords','Meta keywords',array('class'=>'label')) }}
                                        <label class="textarea" for="">
                                            {{ Form::textarea('site_meta_keywords',null,
                                            array(
                                            'id' => 'site_meta_keywords',
                                            'class' => 'form-control input-sm',
                                            'placeholder' => 'Meta keywords',
                                            )
                                            )}}</label>
                                    </section>
                                </div>
                            </div>

                        </fieldset>
                        <footer>
                            <button type="submit" class="btn btn-sm btn-primary pull-left">Update</button>
                        </footer>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>

