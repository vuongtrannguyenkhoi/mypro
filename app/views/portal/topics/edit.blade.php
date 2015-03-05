
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
        <article class="col-xs-12">
            <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-1" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false">
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
                    <h2><a class="btn btn-xs txt-color-white" href="#topics"><i class="fa fa-arrow-circle-left"></i></a> |Edit a box</h2>
                </header>
                <div role="content">

                    <!-- widget edit box -->
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->
                    </div>
                    <!-- end widget edit box -->
                    <!-- widget content -->
                    <div class="widget-body">
                        {{ Form::model($topic,array(
                        'route' => array('portal.topics.update', $topic->id),
                        'class' => 'smart-form'
                        )) }}
                        <input type="hidden" name="_method" value="PUT" />
                        <input type="hidden" name="id" value="{{ $topic->id }}" />
                        <fieldset>
                            <div class="row">
                                <div class="col-md-6">

                                    <fieldset>

                                        <section>
                                            {{ Form::label('forum_id','Forum') }}
                                            <label class="select" for="">
                                                <select class="selectpicker form-control input-sm" name="forum_id">
                                                    @foreach ($forums as $forum)
                                                    <option value="{{ $forum->id }}" @if ($forum->id == $topic->forum_id)
                                                    selected
                                                    @endif >
                                                    {{ $forum->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                <i></i>
                                            </label>

                                        </section>
                                        <section>
                                            {{ Form::label('name','Topic name') }}
                                            <label class="input" for="">
                                                {{ Form::text('name',null,
                                                array(
                                                'id' => 'name',
                                                'class' => 'form-control input-sm',
                                                'placeholder' => 'Topic name',
                                                'required'
                                                )
                                                )}}
                                            </label>

                                        </section>
                                        <section>
                                            {{ Form::label('slug','Slug') }}
                                            <label class="input" for="">
                                                {{ Form::text('slug',null,
                                                array(
                                                'id' => 'slug',
                                                'class' => 'form-control input-sm',
                                                'placeholder' => 'Topic slug',
                                                'required'
                                                )
                                                )}}</label>
                                        </section>
                                        <section>
                                            {{ Form::label('description','Description') }}
                                            <label class="textarea" for="">
                                                {{ Form::textarea('description',null,
                                                array(
                                                'id' => 'description',
                                                'class' => 'form-control',
                                                'placeholder' => 'Description',
                                                )
                                                )}}</label>
                                        </section>

                                    </fieldset>

                                </div>
                                <div class="col-md-6">
                                    <fieldset>

                                        <section>
                                            {{ Form::label('meta_descriptions','Meta descriptions') }}
                                            <label class="textarea" for="">
                                                {{ Form::textarea('meta_descriptions',null,
                                                array(
                                                'id' => 'meta_descriptions',
                                                'class' => 'form-control',
                                                'placeholder' => 'Meta descriptions',
                                                )
                                                )}}</label>
                                        </section>
                                        <section>
                                            {{ Form::label('meta_keywords','Meta keywords') }}
                                            <label class="textarea" for="">
                                                {{ Form::textarea('meta_keywords',null,
                                                array(
                                                'id' => 'meta_keywords',
                                                'class' => 'form-control',
                                                'placeholder' => 'Meta keywords',
                                                )
                                                )}}</label>
                                        </section>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <fieldset>
                                        <section>
                                            {{ Form::label('content','Content') }}
                                            <label class="textarea" for="">
                                                {{ Form::textarea('content',null,
                                                array(
                                                'id' => 'slug',
                                                'class' => 'form-control editor',
                                                'placeholder' => 'Content',
                                                )
                                                )}}</label>
                                        </section>
                                    </fieldset>
                                </div>
                            </div>
                        </fieldset>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-sm btn-primary">Lưu</button>
                            <a href="#topics" class="btn btn-sm btn-default">Thoát</a>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>

<script>
    renderEditor();
</script>
<script type="text/javascript">
    /* DO NOT REMOVE : GLOBAL FUNCTIONS!
     *
     * pageSetUp(); WILL CALL THE FOLLOWING FUNCTIONS
     *
     * // activate tooltips
     * $("[rel=tooltip]").tooltip();
     *
     * // activate popovers
     * $("[rel=popover]").popover();
     *
     * // activate popovers with hover states
     * $("[rel=popover-hover]").popover({ trigger: "hover" });
     *
     * // activate inline charts
     * runAllCharts();
     *
     * // setup widgets
     * setup_widgets_desktop();
     *
     * // run form elements
     * runAllForms();
     *
     ********************************
     *
     * pageSetUp() is needed whenever you load a page.
     * It initializes and checks for all basic elements of the page
     * and makes rendering easier.
     *
     */

    pageSetUp();

    /*
     * ALL PAGE RELATED SCRIPTS CAN GO BELOW HERE
     * eg alert("my home function");
     *
     * var pagefunction = function() {
     *   ...
     * }
     * loadScript("js/plugin/_PLUGIN_NAME_.js", pagefunction);
     *
     * TO LOAD A SCRIPT:
     * var pagefunction = function (){
     *  loadScript("../../plugin.js", run_after_loaded);
     * }
     *
     * OR
     *
     * loadScript("../../plugin.js", run_after_loaded);
     */

    // PAGE RELATED SCRIPTS

    // pagefunction

    var pagefunction = function() {

    };

    // end pagefunction

    // run pagefunction on load
    pagefunction();

</script>