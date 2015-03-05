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
                    <h2>Add new user</h2>
                </header>
                <div role="content">

                    <!-- widget edit user -->
                    <div class="jarviswidget-edituser">
                        <!-- This area used as dropdown edit user -->
                    </div>
                    <!-- end widget edit user -->
                    <!-- widget content -->
                    <div class="widget-body no-padding">
                        {{ Form::open(array(
                        'route' => 'admin.users.store',
                        'class' => 'smart-form'
                        )) }}
                        <fieldset>
                            <div class="row">
                                <div class="col col-6">
                                    <section>
                                        {{ Form::label('username','User name',array('class'=>'label')) }}
                                        <label class="input" for="">
                                            {{ Form::text('username','',
                                            array(
                                            'id' => 'username',
                                            'class' => 'form-control input-sm',
                                            'required'
                                            )
                                            )}}
                                        </label>
                                    </section>

                                    <section>
                                        {{ Form::label('password','Password',array('class'=>'label')) }}
                                        <label class="input" for="">
                                            {{ Form::password('password',
                                            array(
                                            'id' => 'password',
                                            'class' => 'form-control input-sm',
                                            'required'
                                            )
                                            )}}
                                        </label>
                                    </section>

                                    <section>
                                        {{ Form::label('password_confirmation','Confirm password',array('class'=>'label')) }}
                                        <label class="input" for="">
                                            {{ Form::password('password_confirmation',
                                            array(
                                            'id' => 'password_confirmation',
                                            'class' => 'form-control input-sm',
                                            'required'
                                            )
                                            )}}
                                        </label>
                                    </section>
                                    <section>
                                        {{ Form::label('email','Email',array('class'=>'label')) }}
                                        <label class="input" for="">
                                            {{ Form::email('email','',
                                            array(
                                            'id' => 'email',
                                            'class' => 'form-control input-sm',
                                            )
                                            )}}
                                        </label>
                                    </section>
                                    <section>
                                        {{ Form::label('role','Roles',array('class'=>'label')) }}
                                        <label class="input" for="">
                                            {{ Form::select('role', $roles , null , array('class' => 'form-control')) }}
                                        </label>
                                    </section>
                                    <section>
                                        {{ Form::label('status','Statuses',array('class'=>'label')) }}
                                        <label class="input" for="">
                                            {{ Form::select('status', $statuses , null , array('class' => 'form-control')) }}
                                        </label>
                                    </section>
                                </div>
                            </div>
                        </fieldset>
                        <footer>
                            <button type="submit" class="btn btn-sm btn-primary">Add new user</button>
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