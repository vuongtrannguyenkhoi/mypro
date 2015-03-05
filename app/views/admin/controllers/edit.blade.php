
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

            @if (Session::has('message'))
                <div class="alert alert-success alert-block">
                    <a class="close" data-dismiss="alert" href="#">×</a>
                    {{ Session::get('message') }}
                </div>
            @endif

            <div class="jarviswidget jarviswidget-color-blueDark"  data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false">
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
                    <h2><a href="#controllers" class=" back-link-icon" title="Back to Controller manager"><i class="fa fa-arrow-circle-o-left"></i></a> Edit controller</h2>
                </header>
                <div role="content">

                    <!-- widget edit controller -->
                    <div class="jarviswidget-editcontroller">
                        <!-- This area used as dropdown edit controller -->
                    </div>
                    <!-- end widget edit controller -->
                    <!-- widget content -->
                    <div class="widget-body no-padding">
                        {{ Form::model($controller,array(
                        'route' => array('admin.controllers.update', $controller->id),
                        'class' => 'smart-form'
                        )) }}
                        <input type="hidden" name="_method" value="PUT" />
                        <input type="hidden" name="id" value="{{ $controller->id }}" />
                            <fieldset>
                                <div class="row">
                                    <div class="col col-6">
                                        <section>
                                            {{ Form::label('controller','Controller',array('class'=>'label')) }}
                                            <label class="input" for="">
                                                {{ Form::text('controller',null,
                                                array(
                                                'id' => 'controller',
                                                'class' => '',
                                                'placeholder' => '',
                                                'required'
                                                )
                                                )}}</label>
                                        </section>
                                        <section>
                                            {{ Form::label('name','Name',array('class'=>'label')) }}
                                            <label class="input" for="">
                                                {{ Form::text('name',null,
                                                array(
                                                'id' => 'name',
                                                'class' => 'form-control input-sm',
                                                'placeholder' => '',
                                                'required'
                                                )
                                                )}}
                                            </label>

                                        </section>

                                        <section>
                                            {{ Form::label('description','Description',array('class'=>'label')) }}
                                            <label class="textarea" for="">
                                                {{ Form::textarea('description',null,
                                                array(
                                                'id' => 'description',
                                                'class' => '',
                                                'placeholder' => '',
                                                )
                                                )}}</label>
                                        </section>
                                    </div>
                                    <div class="col col-6">
                                        <section>
                                            <label class="label">Templates</label>
                                            <div class="row">
                                                <div class="col col-10">
                                                    @foreach ($templates as $template)
                                                        <label class="checkbox">
                                                            <input type="checkbox" name="templates[]" value="{{$template->id}}" @if (in_array($template->id,$controller->templates->lists('id')))
                                                                checked
                                                            @endif>
                                                            <i></i>{{ $template->name }} ({{$template->template}})</label>
                                                    @endforeach
                                                </div>
                                            </div>
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