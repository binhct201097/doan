<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB,Mail,Cart;
use App\Donhang;
use App\Chitietdonhang;
use App\Http\Requests\ThanhtoanRequest;
use App\Khachhang;
use App\User;

class VnPayController extends Controller
{
    public function payment(ThanhtoanRequest $request) {
        if($request->payment_method  == 'normal')
        {
            $content = Cart::content();
            $total = Cart::total();

            $donhang = new Donhang;
            $donhang->donhang_nguoi_nhan = $request->txtNNName;
            $donhang->donhang_nguoi_nhan_email = $request->txtNNEmail;
            $donhang->donhang_nguoi_nhan_sdt = $request->txtNNPhone;
            $donhang->donhang_nguoi_nhan_dia_chi = $request->txtNNAddr;
            $donhang->donhang_ghi_chu = $request->txtNNNote;
            $donhang->donhang_tong_tien = $total;
            $donhang->khachhang_id = $request->txtKHID;
            $donhang->tinhtranghd_id = 1;          
            $donhang->donhang_payment = 'COD';

            $donhang->save();
            
            // dd($donhang->id);
            foreach ($content as $item) {
                $detail = new Chitietdonhang;
                $detail->sanpham_id = $item->id;
                $detail->donhang_id = $donhang->id;
                $detail->chitietdonhang_so_luong = $item->qty;
                $detail->chitietdonhang_thanh_tien = $item->price*$item->qty;
                $detail->save();
            }
            $kh = DB::table('khachhang')->where('id', $request->txtKHID)->first();
            // print_r($kh);
            $donhang = [
                'id'=> $donhang->id,
                'donhang_nguoi_nhan'=> $request->txtNNName,
                'donhang_nguoi_nhan_email' => $request->txtNNEmail,
                'donhang_nguoi_nhan_sdt' => $request->txtNNPhone,
                'donhang_nguoi_nhan_dia_chi' => $request->txtNNAddr,
                'donhang_ghi_chu' => $request->txtNNNote,
                'donhang_tong_tien' => $total,
                'khachhang_id' => $request->txtKHID,
                'khachhang_email'=>$kh->khachhang_email,
                ];
            // dd($donhang);
                    
            Mail::send('auth.emails.hoadonkhach', $donhang, function ($message) use ($donhang) {
                $message->from('appnsfw@gmail.com', 'FlowerShop');
            
                $message->to($donhang['khachhang_email'], 'Khách hàng');
            
                $message->subject('Cảm ơn quý khách đã mua hàng tại FlowerShop!!!');
            });

            Mail::send('auth.emails.hoadonadmin', $donhang, function ($message) use ($donhang) {
                $message->from('appnsfw@gmail.com', 'Thông báo');
            
                $message->to('appnsfw@gmail.com', 'QTV');
            
                $message->subject('Hóa đơn số '.$donhang['id']);
            });

            Cart::destroy();
            echo "<script>
              alert('Bạn đã đặt mua sản phẩm thành công!');
              window.location = '".url('/')."';</script>";
        }
        else if($request->payment_method == 'vnpay')
        {
            $content = Cart::content();
            $total = Cart::total();

            $donhang = new Donhang;
            $donhang->donhang_nguoi_nhan = $request->txtNNName;
            $donhang->donhang_nguoi_nhan_email = $request->txtNNEmail;
            $donhang->donhang_nguoi_nhan_sdt = $request->txtNNPhone;
            $donhang->donhang_nguoi_nhan_dia_chi = $request->txtNNAddr;
            $donhang->donhang_ghi_chu = $request->txtNNNote;
            $donhang->donhang_tong_tien = $total;
            $donhang->khachhang_id = $request->txtKHID;
            $donhang->tinhtranghd_id = 1;
            $donhang->donhang_payment = 'VnPay';
            $donhang->save();

            // gui thong tin don hang de thanh toan
            $response = \VNPay::purchase([
                'vnp_TxnRef' => $donhang->id,
                'vnp_OrderType' => 210000,
                'vnp_OrderInfo' => "Thanh toán hóa đơn phí dich vụ",
                'vnp_IpAddr' => request()->ip(),
                'vnp_Amount' => $total * 100,
                'vnp_ReturnUrl' => 'http://localhost/zoo/responsePayment',
            ])->send();           
            if ($response->isRedirect()) {
                $redirectUrl = $response->getRedirectUrl();
                return redirect()->away($redirectUrl);
            }
        }
    }

    public function responsePayment() 
    {
        $response = \VNPay::completePurchase()->send();

        if ($response->isSuccessful()) {
            $order_code = $response->getData()['vnp_TxnRef'];
            DB::table('donhang')->where('id', $order_code)->update(['donhang_paid' => 1]);

            $donhang = DB::table('donhang')->where('id', $order_code)->first();
            $content = Cart::content();
            $total = Cart::total();
            foreach ($content as $item) {
            $detail = new Chitietdonhang;
            $detail->sanpham_id = $item->id;
            $detail->donhang_id = $donhang->id;
            $detail->chitietdonhang_so_luong = $item->qty;
            $detail->chitietdonhang_thanh_tien = $item->price*$item->qty;
            $detail->save();
            }

            $kh = DB::table('khachhang')->where('id', $donhang->khachhang_id)->first();
            // dd($kh);
            $donhang = [
                'id'=> $donhang->id,
                'donhang_nguoi_nhan'=> $donhang->donhang_nguoi_nhan,
                'donhang_nguoi_nhan_email' => $donhang->donhang_nguoi_nhan_email,
                'donhang_nguoi_nhan_sdt' => $donhang->donhang_nguoi_nhan_sdt,
                'donhang_nguoi_nhan_dia_chi' => $donhang->donhang_nguoi_nhan_dia_chi,
                'donhang_ghi_chu' => $donhang->donhang_ghi_chu,
                'donhang_tong_tien' => $total,
                'khachhang_id' => $donhang->khachhang_id,
                'khachhang_email'=>$kh->khachhang_email,
                ];
            // dd($donhang);
                    
            Mail::send('auth.emails.hoadonkhach', $donhang, function ($message) use ($donhang) {
                $message->from('appnsfw@gmail.com', 'FlowerShop');
            
                $message->to($donhang['khachhang_email'], 'Khách hàng');
            
                $message->subject('Cảm ơn quý khách đã mua hàng tại FlowerShop!!!');
            });

            Mail::send('auth.emails.hoadonadmin', $donhang, function ($message) use ($donhang) {
                $message->from('appnsfw@gmail.com', 'Thông báo');
            
                $message->to('appnsfw@gmail.com', 'QTV');
            
                $message->subject('Hóa đơn số '.$donhang['id']);
            });

            Cart::destroy();
            echo "<script>
                alert('Bạn đã đặt mua sản phẩm thành công!');
                window.location = '".url('/')."';</script>";
        } else {
            echo "<script>
                alert('Đã hủy thanh toán!');
                window.location = '".url('/')."';</script>";
        }
    }
}
