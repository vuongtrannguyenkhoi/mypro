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
                    <h2><a href="#posts?topic={{Session::get('topic')}}" class=" back-link-icon" title="Back to Post manager"><i class="fa fa-arrow-circle-o-left"></i></a> Add new post</h2>
                </header>
                <div role="content">

                    <!-- widget edit box -->
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->
                    </div>
                    <!-- end widget edit box -->
                    <!-- widget content -->
                    <div class="widget-body no-padding">
                        {{ Form::model($post = new \Qdesign\Models\Post(),array(
                        'route' => 'admin.posts.store',
                        'files' =>true,
                        'class' => 'smart-form',
                        )) }}
                        <fieldset>
                            <div class="row">
                                <div class="col col-6">
                                    <section>
                                        {{ Form::label('name','Title',array('class'=>'label')) }}
                                        <label class="input" for="">
                                            {{ Form::text('name','',
                                            array(
                                            'id' => 'name',
                                            'class' => 'form-control input-sm',
                                            'placeholder' => 'Post name',
                                            'required'
                                            )
                                            )}}
                                        </label>
                                    </section>
                                    <section>
                                        {{ Form::label('slug','Permalink',array('id'=>'permalink','class'=>'label')) }}
                                        <label class="input" for="">
                                            {{ Form::text('slug','',
                                            array(
                                            'id' => 'slug',
                                            'class' => 'form-control input-sm',
                                            'placeholder' => '',
                                            'required'
                                            )
                                            )}}
                                        </label>
                                    </section>

                                    <section>
                                        <label class="label">Featured image</label>
                                        <label for="file" class="input input-file">
                                            <div class="button"><input type="file" name="file" onchange="this.parentNode.nextSibling.value = this.value">Browse</div><input type="text" placeholder="Include some files" readonly="">
                                        </label>
                                    </section>
                                    <section>
                                        {{ Form::label('category_id','Category',array('class'=>'label')) }}
                                        <label class="select" for="">
                                            <select class="selectpicker form-control input-sm" name="category_id" id="category_id">
                                                @foreach ($categories as $parent)
                                                    <option value="{{ $parent->id }}" @if ($parent->slug == Session::get('topic'))
                                                            selected
                                                            @endif>
                                                        @for ($i = 0; $i < $parent->depth; $i++)
                                                            -
                                                        @endfor
                                                        {{ $parent->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <i></i>
                                        </label>
                                    </section>
                                    <section>
                                        {{ Form::label('status','Status',array('class'=>'label')) }}

                                        <label class="select">
                                            {{ Form::select('status', $statuses , null , array('class' => 'form-control input-sm') ) }}
                                            <i></i>
                                        </label>
                                    </section>

                                    <section  style="width:200px">
                                        <label class="toggle">
                                            <input type="checkbox" name="featured">
                                            <i data-swchon-text="Yes" data-swchoff-text="No"></i>Featured</label>
                                        </label>
                                    </section>

                                    <section style="width:200px">
                                        {{ Form::label('pubdate','Published date',array('class'=>'label')) }}
                                        <div class="input-group date" id="pubdate" data-date="" data-date-format="yyyy-mm-dd">
                                            {{ Form::text('pubdate','',
                                            array('class'=>'form-control',
                                            'placeholder'=>'Published date')) }}
                                            <span class="input-group-addon">
                                                                                    <i class="glyphicon glyphicon-calendar"></i>
                                                                                </span>
                                        </div>
                                    </section>
                                    <!-- optional fields -->
                                    <?php  $template = 'admin.posts.partials.' . $template; ?>
                                    @include($template)
                                </div>
                                <div class="col col-6">
                                    @include('admin.partials.seo')
                                </div>
                            </div>
                            <div class="row">
                                <div class="col col-6">
                                    <section>
                                        <label for="description" class="label">Description</label>
                                        <label class="textarea" for="description">

                                            {{ Form::textarea('description','',
                                            array(
                                            'id' => 'description',
                                            'class' => '',
                                            'placeholder' => '',
                                            )
                                            )}}
                                        </label>
                                    </section>
                                </div>
                            </div>

                            <section>
                                <label for="content" class="label">Content</label>
                                <label class="textarea" for="content">
                                    {{ Form::textarea('content','',
                                    array(
                                    'id' => 'content',
                                    'class' => 'editor',
                                    'placeholder' => '',
                                    )
                                    )}}
                                </label>
                            </section>
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

    }
    $("#pubdate").datepicker();

    var pagefunction = function() {
        $("#pubdate").datepicker();
        getPermalink($('#category_id').val());

        $('#category_id').change(function(){
            getPermalink($(this).val());

        });


        function getPermalink(categoryId){
            $.ajax({
                type: 'get',
                url: '{{url('admin/api/categories/')}}'+'/' + categoryId,
                data:{},
                success:function(rs){
                    rs = $.parseJSON(rs);
                    if(rs.status){
                        var category = $.parseJSON(rs.category);
                        updatePermalink(category);
                    }
                }
            });
        };
        function updatePermalink(category){
            $('#permalink').text('Permalink: ' + '{{url()}}' +'/' + category.controller + '/' + category.slug + '');
        };
    };

    // end pagefunction

    // run pagefunction on load
    pagefunction();

</script>