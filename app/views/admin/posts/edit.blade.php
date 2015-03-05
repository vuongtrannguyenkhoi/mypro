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
                    <h2><a href="#posts?topic={{Session::get('topic')}}" class=" back-link-icon" title="Back to Post manager"><i class="fa fa-arrow-circle-o-left"></i></a> Edit post</h2>
                </header>
                <div role="content">

                    <!-- widget edit box -->
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->
                    </div>
                    <!-- end widget edit box -->
                    <!-- widget content -->
                    <div class="widget-body no-padding">
                        {{ Form::model($post,
                        array(
                        'route' => array('admin.posts.update', $post->id),
                        'files'=>true,
                        'class' => 'smart-form',
                        )) }}
                        <input type="hidden" name="_method" value="PUT" />
                        <input type="hidden" name="id" value="{{ $post->id }}" />
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
                                            )}}
                                        </label>

                                    </section>
                                    <section>
                                        {{ Form::label('slug','Permalink: '.url().'/'.$post->category->controller.'/'.$post->category->slug.'/',array('id'=>'permalink','class'=>'label')) }}
                                        <label class="input" for="">
                                            {{ Form::text('slug',null,
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
                                        <div id="content-base-thumb">
                                            <img id="base-thumb" src="{{ url($post->thumb) }}" alt="User Image">
                                        </div>
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
                                                    <option value="{{ $parent->id }}" @if ($post->category_id == $parent->id)
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
                                    <section style="width:200px">
                                        <label class="toggle">
                                            <input type="checkbox" name="featured" @if ($post->featured == 1)
                                                   checked
                                                    @endif>
                                            <i data-swchon-text="Yes" data-swchoff-text="No"></i>Featured</label>
                                        </label>
                                    </section>
                                    <section style="width:200px">
                                        {{ Form::label('pubdate','Published date',array('class'=>'label')) }}
                                        <div class="input-group date" id="pubdate" data-date="" data-date-format="yyyy-mm-dd">
                                            {{ Form::text('pubdate',null,
                                            array('class'=>'form-control',
                                            'placeholder'=>'Published date')) }}
                                            <span class="input-group-addon">
                                                                                    <i class="glyphicon glyphicon-calendar"></i>
                                                                                </span>
                                        </div>
                                    </section>
                                    <section>
                                        <hr/>
                                    </section>
                                    <!-- optional fields -->
                                    <?php  $template = 'admin.posts.partials.' . $template; ?>
                                    @include($template)
                                </div>
                                <div class="col col-6">
                                    @include('admin.partials.seo',$meta = $post->seo->first())
                                </div>
                            </div>

                            <div class="row">
                                <div class="col col-6">
                                    <section>
                                        {{ Form::label('description','Description',array('class'=>'label')) }}
                                        <label class="textarea" for="">
                                            {{ Form::textarea('description',null,
                                            array(
                                            'id' => 'description',
                                            'class' => null,
                                            'placeholder' => '',
                                            )
                                            )}}
                                        </label>
                                    </section>
                                </div>
                            </div>
                            <section>
                                {{ Form::label('content','Content',array('class'=>'label')) }}
                                <label class="textarea" for="">
                                    {{ Form::textarea('content',null,
                                    array(
                                    'id' => 'content',
                                    'class' => 'editor',
                                    'placeholder' => 'Post content',
                                    )
                                    )}}
                                </label>
                            </section>

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
        $("#pubdate").datepicker();
        $("#event_date").datepicker();
        $('#category_id').change(function(){

            $.ajax({
                type: 'get',
                url: '{{url('admin/api/categories/')}}'+'/' + $(this).val(),
                data:{},
                success:function(rs){
                    rs = $.parseJSON(rs);
                    if(rs.status){
                        var category = $.parseJSON(rs.category);
                        updatePermalink(category);
                    }
                }
            });
        });
        function updatePermalink(category){
            $('#permalink').text('Permalink: ' + '{{url()}}' +'/' + category.controller + '/' + category.slug + '');
        };

    };

    // end pagefunction
    pagefunction();

</script>

<div class="modal fade" id="remoteModal" tabindex="-1" role="dialog" aria-labelledby="remoteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

        </div>
    </div>
</div>