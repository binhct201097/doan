<?php

namespace App\Http\Controllers;

use App\Binhluan;
use App\Http\Requests\BinhluanRequest;
use Cart;
use DB;
use Mail;
use Request;

class HomeController extends Controller
{
    public function index()
    {
        $loaisp = DB::table('loaisanpham')->get();
        $cate_product = DB::table('loaisanpham')->get();
        $product = DB::table('sanpham')->get();
        $product_new = DB::table('sanpham')
            ->join('lohang', 'sanpham.id', '=', 'lohang.sanpham_id')
            ->select(DB::raw('max(lohang.id) as lomoi'), 'sanpham.id', 'sanpham.sanpham_ten', 'sanpham.gia_ban', 'sanpham.sanpham_url', 'sanpham.sanpham_khuyenmai', 'sanpham.sanpham_anh', 'lohang.lohang_so_luong_nhap', 'lohang.lohang_so_luong_hien_tai')
            ->groupBy('sanpham.id')
            ->orderBy('id', 'DESC')->limit(12)
            ->paginate(4);

        $slide = DB::table('slides')->get();
        $promotion = DB::table('quangcao')->get();
        $baiviet = DB::table('baiviet')->get();

        $sanpham = DB::table('sanpham')
            ->join('lohang', 'sanpham.id', '=', 'lohang.sanpham_id')
            ->select(DB::raw('max(lohang.id) as lomoi'), 'sanpham.id', 'sanpham.sanpham_ten', 'sanpham.gia_ban', 'sanpham.sanpham_url', 'sanpham.sanpham_khuyenmai', 'sanpham.sanpham_anh', 'lohang.lohang_so_luong_nhap', 'lohang.lohang_so_luong_hien_tai')
            ->groupBy('sanpham.id')
            ->orderBy('id', 'ASC')
            ->paginate(8);
        // print_r($loaisp);
        return view('frontend.pages.home', compact('loaisp', 'product_new', 'baiviet', 'promotion', 'sanpham', 'cate_product', 'product', 'slide'));
    }

    public function group($url)
    {
        $id = DB::table('nhom')->select('id')->where('nhom_url', $url)->first();
        $i = $id->id;
        $id = DB::table('loaisanpham')->select('id')->where('nhom_id', $i)->get();
        foreach ($id as $key => $val) {
            $ids[] = $val->id;
        }
        $nhom = DB::table('nhom')->where('id', $i)->first();
        $sanpham = DB::table('sanpham')
            ->whereIn('sanpham.loaisanpham_id', $ids)
            ->join('lohang', 'sanpham.id', '=', 'lohang.sanpham_id')
            ->select(DB::raw('max(lohang.id) as lomoi'), 'sanpham.id', 'sanpham.sanpham_ten', 'sanpham.sanpham_url', 'sanpham.sanpham_khuyenmai', 'sanpham.sanpham_anh', 'lohang.lohang_so_luong_nhap', 'lohang.lohang_so_luong_hien_tai')
            ->groupBy('sanpham.id')
            ->paginate(15);
        return view('frontend.pages.group', compact('sanpham', 'nhom'));
    }

    public function cates($url)
    {
        $idLSP = DB::table('loaisanpham')->select('id')->where('loaisanpham_url', $url)->first();
        $i = $idLSP->id;
        $loaisanpham = DB::table('loaisanpham')->where('id', $i)->first();
        $sanpham = DB::table('sanpham')
            ->where('sanpham.loaisanpham_id', $i)
            ->join('lohang', 'sanpham.id', '=', 'lohang.sanpham_id')
            ->select(DB::raw('max(lohang.id) as lomoi'), 'sanpham.id', 'sanpham.sanpham_ten', 'sanpham.sanpham_url', 'sanpham.sanpham_khuyenmai', 'sanpham.sanpham_anh', 'lohang.lohang_so_luong_nhap', 'lohang.lohang_so_luong_hien_tai')
            ->groupBy('sanpham.id')
            ->paginate(15);
        $nhom = DB::table('nhom')->where('id', $loaisanpham->nhom_id)->first();
        return view('frontend.pages.cates', compact('sanpham', 'loaisanpham', 'nhom'));
    }

    public function baiviet()
    {
        $loaisp = DB::table('loaisanpham')->get();
        $cate_product = DB::table('loaisanpham')->get();
        $product = DB::table('sanpham')->get();
        $product_new = DB::table('sanpham')
            ->join('lohang', 'sanpham.id', '=', 'lohang.sanpham_id')
            ->select(DB::raw('max(lohang.id) as lomoi'), 'sanpham.id', 'sanpham.sanpham_ten', 'sanpham.gia_ban', 'sanpham.sanpham_url', 'sanpham.sanpham_khuyenmai', 'sanpham.sanpham_anh', 'lohang.lohang_so_luong_nhap', 'lohang.lohang_so_luong_hien_tai')
            ->groupBy('sanpham.id')
            ->orderBy('id', 'DESC')->limit(12)
            ->paginate(4);

        $slide = DB::table('slides')->get();
        $promotion = DB::table('quangcao')->get();
        // $baiviet = DB::table('baiviet')->get();

        $sanpham = DB::table('sanpham')
            ->join('lohang', 'sanpham.id', '=', 'lohang.sanpham_id')
            ->select(DB::raw('max(lohang.id) as lomoi'), 'sanpham.id', 'sanpham.sanpham_ten', 'sanpham.gia_ban', 'sanpham.sanpham_url', 'sanpham.sanpham_khuyenmai', 'sanpham.sanpham_anh', 'lohang.lohang_so_luong_nhap', 'lohang.lohang_so_luong_hien_tai')
            ->groupBy('sanpham.id')
            ->orderBy('id', 'ASC')
            ->paginate(8);
        // print_r($loaisp);

        $baiviet = DB::table('baiviet')->groupBy('baiviet.id')
            ->orderBy('id', 'ASC')
            ->paginate(3);
        return view('frontend.pages.baiviet', compact('baiviet', 'loaisp', 'product_new', 'promotion', 'sanpham', 'cate_product', 'product', 'slide'));
    }

    public function detailbaiviet($url)
    {
        $loaisp = DB::table('loaisanpham')->get();
        $cate_product = DB::table('loaisanpham')->get();
        $product = DB::table('sanpham')->get();
        $product_new = DB::table('sanpham')
            ->join('lohang', 'sanpham.id', '=', 'lohang.sanpham_id')
            ->select(DB::raw('max(lohang.id) as lomoi'), 'sanpham.id', 'sanpham.sanpham_ten', 'sanpham.gia_ban', 'sanpham.sanpham_url', 'sanpham.sanpham_khuyenmai', 'sanpham.sanpham_anh', 'lohang.lohang_so_luong_nhap', 'lohang.lohang_so_luong_hien_tai')
            ->groupBy('sanpham.id')
            ->orderBy('id', 'DESC')->limit(12)
            ->paginate(4);

        $slide = DB::table('slides')->get();
        $promotion = DB::table('quangcao')->get();

        $baivietchitiet = DB::table('baiviet')->where('baiviet_url', $url)->first();

        // var_dump($baivietchitiet);die;
        $id = DB::table('baiviet')->select('id')->where('baiviet_url', $url)->first();
        $id = $id->id;
        // print_r($i);
        // print_r($nglieu);
        return view('frontend.pages.detailbaiviet', compact('baivietchitiet', 'loaisp', 'product_new', 'promotion', 'sanpham', 'cate_product', 'product', 'slide'));
    }

    public function sanpham()
    {
        $loaisp = DB::table('loaisanpham')->get();
        $cate_product = DB::table('loaisanpham')->get();
        $product = DB::table('sanpham')->get();
        $product_new = DB::table('sanpham')
            ->join('lohang', 'sanpham.id', '=', 'lohang.sanpham_id')
            ->select(DB::raw('max(lohang.id) as lomoi'), 'sanpham.id', 'sanpham.sanpham_ten', 'sanpham.gia_ban', 'sanpham.sanpham_url', 'sanpham.sanpham_khuyenmai', 'sanpham.sanpham_anh', 'lohang.lohang_so_luong_nhap', 'lohang.lohang_so_luong_hien_tai')
            ->groupBy('sanpham.id')
            ->orderBy('id', 'DESC')->limit(12)
            ->paginate(4);

        $slide = DB::table('slides')->get();
        $promotion = DB::table('quangcao')->get();
        $baiviet = DB::table('baiviet')->get();

        $sanpham = DB::table('sanpham')
            ->join('lohang', 'sanpham.id', '=', 'lohang.sanpham_id')
            ->select(DB::raw('max(lohang.id) as lomoi'), 'sanpham.id', 'sanpham.sanpham_ten', 'sanpham.gia_ban', 'sanpham.sanpham_url', 'sanpham.sanpham_khuyenmai', 'sanpham.sanpham_anh', 'lohang.lohang_so_luong_nhap', 'lohang.lohang_so_luong_hien_tai')
            ->groupBy('sanpham.id')
            ->orderBy('id', 'ASC')
            ->paginate(20);
        return view('frontend.pages.sanpham', compact('loaisp', 'product_new', 'baiviet', 'promotion', 'sanpham', 'cate_product', 'product', 'slide'));
    }

    public function product($url)
    {
        $loaisp = DB::table('loaisanpham')->get();
        $cate_product = DB::table('loaisanpham')->get();
        $product = DB::table('sanpham')->get();
        $product_new = DB::table('sanpham')
            ->join('lohang', 'sanpham.id', '=', 'lohang.sanpham_id')
            ->select(DB::raw('max(lohang.id) as lomoi'), 'sanpham.id', 'sanpham.sanpham_ten', 'sanpham.gia_ban', 'sanpham.sanpham_url', 'sanpham.sanpham_khuyenmai', 'sanpham.sanpham_anh', 'lohang.lohang_so_luong_nhap', 'lohang.lohang_so_luong_hien_tai')
            ->groupBy('sanpham.id')
            ->orderBy('id', 'DESC')->limit(12)
            ->paginate(4);

        $slide = DB::table('slides')->get();
        $promotion = DB::table('quangcao')->get();
        $baiviet = DB::table('baiviet')->get();

        $sanpham = DB::table('sanpham')
            ->join('lohang', 'sanpham.id', '=', 'lohang.sanpham_id')
            ->select(DB::raw('max(lohang.id) as lomoi'), 'sanpham.id', 'sanpham.sanpham_ten', 'sanpham.gia_ban', 'sanpham.sanpham_url', 'sanpham.sanpham_khuyenmai', 'sanpham.sanpham_anh', 'lohang.lohang_so_luong_nhap', 'lohang.lohang_so_luong_hien_tai')
            ->groupBy('sanpham.id')
            ->orderBy('id', 'ASC')
            ->paginate(8);

        $idLSP = DB::table('sanpham')->select('id')->where('sanpham_url', $url)->first();
        $id = $idLSP->id;
        $lohangc = DB::table('lohang')->where('sanpham_id', $id)->orderBy('id', 'desc')->first();
        $sanpham = DB::table('sanpham')
            ->where('sanpham.id', $id)
        // ->join('lohang', 'sanpham.id', '=', 'lohang.sanpham_id')
        // ->where('lohang.id', '=', $lohangc->id)
        // ->join('donvitinh', 'sanpham.donvitinh_id', '=', 'donvitinh.id')
        // ->join('loaisanpham', 'sanpham.loaisanpham_id', '=', 'loaisanpham.id')
        // ->select('sanpham.id', 'sanpham.sanpham_ten', 'sanpham.loaisanpham_id', 'sanpham.sanpham_anh', 'sanpham.sanpham_mo_ta', 'sanpham.sanpham_url', 'sanpham.sanpham_khuyenmai', 'sanpham.sanpham_anh', 'sanpham.thong_so_ky_thuat', 'sanpham.gia_ban', 'lohang.lohang_so_luong_nhap', 'lohang.lohang_so_luong_hien_tai', 'donvitinh.donvitinh_ten', 'loaisanpham.loaisanpham_ten')
        // ->groupBy('sanpham.id')
            ->first();
        $hinhsanpham = DB::table('hinhsanpham')->where('sanpham_id', $id)->get();
        // $loaisanpham = DB::table('loaisanpham')->where('id', $sanpham['loaisanpham_id'])->first();
        // $nhom = DB::table('nhom')->where('id', $loaisanpham->nhom_id)->first();
        $binhluan = DB::table('binhluan')->where([['sanpham_id', $id], ['binhluan_trang_thai', 1]])->get();
        return view('frontend.pages.detailpro', compact('binhluan', 'loaisp', 'product_new', 'baiviet', 'promotion', 'sanpham', 'cate_product', 'product', 'slide', 'sanpham', 'hinhsanpham', 'lohangc'));
        // print_r($loaisanpham);
    }

    public function promotions()
    {
        $khuyenmai = DB::table('khuyenmai')->where('khuyenmai_tinh_trang', 1)->first();
        if (!is_null($khuyenmai)) {
            $spham = DB::table('sanphamkhuyenmai')
                ->where('khuyenmai_id', $khuyenmai->id)
                ->get();
        } else {
            $spham = null;
        }
        // print_r($km_old);
        return view('frontend.pages.promotion', compact('khuyenmai', 'spham'));
    }

    public function detailpromotions($url)
    {
        $khuyenmai = DB::table('khuyenmai')->where('khuyenmai_url', $url)->first();
        $id = DB::table('khuyenmai')->select('id')->where('khuyenmai_url', $url)->first();
        $id = $id->id;
        // print_r($i);
        $spham = DB::table('sanphamkhuyenmai')
            ->where('khuyenmai_id', $id)
            ->get();
        //$spham = DB::table('sanpham')->whereIn('id',$sphamid)->get();
        //print_r($spham);
        return view('frontend.pages.detailpromotion', compact('khuyenmai', 'spham'));
    }

    public function getContact()
    {
        return view('frontend.pages.contact');
    }

    public function postContact(Request $request)
    {
        $data = ['mail' => Request::input('txtMail'), 'name' => Request::input('txtName'), 'content' => Request::input('txtContent')];
        Mail::send('auth.emails.contactmail', $data, function ($message) {
            $message->from('appnsfw@gmail.com', 'Khách hàng');

            $message->to('appnsfw@gmail.com', 'Admin');

            $message->subject('Mail liên hệ!!!');
        });

        echo "<script>
         alert('Cảm ơn bạn đã góp ý! Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất');
         window.location='" . url('/') . "'
        </script>";
    }

    public function buyding(Request $request, $id)
    {
        $sanpham = DB::select('select * from sanpham where id = ?', [$id]);
        // dd($sanpham);
        if ($sanpham[0]->sanpham_khuyenmai == 1) {
            $muasanpham = DB::select('
                select sp.id,sp.sanpham_ten,sp.gia_ban, lh.maphieunhap, sp.id, km.khuyenmai_phan_tram,lh.lohang_so_luong_hien_tai
                from sanpham as sp, lohang as lh, nhacungcap as ncc, sanphamkhuyenmai as spkm, khuyenmai as km
                where km.khuyenmai_tinh_trang = 1 and sp.id = spkm.sanpham_id and spkm.khuyenmai_id = km.id and ncc.id = lh.nhacungcap_id and lh.sanpham_id = sp.id and sp.id = ?', [$id]);

            $lastest = count($muasanpham) - 1;
            if ($muasanpham[$lastest]->lohang_so_luong_hien_tai == 0) {
                echo "<script>
                     alert('Sản phẩm đang hêt hàng, quý khách có thể chọn sản phẩm khác !'); window.history.back();
                    </script>";
            } else {
                $giakm = $muasanpham[$lastest]->gia_ban - $muasanpham[$lastest]->gia_ban * $muasanpham[$lastest]->khuyenmai_phan_tram * 0.01;
                // print_r($giakm);
                Cart::add(array('id' => $muasanpham[$lastest]->id, 'name' => $muasanpham[$lastest]->sanpham_ten, 'qty' => 1, 'price' => $giakm));
                return redirect()->route('giohang');
            }

        } else {
            $muasanpham = DB::select('select sp.id,sp.sanpham_ten, sp.gia_ban, lh.lohang_so_luong_hien_tai
                from sanpham as sp, lohang as lh, nhacungcap as ncc
                where ncc.id = lh.nhacungcap_id and lh.sanpham_id = sp.id and sp.id = ?', [$id]);
            $lastest = count($muasanpham) - 1;
            if ($muasanpham[$lastest]->lohang_so_luong_hien_tai == 0) {
                echo "<script>
                     alert('Sản phẩm đang hêt hàng, quý khách có thể chọn sản phẩm khác !'); window.history.back();
                    </script>";
            } else {
                $gia = $muasanpham[$lastest]->gia_ban;
                Cart::add(array('id' => $muasanpham[$lastest]->id, 'name' => $muasanpham[$lastest]->sanpham_ten, 'qty' => 1, 'price' => $gia));
                return redirect()->route('giohang');
            }

        }
        // $content = Cart::content();
        // dd($content);

    }

    public function cart()
    {
        $content = Cart::content();
        // print_r($content);
        $total = Cart::total();
        return view('frontend.pages.cart', compact('content', 'total'));
    }

    public function deleteProduct($id)
    {
        Cart::remove($id);
        return redirect()->route('giohang');
    }

    public function updateProduct()
    {
        if (Request::ajax()) {
            $id = Request::get('id');
            $qty = Request::get('qty');
            Cart::update($id, $qty);
            echo "oke";
        }
    }

    public function getCheckin()
    {
        $content = Cart::content();
        // print_r($content);
        // dd(Cart::content());
        $total = Cart::total();
        // echo "string";
        // print_r($total);
        return view('frontend.pages.checkin', compact('content', 'total'));
    }

    // public function postCheckin(ThanhtoanRequest $request)
    // {
    //     $content = Cart::content();
    //     $total = Cart::total();

    //     $donhang = new Donhang;
    //     $donhang->donhang_nguoi_nhan = $request->txtNNName;
    //     $donhang->donhang_nguoi_nhan_email = $request->txtNNEmail;
    //     $donhang->donhang_nguoi_nhan_sdt = $request->txtNNPhone;
    //     $donhang->donhang_nguoi_nhan_dia_chi = $request->txtNNAddr;
    //     $donhang->donhang_ghi_chu = $request->txtNNNote;
    //     $donhang->donhang_tong_tien = $total;
    //     $donhang->khachhang_id = $request->txtKHID;
    //     $donhang->tinhtranghd_id = 1;
    //     if (request('payment_method') == 'paypal') {
    //         $donhang->donhang_payment = 'Thanh toán qua Paypal.';
    //     } else {
    //         $donhang->donhang_payment = 'Thanh toán khi giao hàng.';
    //     }
    //     $donhang->save();

    //     // dd($donhang->id);

    //     if(request('payment_method') == 'paypal') {
    //             //redirect to paypal
    //         return redirect()->route('paypal.payment',$donhang['id']);

    //     }

    //     foreach ($content as $item) {
    //         $detail = new Chitietdonhang;
    //         $detail->sanpham_id = $item->id;
    //         $detail->donhang_id = $donhang->id;
    //         $detail->chitietdonhang_so_luong = $item->qty;
    //         $detail->chitietdonhang_thanh_tien = $item->price*$item->qty;
    //         $detail->save();
    //     }
    //     $kh = DB::table('khachhang')->where('id', $request->txtKHID)->first();
    //     // print_r($kh);
    //     $donhang = [
    //         'id'=> $donhang->id,
    //         'donhang_nguoi_nhan'=> $request->txtNNName,
    //         'donhang_nguoi_nhan_email' => $request->txtNNEmail,
    //         'donhang_nguoi_nhan_sdt' => $request->txtNNPhone,
    //         'donhang_nguoi_nhan_dia_chi' => $request->txtNNAddr,
    //         'donhang_ghi_chu' => $request->txtNNNote,
    //         'donhang_tong_tien' => $total,
    //         'khachhang_id' => $request->txtKHID,
    //         'khachhang_email'=>$kh->khachhang_email,
    //         ];
    //     // dd($donhang);

    //     Mail::send('auth.emails.hoadon', $donhang, function ($message) use ($donhang) {
    //         $message->from('appnsfw@gmail.com', 'ADMIN');

    //         $message->to($donhang['khachhang_email'], 'a');

    //         $message->subject('Hóa đơn mua hàng tại FlowerShop!!!');
    //     });

    //     Mail::send('auth.emails.hoadon', $donhang, function ($message) use ($donhang) {
    //         $message->from('appnsfw@gmail.com', 'ADMIN');

    //         $message->to('appnsfw@gmail.com', 'KHÁCH HÀNG');

    //         $message->subject('Hóa đơn mua hàng tại FlowerShop!!!');
    //     });

    //     Cart::destroy();
    //     echo "<script>
    //       alert('Bạn đã đặt mua sản phẩm thành công!');
    //       window.location = '".url('/')."';</script>";
    // }

    public function postComment(BinhluanRequest $request)
    {
        $binhluan = new Binhluan;
        $binhluan->binhluan_ten = $request->txtName;
        $binhluan->binhluan_email = $request->txtEmail;
        $binhluan->binhluan_noi_dung = $request->txtContent;
        $binhluan->binhluan_trang_thai = 0;
        $binhluan->sanpham_id = $request->txtID;
        $binhluan->save();
        echo "<script>
          alert('Cảm ơn bạn đã góp ý!');
          window.history.back();</script>";
    }

    public function getFind()
    {

        return view('frontend.pages.product');
    }

    public function postFind()
    {
        $keyword = Request::input('txtSeach');
        $sanpham = DB::table('sanpham')
            ->where('sanpham_ten', 'like', '%' . $keyword . '%')
            ->orWhere('sanpham_url', 'like', '%' . $keyword . '%')
            ->join('lohang', 'sanpham.id', '=', 'lohang.sanpham_id')
            ->select(DB::raw('max(lohang.id) as lomoi'), 'sanpham.id', 'sanpham.sanpham_ten', 'sanpham.sanpham_url', 'sanpham.sanpham_khuyenmai', 'sanpham.sanpham_anh', 'lohang.lohang_so_luong_nhap', 'lohang.lohang_so_luong_hien_tai')
            ->groupBy('sanpham.id')
            ->paginate(15);
        return view('frontend.pages.product', compact('sanpham'));
    }

}