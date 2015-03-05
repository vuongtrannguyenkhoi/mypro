<h1>Thông tin đặt hàng từ Baby Shop</h1>
<div style="width:700px;border:solid 10px #f00;padding:20px;overflow:hidden;text-align:justify;line-height:20px;font-size:13px;font-family:Verdana,Geneva,sans-serif;color:000;margin:0 auto"><div class="adM">
    </div><p style="margin:10px 0px"><b>Xin chào Quý khách {{ $customer_name }}</b></p>
    Chúng tôi xin trân trọng thông báo đến Quý khách về thông tin <span class="il">đơn</span> <span class="il">hàng</span> của Quý khách như sau:<br>
    <div style="width:680px;margin:20px 0px;padding:10px;background-color:#e1e1e1;color:#000000;overflow:hidden">
        <b>THÔNG TIN <span class="il">ĐƠN</span> <span class="il">HÀNG</span></b><br><b>Mã <span class="il">đơn</span> <span class="il">hàng</span>: </b>{{ $order_code }}<br><b>Họ tên: </b>{{ $customer_name }}<br><b>Điện thoại: </b>{{ $phone }}<br><b>Email: </b><a href="mailto:{{ $email }}" target="_blank">{{ $email }}</a><br>
        <b>Địa chỉ: </b> {{ $address }}<br>
        <b>Ghi chú: </b> {{ $note }}<br>
        <b>CHI TIẾT <span class="il">ĐƠN</span> <span class="il">HÀNG</span></b><br>
        <table border="0" cellpadding="5px" cellspacing="1px" style="font-family:Verdana,Geneva,sans-serif;font-size:11px" width="100%">
            <tbody>
            <tr bgcolor="#027ab2">
                <td style="font-weight:bold;color:#fff">STT</td>
                <td style="font-weight:bold;color:#fff">Tên</td>
                <td align="center" style="font-weight:bold;color:#fff">SL</td>
                <td align="center" style="font-weight:bold;color:#fff">Vật liệu</td>
            </tr>
            <?php $i=1 ?>
            @foreach ($cart as $key => $row)
            <tr bgcolor="#FFFFFF">
                <td width="5%" align="center">{{ $i++ }}</td>
                <td width="30%">{{ $row->name }}</td>
                <td width="5%" align="center">{{ $row->qty }}</td>
                <td width="5%" align="center">{{ $row->options['material'] }}</td>
            </tr>
            @endforeach
            </tbody></table>
    </div>
</div>