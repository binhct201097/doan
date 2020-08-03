<?php

namespace App\Http\Controllers;

use App\Chitietdonhang;
use Cart;
use DB;
use Illuminate\Http\Request;
use Mail;
use Srmklive\PayPal\Services\ExpressCheckout;

class PaypalController extends Controller
{
    public function getExpressCheckout($donhangId)
    {
        $data = $this->cartData($donhangId);
        // dd($data);

        $provider = new ExpressCheckout();

        $response = $provider->setExpressCheckout($data);

        // dd($response);

        // This will redirect user to PayPal
        return redirect($response['paypal_link']);
    }

    protected function cartData($donhangId)
    {
        $data = [];
        $data['items'] = [];
        foreach (Cart::content() as $key => $cart) {
            $itemDetail = [
                'name' => $cart->name,
                'price' => $cart->price,
                'qty' => $cart->qty,
            ];

            $data['items'][] = $itemDetail;
        }

        $data['invoice_id'] = uniqid();
        $data['invoice_description'] = "Test invoice";
        $data['return_url'] = route('paypal.success', $donhangId);
        $data['cancel_url'] = route('paypal.cancel', $donhangId);
        // dd($data);
        $total = 0;
        foreach ($data['items'] as $item) {
            $total += $item['price'] * $item['qty'];
        }
        $data['total'] = $total;

        return $data;

    }

    public function cancelPage(Request $request, $donhangId)
    {
        DB::table('donhang')->where('id', $donhangId)->delete();

        echo "<script>
            alert('Đã hủy thanh toán thành công!');
            window.location = '" . url('/') . "';</script>";
    }

    public function getExpressCheckoutSC(Request $request, $donhangId)
    {
        $provider = new ExpressCheckout;

        $token = $request->token;
        // dd($token);
        $payerId = $request->PayerID;

        $data = $this->cartData($donhangId);

        $response = $provider->getExpressCheckoutDetails($token);

        // $invoiceId=$response['INVNUM']??uniqid();

        // $data = $this->cartData($invoiceId);

        // $response = $provider->doExpressCheckoutPayment($data, $token, $PayerID);
        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {

            // Perform transaction on PayPal
            $payment_status = $provider->doExpressCheckoutPayment($data, $token, $payerId);
            $status = $payment_status['PAYMENTINFO_0_PAYMENTSTATUS'];

            if (in_array($status, ['Completed', 'Processed'])) {

                DB::table('donhang')->where('id', $donhangId)->update(['donhang_paid' => 1]);

                $donhang = DB::table('donhang')->where('id', $donhangId)->first();
                $content = Cart::content();
                $total = Cart::total();
                foreach ($content as $item) {
                    $detail = new Chitietdonhang;
                    $detail->sanpham_id = $item->id;
                    $detail->donhang_id = $donhang->id;
                    $detail->chitietdonhang_so_luong = $item->qty;
                    $detail->chitietdonhang_thanh_tien = $item->price * $item->qty;
                    $detail->save();
                }
                $kh = DB::table('khachhang')->where('id', $donhang->khachhang_id)->first();
                // dd($kh);
                $donhang = [
                    'id' => $donhang->id,
                    'donhang_nguoi_nhan' => $request->txtNNName,
                    'donhang_nguoi_nhan_email' => $request->txtNNEmail,
                    'donhang_nguoi_nhan_sdt' => $request->txtNNPhone,
                    'donhang_nguoi_nhan_dia_chi' => $request->txtNNAddr,
                    'donhang_ghi_chu' => $request->txtNNNote,
                    'donhang_tong_tien' => $total,
                    'khachhang_id' => $donhang->khachhang_id,
                    'khachhang_email' => $kh->khachhang_email,
                ];
                // dd($donhang);

                Mail::send('auth.emails.hoadon', $donhang, function ($message) use ($donhang) {
                    $message->from('appnsfw@gmail.com', 'ADMIN');

                    $message->to($donhang['khachhang_email'], 'a');

                    $message->subject('Hóa đơn mua hàng tại AHT Mobile Shop!!!');
                });

                Mail::send('auth.emails.hoadon', $donhang, function ($message) use ($donhang) {
                    $message->from('appnsfw@gmail.com', 'ADMIN');

                    $message->to('appnsfw@gmail.com', 'KHÁCH HÀNG');

                    $message->subject('Hóa đơn mua hàng tại AHT Mobile Shop!!!');
                });

                //send mail

                Cart::destroy();
                echo "<script>
                  alert('Bạn đã đặt mua sản phẩm thành công!');
                  window.location = '" . url('/') . "';</script>";
            }

        }

        DB::table('donhang')->where('id', $donhangId)->delete();

        echo "<script>
            alert('Đã hủy thanh toán thành công!');
            window.location = '" . url('/') . "';</script>";
    }
}