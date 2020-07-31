<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin/dangnhap', 'AdminController@getDangnhapAdmin');
Route::post('admin/dangnhap', 'AdminController@postDangnhapAdmin');
Route::get('admin/dangxuat', 'AdminController@getDangXuatAdmin');

Route::get('/', 'HomeController@index');

Route::get('nhom/{url}', 'HomeController@group');

Route::get('loai-san-pham/{url}', 'HomeController@cates');

Route::get('bai-viet', 'HomeController@baiviet');

Route::get('bai-viet/{url}', 'HomeController@detailbaiviet');

Route::get('san-pham/{url}', 'HomeController@product');
Route::get('san-pham', 'HomeController@sanpham');


Route::get('dang-ky', 'KhachhangController@getDangky');
Route::post('dang-ky', 'KhachhangController@postDangky');

Route::get('dang-nhap', 'KhachhangController@getDangnhap');
Route::post('dang-nhap', 'KhachhangController@postDangnhap');
Route::get('dang-xuat', 'KhachhangController@getDangxuat');

Route::get('lien-he', 'HomeController@getContact');
Route::post('lien-he', 'HomeController@postContact');

Route::get('khuyen-mai', 'HomeController@promotions');

Route::get('mua-hang/{id}/{ten}', ['as' => 'muahang', 'uses' => 'HomeController@buyding']);

Route::get('gio-hang', ['as' => 'giohang', 'uses' => 'HomeController@cart']);

Route::get('xoa-san-pham/{id}', ['as' => 'xoasanpham', 'uses' => 'HomeController@deleteProduct']);

Route::get('cap-nhat-san-pham/{id}/{qty}', ['as' => 'capnhat', 'uses' => 'HomeController@updateProduct']);

Route::get('thanh-toan', ['as' => 'getThanhtoan', 'uses' => 'HomeController@getCheckin']);
Route::post('thanh-toan', 'HomeController@postCheckin')->name('thanhtoan');

Route::get('thanh-toan-paypal/{donhang}', 'PaypalController@getExpressCheckout')->name('paypal.payment');
Route::get('thanh-toan-paypalsc/{donhang}', 'PaypalController@getExpressCheckoutSC')->name('paypal.success');
Route::get('thanh-toan-cancel/{donhang}', 'PaypalController@cancelPage')->name('paypal.cancel');

Route::post('payment', [
    'uses' => 'VnPayController@payment',
])->name('vnpay');
Route::get('/responsePayment', [
    'uses' => 'VnPayController@responsePayment',
]);

Route::post('binh-luan', ['as' => 'postBinhluan', 'uses' => 'HomeController@postComment']);

Route::get('ket-qua-tim-kiem', ['as' => 'getTimkiem', 'uses' => 'HomeController@getFind']);

Route::post('ket-qua-tim-kiem', ['as' => 'postTimkiem', 'uses' => 'HomeController@postFind']);

Route::group(['prefix' => 'admin', 'middleware' => 'adminLogin'], function () {

    Route::get('bang-dieu-khien', ['as' => 'admin.index', 'uses' => 'AdminController@index']);

    Route::group(['prefix' => 'nhom'], function () {

        Route::get('danhsach', ['as' => 'admin.nhom.list', 'uses' => 'NhomController@getList']);

        Route::get('them', ['as' => 'admin.nhom.getAdd', 'uses' => 'NhomController@getAdd']);
        Route::post('them', ['as' => 'admin.nhom.postAdd', 'uses' => 'NhomController@postAdd']);

        Route::get('xoa/{id}', ['as' => 'admin.nhom.getDelete', 'uses' => 'NhomController@getDelete']);

        Route::get('sua/{id}', ['as' => 'admin.nhom.getEdit', 'uses' => 'NhomController@getEdit']);
        Route::post('sua/{id}', ['as' => 'admin.nhom.postEdit', 'uses' => 'NhomController@postEdit']);
    });

    Route::group(['prefix' => 'loaisanpham'], function () {
        Route::get('danhsach', ['as' => 'admin.loaisanpham.list', 'uses' => 'LoaisanphamController@getList']);

        Route::get('them', ['as' => 'admin.loaisanpham.getAdd', 'uses' => 'LoaisanphamController@getAdd']);
        Route::post('them', ['as' => 'admin.loaisanpham.postAdd', 'uses' => 'LoaisanphamController@postAdd']);

        Route::get('xoa/{id}', ['as' => 'admin.loaisanpham.getDelete', 'uses' => 'LoaisanphamController@getDelete']);

        Route::get('sua/{id}', ['as' => 'admin.loaisanpham.getEdit', 'uses' => 'LoaisanphamController@getEdit']);
        Route::post('sua/{id}', ['as' => 'admin.loaisanpham.postEdit', 'uses' => 'LoaisanphamController@postEdit']);
    });

    Route::group(['prefix' => 'donvitinh'], function () {

        Route::get('danhsach', ['as' => 'admin.donvitinh.list', 'uses' => 'DonvitinhController@getList']);

        Route::get('them', ['as' => 'admin.donvitinh.getAdd', 'uses' => 'DonvitinhController@getAdd']);
        Route::post('them', ['as' => 'admin.donvitinh.postAdd', 'uses' => 'DonvitinhController@postAdd']);

        Route::get('xoa/{id}', ['as' => 'admin.donvitinh.getDelete', 'uses' => 'DonvitinhController@getDelete']);

        Route::get('sua/{id}', ['as' => 'admin.donvitinh.getEdit', 'uses' => 'DonvitinhController@getEdit']);
        Route::post('sua/{id}', ['as' => 'admin.donvitinh.postEdit', 'uses' => 'DonvitinhController@postEdit']);
    });

    Route::group(['prefix' => 'sanpham'], function () {
        Route::get('danhsach', ['as' => 'admin.sanpham.list', 'uses' => 'SanphamController@getList']);

        Route::get('them', ['as' => 'admin.sanpham.getAdd', 'uses' => 'SanphamController@getAdd']);
        Route::post('them', ['as' => 'admin.sanpham.postAdd', 'uses' => 'SanphamController@postAdd']);

        Route::get('xoa/{id}', ['as' => 'admin.sanpham.getDelete', 'uses' => 'SanphamController@getDelete']);

        Route::get('sua/{id}', ['as' => 'admin.sanpham.getEdit', 'uses' => 'SanphamController@getEdit']);
        Route::post('sua/{id}', ['as' => 'admin.sanpham.postEdit', 'uses' => 'SanphamController@postEdit']);
        Route::get('xoahinh/{id}', ['as' => 'admin.sanpham.delImage', 'uses' => 'SanphamController@delImage']);
    });

    Route::group(['prefix' => 'nhacungcap'], function () {

        Route::get('danhsach', ['as' => 'admin.nhacungcap.list', 'uses' => 'NhacungcapController@getList']);

        Route::get('them', ['as' => 'admin.nhacungcap.getAdd', 'uses' => 'NhacungcapController@getAdd']);
        Route::post('them', ['as' => 'admin.nhacungcap.postAdd', 'uses' => 'NhacungcapController@postAdd']);

        Route::get('xoa/{id}', ['as' => 'admin.nhacungcap.getDelete', 'uses' => 'NhacungcapController@getDelete']);

        Route::get('sua/{id}', ['as' => 'admin.nhacungcap.getEdit', 'uses' => 'NhacungcapController@getEdit']);
        Route::post('sua/{id}', ['as' => 'admin.nhacungcap.postEdit', 'uses' => 'NhacungcapController@postEdit']);
    });

    Route::group(['prefix' => 'lohang'], function () {

        Route::get('danhsach', ['as' => 'admin.lohang.list', 'uses' => 'LohangController@getList']);

        Route::get('them', ['as' => 'admin.lohang.getAdd', 'uses' => 'LohangController@getAdd']);
        Route::post('them', ['as' => 'admin.lohang.postAdd', 'uses' => 'LohangController@postAdd']);

        Route::get('xoa/{id}', ['as' => 'admin.lohang.getDelete', 'uses' => 'LohangController@getDelete']);

        Route::get('sua/{id}', ['as' => 'admin.lohang.getEdit', 'uses' => 'LohangController@getEdit']);
        Route::post('sua/{id}', ['as' => 'admin.lohang.postEdit', 'uses' => 'LohangController@postEdit']);

        Route::get('nhap-hang/{id}', ['as' => 'admin.lohang.getNhaphang', 'uses' => 'LohangController@getNhaphang']);
        Route::post('nhap-hang/{id}', ['as' => 'admin.lohang.postNhaphang', 'uses' => 'LohangController@postNhaphang']);
    });

    Route::group(['prefix' => 'quangcao'], function () {

        Route::get('danhsach', ['as' => 'admin.quangcao.list', 'uses' => 'QuangcaoController@getList']);

        Route::get('them', ['as' => 'admin.quangcao.getAdd', 'uses' => 'QuangcaoController@getAdd']);
        Route::post('them', ['as' => 'admin.quangcao.postAdd', 'uses' => 'QuangcaoController@postAdd']);

        Route::get('xoa/{id}', ['as' => 'admin.quangcao.getDelete', 'uses' => 'QuangcaoController@getDelete']);

        Route::get('sua/{id}', ['as' => 'admin.quangcao.getEdit', 'uses' => 'QuangcaoController@getEdit']);
        Route::post('sua/{id}', ['as' => 'admin.quangcao.postEdit', 'uses' => 'QuangcaoController@postEdit']);

        Route::get('cap-nhat/{id}/{status}', ['as' => 'admin.quangcao.getChange', 'uses' => 'QuangcaoController@getChange']);
    });

    Route::group(['prefix' => 'slides'], function () {

        Route::get('danhsach', ['as' => 'admin.slides.list', 'uses' => 'SliderController@getList']);

        Route::get('them', ['as' => 'admin.slides.getAdd', 'uses' => 'SliderController@getAdd']);
        Route::post('them', ['as' => 'admin.slides.postAdd', 'uses' => 'SliderController@postAdd']);

        Route::get('xoa/{id}', ['as' => 'admin.slides.getDelete', 'uses' => 'SliderController@getDelete']);

        Route::get('sua/{id}', ['as' => 'admin.slides.getEdit', 'uses' => 'SliderController@getEdit']);
        Route::post('sua/{id}', ['as' => 'admin.slides.postEdit', 'uses' => 'SliderController@postEdit']);

        Route::get('cap-nhat/{id}/{status}', ['as' => 'admin.slides.getChange', 'uses' => 'SliderController@getChange']);
    });

    Route::group(['prefix' => 'khuyenmai'], function () {

        Route::get('danhsach', ['as' => 'admin.khuyenmai.list', 'uses' => 'KhuyenmaiController@getList']);

        Route::get('them', ['as' => 'admin.khuyenmai.getAdd', 'uses' => 'KhuyenmaiController@getAdd']);
        Route::post('them', ['as' => 'admin.khuyenmai.postAdd', 'uses' => 'KhuyenmaiController@postAdd']);
        Route::get('them-san-pham-km', ['as' => 'admin.khuyenmai.getAddPromotion', 'uses' => 'KhuyenmaiController@getAddPromotion']);
        Route::post('them-san-pham-km', ['as' => 'admin.khuyenmai.postAddPromotion', 'uses' => 'KhuyenmaiController@postAddPromotion']);

        Route::get('xoa/{id}', ['as' => 'admin.khuyenmai.getDelete', 'uses' => 'KhuyenmaiController@getDelete']);

        Route::get('sua/{id}', ['as' => 'admin.khuyenmai.getEdit', 'uses' => 'KhuyenmaiController@getEdit']);
        Route::post('sua/{id}', ['as' => 'admin.khuyenmai.postEdit', 'uses' => 'KhuyenmaiController@postEdit']);

        Route::get('sua-san-pham-km/{id}', ['as' => 'admin.khuyenmai.getEditPromotion', 'uses' => 'KhuyenmaiController@getEditPromotion']);
        Route::post('sua-san-pham-km/{id}', ['as' => 'admin.khuyenmai.postEditPromotion', 'uses' => 'KhuyenmaiController@postEditPromotion']);
    });

    Route::group(['prefix' => 'baiviet'], function () {

        Route::get('danhsach', ['as' => 'admin.baiviet.list', 'uses' => 'BaivietController@getList']);

        Route::get('them', ['as' => 'admin.baiviet.getAdd', 'uses' => 'BaivietController@getAdd']);
        Route::post('them', ['as' => 'admin.baiviet.postAdd', 'uses' => 'BaivietController@postAdd']);

        Route::get('xoa/{id}', ['as' => 'admin.baiviet.getDelete', 'uses' => 'BaivietController@getDelete']);

        Route::get('sua/{id}', ['as' => 'admin.baiviet.getEdit', 'uses' => 'BaivietController@getEdit']);
        Route::post('sua/{id}', ['as' => 'admin.baiviet.postEdit', 'uses' => 'BaivietController@postEdit']);

        Route::get('them-nguyen-lieu', ['as' => 'admin.baiviet.getAddMaterial', 'uses' => 'BaivietController@getAddMaterial']);
        Route::post('them-nguyen-lieu', ['as' => 'admin.baiviet.postAddMaterial', 'uses' => 'BaivietController@postAddMaterial']);

        Route::get('sua-nguyen-lieu/{id}', ['as' => 'admin.baiviet.getEditMaterial', 'uses' => 'BaivietController@getEditMaterial']);
        Route::post('sua-nguyen-lieu/{id}', ['as' => 'admin.baiviet.postEditMaterial', 'uses' => 'BaivietController@postEditMaterial']);

        Route::post('ds-nguyen-lieu/{id}', ['as' => 'admin.baiviet.listMat', 'uses' => 'BaivietController@listMat']);
    });

    Route::group(['prefix' => 'nhanvien'], function () {

        Route::get('danhsach', ['as' => 'admin.nhanvien.list', 'uses' => 'NhanvienController@getList']);

        Route::get('them', ['as' => 'admin.nhanvien.getAdd', 'uses' => 'NhanvienController@getAdd']);
        Route::post('them', ['as' => 'admin.nhanvien.postAdd', 'uses' => 'NhanvienController@postAdd']);

        Route::get('xoa/{id}', ['as' => 'admin.nhanvien.getDelete', 'uses' => 'NhanvienController@getDelete']);

        Route::get('sua/{id}', ['as' => 'admin.nhanvien.getEdit', 'uses' => 'NhanvienController@getEdit']);
        Route::post('sua/{id}', ['as' => 'admin.nhanvien.postEdit', 'uses' => 'NhanvienController@postEdit']);
    });

    Route::group(['prefix' => 'khachhang'], function () {

        Route::get('danhsach', ['as' => 'admin.khachhang.list', 'uses' => 'KhachhangController@getList']);

        Route::get('them', ['as' => 'admin.khachhang.getAdd', 'uses' => 'KhachhangController@getAdd']);
        Route::post('them', ['as' => 'admin.khachhang.postAdd', 'uses' => 'KhachhangController@postAdd']);

        Route::get('xoa/{id}', ['as' => 'admin.khachhang.getDelete', 'uses' => 'KhachhangController@getDelete']);

        Route::get('sua/{id}', ['as' => 'admin.khachhang.getEdit', 'uses' => 'KhachhangController@getEdit']);
        Route::post('sua/{id}', ['as' => 'admin.khachhang.postEdit', 'uses' => 'KhachhangController@postEdit']);

        Route::get('xem-lich-su-mua-hang/{id}', ['as' => 'admin.khachhang.getHistory', 'uses' => 'KhachhangController@getHistory']);
    });

    Route::group(['prefix' => 'donhang'], function () {

        Route::get('danhsach', ['as' => 'admin.donhang.list', 'uses' => 'DonhangController@getList']);

        Route::get('sua-tinh-trang-giao-hang/{id}', ['as' => 'admin.donhang.getEdit', 'uses' => 'DonhangController@getEdit']);
        Route::post('sua-tinh-trang-giao-hang/{id}', ['as' => 'admin.donhang.postEdit', 'uses' => 'DonhangController@postEdit']);

        Route::get('sua-thong-tin-giao-hang/{id}', ['as' => 'admin.donhang.getEdit1', 'uses' => 'DonhangController@getEdit1']);
        Route::post('sua-thong-tin-giao-hang/{id}', ['as' => 'admin.donhang.postEdit1', 'uses' => 'DonhangController@postEdit1']);

        Route::get('sua-thong-tin-thanh-toan/{id}', ['as' => 'admin.donhang.getEdit2', 'uses' => 'DonhangController@getEdit2']);
        Route::post('sua-thong-tin-thanh-toan/{id}', ['as' => 'admin.donhang.postEdit2', 'uses' => 'DonhangController@postEdit2']);

        Route::get('in-hoa-don/{id}', ['as' => 'admin.donhang.pdf', 'uses' => 'DonhangController@pdf']);
    });

    Route::group(['prefix' => 'binhluan'], function () {

        Route::get('danhsach', ['as' => 'admin.binhluan.list', 'uses' => 'BinhluanController@getList']);

        Route::get('xoa/{id}', ['as' => 'admin.binhluan.getDelete', 'uses' => 'BinhluanController@getDelete']);

        Route::get('chap-nhan/{id}', ['as' => 'admin.binhluan.getEdit', 'uses' => 'BinhluanController@getEdit']);

        Route::get('khong-chap-nhan/{id}', ['as' => 'admin.binhluan.getEdit1', 'uses' => 'BinhluanController@getEdit1']);
    });

    Route::group(['prefix' => 'thongke'], function () {
        Route::get('tong-quan', ['as' => 'admin.thongke.list', 'uses' => 'ThongkeController@getList']);
        Route::get('san-pham-nhap-vao', ['as' => 'admin.thongke.nhapvao', 'uses' => 'ThongkeController@getNhapvao']);
        Route::get('san-pham-ban-ra', ['as' => 'admin.thongke.banra', 'uses' => 'ThongkeController@getBanra']);
        Route::get('san-pham-hien-co', ['as' => 'admin.thongke.hienco', 'uses' => 'ThongkeController@getHienco']);
        Route::get('san-pham-doi-tra', ['as' => 'admin.thongke.doitra', 'uses' => 'ThongkeController@getDoitra']);
        Route::get('san-pham-ban-chay', ['as' => 'admin.thongke.banchay', 'uses' => 'ThongkeController@getBanchay']);
        Route::get('san-pham-ton-nhieu', ['as' => 'admin.thongke.tonnhieu', 'uses' => 'ThongkeController@getTonnhieu']);
        Route::get('san-pham-het-han', ['as' => 'admin.thongke.hethan', 'uses' => 'ThongkeController@getHethan']);
        Route::get('san-pham-con-han', ['as' => 'admin.thongke.conhan', 'uses' => 'ThongkeController@getConhan']);
    });

});