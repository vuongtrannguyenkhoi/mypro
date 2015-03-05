<section class="content-header">
    <h1>
        Create category
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
                    <h2><a href="#categories" class=" back-link-icon" title="Back to Category manager"><i class="fa fa-arrow-circle-o-left"></i></a> Add new category</h2>
                </header>
                <div role="content">

                    <!-- widget edit box -->
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->

                    </div>
                    <!-- end widget edit box -->

                    <!-- widget content -->
                    <div class="widget-body no-padding">


                        {{ Form::open(array(
                        'route' => 'admin.categories.store',
                        'class' => 'smart-form'
                        )) }}

                        <fieldset>
                            <div class="row">
                                <div class="col col-6">
                                    <section>
                                        {{ Form::label('name','Category name',array('class'=>'label')) }}
                                        <label class="input" for="">
                                            {{ Form::text('name','',
                                            array(
                                            'id' => 'name',
                                            'class' => 'form-control input-sm',
                                            'placeholder' => 'category name',
                                            'required'
                                            )
                                            )}}
                                        </label>
                                    </section>
                                    <section>
                                        {{ Form::label('parent_id','Parent',array('class'=>'label')) }}
                                        <label class="select" for="">
                                            <select class="selectpicker form-control input-sm" name="parent_id">
                                                @foreach ($categories as $parent)
                                                    <option value="{{ $parent->id }}" >
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
                                        <label class="toggle"  style="width:100px;">
                                            <input type="checkbox" name="active" checked>
                                            <i data-swchon-text="Yes" data-swchoff-text="No"></i>Active</label>
                                        </label>
                                    </section>
                                    <section>
                                        {{ Form::label('controller','Type',array('class'=>'label')) }}
                                        <label class="select" for="">
                                            <select class="selectpicker form-control input-sm" id="controller" name="controller">
                                                <option value="">Type of category</option>
                                                @foreach ($controllers as $controller)
                                                    <option value="{{$controller->controller}}">{{$controller->name}}</option>
                                                @endforeach
                                            </select>
                                            <i></i>
                                        </label>

                                    </section>
                                    <section id="template-option" class="well">

                                    </section>
                                    <section>
                                        {{ Form::label('slug','Permalink: '.url().'/',array('id'=>'permalink','class'=>'label')) }}
                                        <label class="input" for="">
                                            {{ Form::text('slug','',
                                            array(
                                            'id' => 'slug',
                                            'class' => 'form-control input-sm',
                                            'placeholder' => 'Category slug',
                                            'required'
                                            )
                                            )}}</label>
                                    </section>
                                    <section>
                                        {{ Form::label('description','Description',array('class'=>'label')) }}
                                        <label for="description" class="textarea">
                                            {{ Form::textarea('description',null,
                                        array(
                                        'id' => 'description',
                                        'class' => 'editor',
                                        'placeholder' => 'category description',
                                        )
                                        )}}
                                        </label>
                                    </section>
                                </div>
                            </div>
                        </fieldset>
                        <footer>
                            <button type="submit" class="btn btn-sm btn-primary pull-left">Save</button>
                        </footer>
                        {{ Form::close() }}
                    </div>
                    <!-- end widget content -->
                </div>
                <!-- end widget div -->
            </div>
        </article>
    </div>
</section>
<script type="text/javascript">
    pageSetUp();
    renderEditor();
    getSlug('#name','#slug');
    var pagefunction = function() {

        var getTemplateOption = function (controller) {

            $.ajax({
                sync: false,
                type:'GET',
                url:'{{url("admin/categories/template")}}/'+controller,
                success: function(rs){
                    $('#template-option').html(rs);
                }
            });
        };
        $('#controller').change(function(e){

            var controller = $(this).val();

            getTemplateOption(controller);

            $('#permalink').text('Permalink: ' + '{{url()}}' +'/' + controller);

        });
    };

    pagefunction();

</script>


