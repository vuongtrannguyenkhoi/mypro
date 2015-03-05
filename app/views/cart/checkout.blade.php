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
                        XÁC NHẬN ĐƠN HÀNG
                    </h2>
                    <div class="row">
                        <div class="col-lg-12">
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
                                    <td>Thun</td>
                                    <td><a class="item-remove" data-item-id="{{ $row->rowid }}"><span class="glyphicon glyphicon-remove"></span></a></td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-12">
                            <hr>
                            <h3>Thông tin đặt hàng</h3>
                            {{ Form::open(array(
                            'class' => 'form order-form form-horizontal',
                            'role'  => 'form',
                            'url'   => url('cart/checkout'),
                            )) }}
                            <div class="form-group">
                                <label for="customer_name"  class="col-sm-2 control-label">Họ tên*</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="customer_name" id="customer_name" value="{{ isset($customer) ? $customer->customer_name : '' }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="phone"  class="col-sm-2 control-label">Số điện thoại*</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="phone" id="phone" value="{{ isset($customer) ? $customer->phone : ''}}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address"  class="col-sm-2 control-label">Địa chỉ*</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="address" id="address" value="{{ isset($customer) ? $customer->address : ''}}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email"  class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" name="email" id="email" value="{{ isset($customer) ? $customer->email : ''}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="note"  class="col-sm-2 control-label">Ghi chú</label>
                                <div class="col-sm-10">
                                    <textarea name="note" id="note" cols="30" rows="10" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" id="checkout" class="btn btn-sm btn-primary">Xác nhận đơn hàng</button>
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop