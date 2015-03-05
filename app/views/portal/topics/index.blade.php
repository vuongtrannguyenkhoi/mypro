<!-- Content Header (Box header) -->
<section class="content-header">
    <h1>
        Post manager
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
                            <a href="#topics/create" class="btn btn-sm btn-primary">New</a>
                        </p>
                        {{ Datatable::table()
                        ->addColumn(
                        'Name',
                        'Forum',
                        'Created at',
                        'Updated at',
                        '',
                        ''
                        )       // these are the column headings to be shown
                        ->setUrl(route('portal.api.topics'))   // this is the route where data will be retrieved
                        ->render() }}
                    </div>
                    <!-- end widget content -->
                </div>
                <!-- end widget div -->
            </div>
        </article>
    </div>
</section>