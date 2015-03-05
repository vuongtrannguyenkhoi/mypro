<!-- Content Header (User header) -->
<section class="content-header">
    <h1>
        Gallery/Photo Manager
    </h1>
</section>
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
                    <h2><a href="#galleries" class=" back-link-icon" title="Back to gallery manager"><i class="fa fa-arrow-circle-o-left"></i></a></h2>
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
                            <a href="#galleries/{{$gallery}}/photos/create" class="btn btn-sm btn-default">Add new</a>
                        </p>

                        <div class="table-responsive">

                            <table class="table table-bordered table-hover" id="sortable">
                                <tbody class="ui-sortable">
                                @foreach($photos as $photo)
                                <tr data-photo-id="{{ $photo->id }}">
                                    <td class="">
                              <span class="sortable-handler" style="cursor: move;" title="Drag to order photo ">
                              <span class="glyphicon glyphicon-sort"></span>
                              </span>

                                    <td>
                                        <a href="#galleries/{{$gallery}}/photos/{{$photo->id}}/edit"><img src="{{ url($photo->thumb) }}" alt="" title="Click to edit"/></a>
                                        {{ Form::open(array(
                                        'route'=>array('admin.galleries.photos.destroy',$gallery,$photo->id),
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
                    <!-- end widget content -->
                </div>
                <!-- end widget div -->
            </div>
        </article>
    </div>
</section>

<script>
    $("#sortable tbody").sortable({
        revert: 200 ,
        handle: 'td:first',
        start: function(e, ui){
            // var item = ui.item;
            // var group = $(item).data('group');
            // $('tbody tr:not(.group_'+group+')').hide(500);
        },
        stop: function(e, ui){
            var photos = [];
            var trs = $(this).find('tr').each(function(index, elm){
                photos.push( $(elm).data('photo-id') );
            });
            $.ajax({
                type: 'POST',
                url: "{{ url('admin/photos/update-order') }}",
                data: {
                    photos : photos
                },
                success: function(msg){
                    console.log(msg);
                    $('tbody tr').hide(100);
                    $('tbody tr').show(500);
                },
                error : function( data ){
                }
            });
        }
    }).disableSelection();
</script>


