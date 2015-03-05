
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Order categories
    </h1>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <section>
                        <p class="alert alert-info">Drag to order</p>
                        <div id="orderResult"></div>
                        <input type="button" id="save" value="Save" class="btn btn-primary">
                    </section>
                    {{ HTML::script( url('backend/js/jquery-ui-1.10.3.custom.min.js'))}}
                    {{ HTML::script( url('backend/js/jquery.mjs.nestedSortable.js'))}}
                    <script>
                        $(document).ready(function(){
                            $.post( "{{ url('admin/categories/order-ajax') }}",
                                {},
                                function(data){
                                    $('#orderResult').html(data);
                                }
                            );
                            $('#save').click(function(){
                                oSortable = $('.sortable').nestedSortable('toArray');

                                $('#orderResult').slideUp(function(){
                                    $.post(
                                        "{{ url('admin/categories/order-ajax') }}",
                                        {sortable: oSortable},
                                        function(data){
                                            $('#orderResult').html(data);
                                        }
                                    );
                                    $('#orderResult').slideDown();
                                });
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</section>
