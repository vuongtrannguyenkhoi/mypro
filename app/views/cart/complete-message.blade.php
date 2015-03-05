<!DOCTYPE html>
<html>
<head>
    <title>Message</title>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400italic,700italic,400,700&subset=latin,vietnamese' rel='stylesheet' type='text/css'>
    {{ HTML::script('frontend/assets/js/jquery-1.10.2.min.js') }}
    <!-- bootstrap !-->
    {{ HTML::script('frontend/assets/bootstrap/js/bootstrap.min.js') }}
    {{ HTML::style('frontend/assets/bootstrap/css/bootstrap.min.css') }}
    <!-- end bootstrap -->
    <!-- style !-->
    <!-- end style -->
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1>Xác nhận đơn hàng</h1>
            <p>Chúng tôi đã nhận được đơn hàng và sẽ liên hệ với bạn trong thời gian nhanh nhất</p>
            <p>Kiểm tra Email để xem đơn hàng</p>
            <p><a href="{{ url('/') }}">Tiếp tục mua hàng</a></p>
        </div>
    </div>
</div>
</body>
</html>