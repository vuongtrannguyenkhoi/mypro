
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
                    <h2>Controller manager</h2>
                </header>

                <!-- widget div-->
                <div>

                    <!-- widget edit controller -->
                    <div class="jarviswidget-editcontroller">
                        <!-- This area used as dropdown edit controller -->

                    </div>
                    <!-- end widget edit controller -->

                    <!-- widget content -->
                    <div class="widget-body">
                        <p>
                            <a href="#controllers/create" class="btn btn-sm btn-default">Add new</a>
                        </p>

                        <div class="table-responsive">

                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Controller</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($controllers as $controller)
                                <tr>
                                    <td>
                                        <strong>
                                            <a href="#{{ 'controllers/'.$controller->id.'/edit' }}">{{ $controller->name }}</a>
                                        </strong>
                                        </td>
                                    <td>{{ $controller->controller }}</td>
                                    <td>
                                        {{ Form::open(array(
                                        'route'=>array('admin.controllers.destroy',$controller->id),
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



