<!-- Content Header (Box header) -->
<section class="content-header">
    <h1>
        Orders
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
                    <h2>Orders / {{ $order->order_code }}</h2>
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
                        <h2>Customer Information</h2>
                        <dl class="dl-horizontal">
                            <dt>Order code</dt>
                            <dd>{{ $order->order_code }}</dd>
                            <dt>Customer name</dt>
                            <dd>{{ $order->customer_name }}</dd>
                            <dt>Phone</dt>
                            <dd>{{ $order->phone }}</dd>
                            <dt>Address</dt>
                            <dd>{{ $order->address }}</dd>
                            <dt>Email</dt>
                            <dd>{{ $order->email }}</dd>
                            <dt>Order date</dt>
                            <dd>{{ $order->date }}</dd>
                            <dt>Note</dt>
                            <dd>{{ $order->note }}</dd>
                        </dl>
                        <h2>Order items</h2>
                        <table class="table table-hover table-striped table-bordered">
                        	<thead>
                        		<tr>
                        			<th>#</th>
                        			<th>Item name</th>
                        			<th>Quantity</th>
                        			<th>Material</th>
                        		</tr>
                        	</thead>
                        	<tbody>
                                @foreach ($order->getOrderItems() as $item)
                                <tr>
                                    <td class="count"></td>
                                    <td>{{ $item->product_name }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>{{ $item->material }}</td>
                                </tr>
                                @endforeach

                        	</tbody>
                        </table>
                    </div>
                    <!-- end widget content -->
                </div>
                <!-- end widget div -->
            </div>
        </article>
    </div>
</section>



