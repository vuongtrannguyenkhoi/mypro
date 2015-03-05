
<!-- Main content -->
<section id="widget-grid">
    <div class="row">
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="jarviswidget jarviswidget-color-blueDark">
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
                    <h2>User manager</h2>
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
                            <a href="#users/create" class="btn btn-sm btn-default">Add new</a>
                        </p>

                        {{ Datatable::table()
                        ->addColumn(
                        'Username',
                        'Role',
                        'Status',
                        ''
                        )       // these are the column headings to be shown
                        ->setUrl(route('admin.api.users'))   // this is the route where data will be retrieved
                        ->render() }}
                    </div>
                    <!-- end widget content -->
                </div>
                <!-- end widget div -->
            </div>
        </article>
    </div>
</section>



