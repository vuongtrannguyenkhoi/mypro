<!-- Content Header (Box header) -->
<section class="content-header">
    <h1>
        Post Manager
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
                    <h2>Posts</h2>
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
                            <a href="#posts/create" class="btn btn-sm btn-default">Add new</a>
                        </p>

                        <div class="table-responsive">

                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Date</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($posts as $post)
                                <tr>
                                    <td>
                                        <strong><a href="#posts/{{$post->id}}/edit" class="row-title">{{ $post->name }}</a></strong>
                                        </td>
                                    <td>{{ $post->author }}</td>
                                    <td>{{ $post->created_at }} ({{$post->status}})</td>
                                    <td>
                                        {{ Form::open(array(
                                        'route'=>array('admin.posts.destroy',$post->id),
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
                            <div class="text-center">
                                {{ $posts->appends($query_string)->links() }}
                            </div>

                        </div>
                    </div>
                    <!-- end widget content -->
                </div>
                <!-- end widget div -->
            </div>
        </article>
    </div>
</section>
