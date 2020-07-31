<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    
    <title>In hóa đơn</title>
    <style>
      body{
        font-family: DejaVu Sans, sans-serif, font-size: 12px;
      }
    </style>
  </head>
  
  <body >
    <div>
      <b><span>Flower Shop</span></b><br>
      Số điện thoại: 0123456789<br>
      Website: http://flowershop.com
    </div><hr>
    <center><h2>ĐƠN ĐẶT HÀNG SỐ {{$donhang->id}}</h2></center>
    
    <table>
      <tr>
        <td width="120px"><strong>Khách mua hàng:</strong></td> <td>{!!$khachhang->khachhang_ten!!}</td>
        <td><strong></td>
      </tr>
      <tr>
        <td width="120px"><strong>Địa chỉ:</strong></td> <td>{!!$khachhang->khachhang_dia_chi!!}</td>
        <td></td>
      </tr>
      <tr>
        <td width="120px"><strong>Điện thoại:</strong></td> <td> {!!$khachhang->khachhang_sdt!!}</td>
        <td></td>
      </tr>
      <tr>
        <td width="120px"><strong>Email:</strong></td> <td> {!!$khachhang->khachhang_email!!}</td>
        <td></td>
      </tr>
      <tr>
        <td width="120px"><strong>Khách nhận hàng:</strong></td> <td>{!!$donhang->donhang_nguoi_nhan!!}</td>
        <td><strong></td>
      </tr>
      <tr>
        <td width="120px"><strong>Địa chỉ:</strong></td> <td>{!!$donhang->donhang_nguoi_nhan_dia_chi!!}</td>
        <td></td>
      </tr>
      <tr>
        <td width="120px"><strong>Điện thoại:</strong></td> <td> {!!$donhang->donhang_nguoi_nhan_sdt!!}</td>
        <td></td>
      </tr>
      <tr>
        <td width="120px"><strong>Email:</strong></td> <td> {!!$donhang->donhang_nguoi_nhan_email!!}</td>
        <td></td>
      </tr>
    </table><br><br>
    <table cellpadding="3px" style="border:thin solid;" >
      <thead>
        <tr>
          <td style="border:thin solid;" width="50px"><strong>STT</strong></td>
          <td style="border:thin solid;" width="150px"><strong>Tên sản phẩm</strong></td>
          <td style="border:thin solid;" width="50px"><strong>Số lượng</strong></td>
          <td style="border:thin solid;" width="150px"><strong>Đơn giá</strong></td>
          <td style="border:thin solid;" width="150px"><strong>Thành tiền</strong></td>
        </tr>
      </thead>
      <tbody>
        <?php $count = 0; ?>
            @foreach ($chitietdonhang as $val)
            <tr >
              <td style="border:thin blue solid;border-style:dashed;">{!! $count = $count + 1 !!}</td>
              <td style="border:thin blue solid;border-style:dashed;">
                  <?php  
                      $sp = DB::table('sanpham')->where('id',$val->sanpham_id)->first();
                      print_r($sp->sanpham_ten);
                  ?>
              </td>
              <td style="border:thin blue solid;border-style:dashed;">{!! $val->chitietdonhang_so_luong !!}</td>
              <td style="border:thin blue solid;border-style:dashed;">
              {!! number_format($val->chitietdonhang_thanh_tien/$val->chitietdonhang_so_luong,0,",",".") !!} vnđ 
              </td>
              
              <td style="border:thin blue solid;border-style:dashed;" >{!! number_format("$val->chitietdonhang_thanh_tien",0,",",".") !!} vnđ </td>
          </tr>
            @endforeach
            
      </tbody>
    </table>
    <table class="sumary-table">
      <tr>
              <td  width="150px" >
                    <b>Ghi chú :</b>
              </td>
              <td colspan="8">
                    @if (!empty($donhang->donhang_ghi_chu))
                            {{ $donhang->donhang_ghi_chu }}
                          @else
                            Không có ghi chú
                          @endif
                </td>
            </tr>
            <tr>
              <td  width="200px" >
                    <b>Trả trước :</b>
              </td>
              <td colspan="4">
                    @if($donhang->donhang_paid == 1)
                        {{'Có'}}
                        @else
                        {{'Không'}}
                        @endif
                </td>
            </tr>
      <tr>
        <td width="200px">Giá trị đơn hàng</td>
        <td width="152px">{!! number_format($donhang->donhang_tong_tien, 0, ",", ".") !!} vnđ</td>
      </tr>
      <!-- <tr>
        <td width="200px">Tổng giá trị</td>
        <td width="152px" style="border:thin blue solid;border-style:dashed;">{!! number_format($donhang->donhang_tong_tien, 0, ",", ".") !!} vnđ</td>
      </tr> -->
    </table><br>
    <table style="margin-bottom:-300px;">
      <tr>
        <td width="500px"></td>
        <td>Ngày lập: <?php echo date("d-m-Y") ?></td>
      </tr>
      <tr>
        <td width="500px" class="customer-title">   <strong>Khách nhận hàng</strong></td>
        <td class="writer-title"><strong>Người lập phiếu</strong></td>
      </tr>
      <tr>
        <td>(Ký và ghi rõ họ tên)</td>
        <td class="writer-name"><span>(Ký và ghi rõ họ tên)</span></td>
      </tr>
    </table>
  </body>
</html>
    
