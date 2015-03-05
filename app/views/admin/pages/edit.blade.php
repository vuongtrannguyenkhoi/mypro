
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
                    <h2><a href="#pages" class=" back-link-icon" title="Back to page manager"><i class="fa fa-arrow-circle-o-left"></i></a> Edit page</h2>
                </header>
                <div role="content">

                    <!-- widget edit box -->
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->
                    </div>
                    <!-- end widget edit box -->
                    <!-- widget content -->
                    <div class="widget-body no-padding">
                        {{ Form::model($page,array(
                        'route' => array('admin.pages.update', $page->id),
                        'class' => 'smart-form',
                        'files'  => true
                        )) }}
                        <input type="hidden" name="_method" value="PUT" />
                        <input type="hidden" name="id" value="{{ $page->id }}" />
                        <fieldset>
                            <div class="row">
                                <div class="col col-6">
                                    <section>
                                        {{ Form::label('name','Title',array('class'=>'label')) }}
                                        <label class="input" for="">
                                            {{ Form::text('name',null,
                                            array(
                                            'id' => 'name',
                                            'class' => 'form-control input-sm',
                                            'placeholder' => 'Enter title here',
                                            'required'
                                            )
                                            )}}</label>
                                    </section>
                                    <section>
                                        {{ Form::label('slug','Slug',array('class'=>'label')) }}
                                        <label class="input" for="">
                                            {{ Form::text('slug',null,
                                            array(
                                            'id' => 'slug',
                                            'class' => 'form-control input-sm',
                                            'placeholder' => '',
                                            'required'
                                            )
                                            )}}</label>
                                    </section>
                                    <section>
                                        <div id="content-base-thumb">
                                            <img id="base-thumb" src="{{ url($page->thumb) }}" alt="User Image">
                                        </div>
                                    </section>
                                    <section>
                                        <label for="file" class="label">Featured image</label>
                                        <label for="file" class="input input-file">
                                            <div class="button"><input type="file" name="file" onchange="this.parentNode.nextSibling.value = this.value">Browse</div><input type="text" placeholder="Include some files" readonly="">
                                        </label>
                                    </section>
                                    <section>
                                        {{ Form::label('description','Description',array('class'=>'label')) }}
                                        <label class="textarea" for="">
                                            {{ Form::textarea('description',null,
                                            array(
                                            'id' => 'description',
                                            'class' => 'form-control',
                                            'placeholder' => '',
                                            )
                                            )}}</label>
                                    </section>
                                    <section>
                                        {{ Form::label('content','Content',array('class'=>'label')) }}
                                        <label class="textarea" for="">
                                            {{ Form::textarea('content',null,
                                            array(
                                            'id' => 'content',
                                            'class' => 'form-control editor',
                                            'placeholder' => '',
                                            )
                                            )}}</label>
                                    </section>
                                </div>
                                <div class="col col-6">
                                    @include('admin.partials.seo',$meta)
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

<script>
    renderEditor();
    getSlug('#name','#slug');
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