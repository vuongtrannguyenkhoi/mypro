
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times;
    </button>
    <h4 class="modal-title" id="myModalLabel">Order category</h4>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <section>
                        <p class="alert alert-info">Drag to order</p>
                        <div id="orderResult"></div>

                    </section>
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
                                $.post(
                                        "{{ url('admin/categories/order-ajax') }}",
                                        {sortable: oSortable},
                                        function(data){
                                            $('#orderResult').html(data);
                                        }
                                );
                                location.reload();
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <input type="button" id="save" value="Save" class="btn btn-primary btn-sm">
    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">
        Cancel
    </button>
</div>


