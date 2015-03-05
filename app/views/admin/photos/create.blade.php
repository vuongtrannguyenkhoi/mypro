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
                    <h2><a href="#galleries/{{ $gallery }}/photos" class=" back-link-icon" title="Back to Gallery/Photo Manager"><i class="fa fa-arrow-circle-o-left"></i></a> Upload new photo</h2>
                </header>
                <div role="content">

                    <!-- widget edit box -->
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->
                    </div>
                    <!-- end widget edit box -->
                    <!-- widget content -->
                    <div class="widget-body">
                        {{ Form::open(array(
                        'route' => array('admin.galleries.photos.store',$gallery),
                        'class' => 'smart-form',
                        'files'  => true
                        )) }}
                            <fieldset>
                                <div class="row">
                                    <div class="col col-8">
                                        <section>
                                            <label class="label">File input</label>
                                            <label for="file" class="input input-file">
                                                <div class="button"><input type="file" name="file" onchange="this.parentNode.nextSibling.value = this.value">Browse</div><input type="text" placeholder="Include some files" readonly="">
                                            </label>
                                        </section>

                                    </div>
                                    <div class="col col-4">
                                        <section>
                                            {{ Form::label('name','Title') }}
                                            <label class="input" for="">
                                                {{ Form::text('name',null,
                                                array(
                                                'id' => 'name',
                                                'class' => 'form-control input-sm',
                                                'placeholder' => '',
                                                ))}}</label>
                                        </section>
                                        <section>
                                            {{ Form::label('caption','Caption') }}
                                            <label class="textarea" for="">
                                                {{ Form::textarea('caption',null,
                                                array(
                                                'id' => 'caption',
                                                'class' => 'form-control input-sm',
                                                'placeholder' => '',
                                                )
                                                )}}</label>
                                        </section>
                                        <section>
                                            {{ Form::label('alt','Alt Text') }}
                                            <label class="input" for="">
                                                {{ Form::text('alt',null,
                                                array(
                                                'id' => 'alt',
                                                'class' => 'form-control input-sm',
                                                'placeholder' => '',
                                                )
                                                )}}</label>
                                        </section>
                                        <section>
                                            {{ Form::label('link','Link to') }}
                                            <label class="input" for="">
                                                {{ Form::text('link',null,
                                                array(
                                                'id' => 'link',
                                                'class' => 'form-control input-sm',
                                                'placeholder' => '',
                                                )
                                                )}}</label>
                                        </section>
                                        <section>
                                            {{ Form::label('description','Description') }}
                                            <label class="textarea" for="">
                                                {{ Form::textarea('description',null,
                                                array(
                                                'id' => 'description',
                                                'class' => 'form-control input-sm',
                                                'placeholder' => '',
                                                )
                                                )}}</label>
                                        </section>
                                    </div>
                                </div>
                            </fieldset>
                            <footer>
                                <button type="submit" class="btn btn-sm btn-primary pull-left">Save</button>
                            </footer>
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
