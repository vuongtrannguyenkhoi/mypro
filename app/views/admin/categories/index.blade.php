
<!-- Main content -->
<section id="widget-grid">
    <div class="row">
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-0" data-widget-colorbutton="true">
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
                <header>
                    <h2>Category manager</h2>
                </header>

                <!-- widget div-->
                <div>

                    <!-- widget edit box -->
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->

                    </div>
                    <!-- end widget edit box -->

                    <!-- widget content -->
                    <div class="widget-body">
                        <p>
                            <a href="#categories/create" class="btn btn-sm btn-default">Add new</a> -
                            <a data-target="#remoteModal" data-toggle="modal" href="{{ url('admin/categories/modal-order') }}">Order categories</a>
                        </p>

                        <div class="table-responsive">

                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Active</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $category)
                                <tr>
                                    <td>@for ($i = 0; $i < $category->depth; $i++)
                                        +
                                        @endfor
                                        <strong>
                                            <a href="#{{ 'categories/'.$category->id.'/edit' }}">{{ $category->name }}</a>
                                        </strong>
                                        </td>
                                    <td>
                                        <a href="javascript:void(0);"
                                           onClick="changeActiveStatus(this);"
                                           data-id = "{{ $category->id }}"
                                           data-method = 'post'
                                           data-request = "{{ url('admin/api/categories/updateActiveStatus') }}"
                                           data-value = {{ $category->active ? 0:1}}
                                        class="btn btn-default btn-xs">
                                        <i class="glyphicon @if ($category->active)
                                                glyphicon-ok
                                            @else
                                                glyphicon-minus
                                            @endif"></i>
                                        </a>
                                    </td>
                                    <td>
                                        {{ Form::open(array(
                                        'route'=>array('admin.categories.destroy',$category->id),
                                        'class' => 'pull-right'
                                        )) }}
                                        {{ Form::hidden('_method', 'DELETE') }}
                                        {{ Form::submit('delete', array('class' => 'btn btn-primary btn-xs')) }}
                                        {{ Form::close() }}
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                    <!-- end widget content
                </div>
                <!-- end widget div -->
                </div>
        </article>
    </div>
</section>

<div class="modal fade" id="remoteModal" tabindex="-1" role="dialog" aria-labelledby="remoteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

        </div>
    </div>
</div>

<script>
    function changeActiveStatus(el){
        var _this = $(el);
        var method = _this.data('method');
        var request = _this.data('request');
        $.ajax({
            type: method,
            url: request,
            data:{
                id:_this.data('id'),
                value: _this.data('value')
            },
            beforeSend: function () {

            },
            error: function () {

            },
            success: function (rs) {
                var rs = $.parseJSON(rs);
                var message = $('#alert');
                if(_this.data('value') == 1){
                    _this.data('value',0);
                    _this.find('i').removeClass('glyphicon-minus').addClass('glyphicon-ok');
                }
                else{
                    _this.data('value',1);
                    _this.find('i').removeClass('glyphicon-ok').addClass('glyphicon-minus');
                }
                $('#alert').find('.message').text(rs.message);
                message.fadeIn(1000,function(){
                    message.fadeOut(5000);
                });
            }
        });
    }
</script>
