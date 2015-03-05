
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
        <article class="col-sm-12 col-md-12 col-lg-6">
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
                    <h2>Edit a order</h2>
                </header>
                <div role="content">

                    <!-- widget edit order -->
                    <div class="jarviswidget-editorder">
                        <!-- This area used as dropdown edit order -->
                    </div>
                    <!-- end widget edit order -->
                    <!-- widget content -->
                    <div class="widget-body">
                        {{ Form::model($order,array(
                        'route' => array('admin.orders.update', $order->id),
                        'class' => 'smart-form'
                        )) }}
                        <input type="hidden" name="_method" value="PUT" />
                        <input type="hidden" name="id" value="{{ $order->id }}" />
                            <fieldset>
                                <section>
                                    {{ Form::label('name','Order Code') }}
                                    <label class="input" for="">
                                        {{ Form::text('order_code',null,
                                        array(
                                        'id' => 'order_code',
                                        'class' => 'form-control input-sm',
                                        'placeholder' => 'Order code',
                                        'required'
                                        )
                                        )}}
                                    </label>

                                </section>
                                <section>
                                    {{ Form::label('customer_name','Customer name') }}
                                    <label class="input" for="">
                                    {{ Form::text('customer_name',null,
                                    array(
                                    'id' => 'customer_name',
                                    'class' => 'form-control input-sm',
                                    'placeholder' => 'Customer name',
                                    'required'
                                    )
                                    )}}</label>
                                </section>
                                <section>
                                    {{ Form::label('phone','Phone') }}
                                    <label class="input" for="">
                                        {{ Form::text('phone',null,
                                        array(
                                        'id' => 'phone',
                                        'class' => 'form-control input-sm',
                                        'placeholder' => 'Phone',
                                        'required'
                                        )
                                        )}}</label>
                                </section>
                                <section>
                                    {{ Form::label('email','Email') }}
                                    <label class="input" for="">
                                        {{ Form::email('email',null,
                                        array(
                                        'id' => 'email',
                                        'class' => 'form-control input-sm',
                                        'placeholder' => 'Email',
                                        )
                                        )}}</label>
                                </section>
                                <section>
                                    {{ Form::label('address','Address') }}
                                    <label class="input" for="">
                                        {{ Form::text('address',null,
                                        array(
                                        'id' => 'address',
                                        'class' => 'form-control input-sm',
                                        'placeholder' => 'Address',
                                        )
                                        )}}</label>
                                </section>
                                <section>
                                    {{ Form::label('note','Note') }}
                                    <label class="textarea" for="">
                                    {{ Form::textarea('note',null,
                                    array(
                                    'id' => 'note',
                                    'class' => 'form-control input-sm editor',
                                    'placeholder' => 'Note',
                                    )
                                    )}}</label>
                                </section>
                            </fieldset>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-sm btn-primary pull-left">Save</button>
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