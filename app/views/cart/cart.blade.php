@extends('master')

@section('content')
<div class="body-content">
    <div class="container">
        <div class="row">
            <div class="content">
                <div class="col-lg-3">
                    <div class="aside-left">
                        <div class="row">
                            <div class="col-lg-12">
                                <h2 class="aside-left-header-title">DANH MỤC SẢN PHẨM</h2>
                                <div class="aside-nav">
                                    <ul>
                                        <li>
                                            <h3 class="aside-nav-title">BÉ GÁI</h3>
                                            <ul class="aside-nav-sub">
                                                @foreach ($girlCategories as $girlCategory)
                                                <li>
                                                    <a href="{{ url('posts/'.$girlCategory->slug) }}">{{ $girlCategory->name }}</a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        <li>
                                            <h3 class="aside-nav-title">BÉ TRAI</h3>
                                            <ul class="aside-nav-sub">
                                                @foreach ($boyCategories as $boyCategory)
                                                <li>
                                                    <a href="{{ url('posts/'.$boyCategory->slug) }}">{{ $boyCategory->name }}</a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="search-form">
                                <form action="{{ url('search') }}">
                                    <input class="form-control" type="text" placeholder="Tìm kiếm" name="q"/>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="box">
                                <div class="box-header">
                                    <h2 class="box-title">LIÊN HỆ</h2>
                                </div>
                                <div class="box-body">
                                    {{ $box['left-address']->content }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <h2 class="content-header-title">
                        GIỎ HÀNG
                    </h2>
                    <div class="row">
                        <div class="col-lg-12">
                            {{ Form::open() }}
                                <table class="table table-striped table-condensed">
                                    <thead>
                                    <tr>
                                        <th>Tên sản phẩm</th>
                                        <th>Số lượng</th>
                                        <th>Chất liệu</th>
                                        <th></th>
                                    </tr>
                                    </thead>

                                    <tbody>

                                    @foreach ($cart as $row)
                                    <tr id="{{ $row->rowid }}">
                                        <td><strong>{{ $row->name }}</strong></td>
                                        <td><input type="text" name="{{$row->rowid}}" value="{{$row->qty}}"></td>
                                        <td>{{ $row->options['material'] }}</td>
                                        <td><a class="item-remove" data-item-id="{{ $row->rowid }}"><span class="glyphicon glyphicon-remove"></span></a></td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td><button class="btn btn-warning update-items">Cập nhật đơn hàng</button><span class="loader"></span></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    </tr>
                                    </tbody>
                                </table>
                            {{ Form::close() }}
                            <a href="{{ url() }}" class="btn btn-primary">Tiếp tục mua hàng</a>
                            <a href="{{ url('cart/checkout') }}" class="btn btn-primary">Thanh toán</a>
                            <script>
                                $('.item-remove').click(function(){
                                    var item_id = $(this).data('item-id');
                                    $.ajax({
                                        type: 'GET',
                                        url: "{{url('cart/remove')}}" +'/'+item_id,//server
                                        beforeSend: function(){

                                        },
                                        error: function(){

                                        },
                                        success: function(msg){
                                            var message = $.parseJSON(msg);
                                            if (message.status == 1) {
                                                $('#'+item_id).remove();
                                            }else{
                                                alert('error');
                                            }
                                        }
                                    });
                                });

                                $('.update-items').click(function(e){
                                    var d =  $("form").serialize();
                                    $.ajax({
                                        type: 'POST',
                                        data: d,
                                        url: "{{ url('cart/update') }}",
                                        beforeSend: function(){
                                        },
                                        error: function(){

                                        },
                                        success: function(msg){
                                            var rs = $.parseJSON(msg);
                                            alert(rs.message);
                                        }
                                    });
                                    e.preventDefault();
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop