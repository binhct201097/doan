@extends('frontend.master')
@section('content')
<style>
td {
    border: 1px solid #8080804f;
    text-align: center;
}
</style>
<div class="container">
    <div class="breadcrumbs">
        <ol class="breadcrumb">
            <li><a href="{!! url('/') !!}">Trang chủ</a></li>
            <li class="active">Giỏ hàng</li>
        </ol>
    </div>
    <div class="table-responsive cart_info">
        <table class="table table-condensed" style="border: 1px solid #8080804f;margin-top: -42px;">
            <thead>
                <tr class="cart_menu" style="    background: #FE980F;
    color: white;
    text-align: center;
    font-weight: bold;
    padding: 20px;
    font-size: 17px;
    height: 50px;">
                    <td class="image">Ảnh</td>
                    <td class="description">Sản phẩm</td>
                    <td class="price">Giá</td>
                    <td class="quantity">Số lượng</td>
                    <td class="total">Tổng tiền</td>
                    <td class="image">Xóa</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($content as $item)
                <?php
$sanpham = DB::table('sanpham')->where('id', $item->id)->first();
?>
                <tr>
                    <td><a href="{!! url('san-pham',$sanpham->sanpham_url) !!}"><img
                                src="{!! asset('resources/upload/sanpham/'.$sanpham->sanpham_anh) !!}"
                                style="width: 45px; height: 50px;"></a></td>
                    <td><a class="aa-cart-title" href="{!! url('san-pham',$sanpham->sanpham_url) !!}">{!!
                            $item->name !!}</a></td>
                    <td>{!! number_format("$item->price",0,",",".") !!}vnđ</td>
                    <td><input class="qty aa-cart-quantity" type="number" value="{!!  $item->qty !!}"></td>
                    <td>{!! number_format($item->price*$item->qty,0,",",".") !!}vnđ</td>
                    <td><a class="remove" href='xoa-san-pham/{{$item->rowId}}'>
                            <fa class="fa fa-close"></fa>
                        </a></td>
                </tr>
                @endforeach
                </form>
            </tbody>
        </table>
    </div>
    <div class="cart-view-total">
        <!-- <h4>Tổng tiền</h4> -->
        <table class="aa-totals-table">
            <tbody>
                <tr>
                    <th style="display: inline-block; font-size: 17px">Tổng tiền :</th>
                    <td
                        style="margin-left: 10px; font-weight:bold; display: inline-block; font-size: 17px; border: none">
                        {!!
                        number_format($total,0,",",".") !!}vnđ</td>
                </tr>
            </tbody>
        </table>
        @if (Auth::check())
        <a href="{!! url('/') !!}" class="aa-cart-view-btn" style="display: inline-block;
    background: #FE980F;
    color: white;
    padding: 6px 23px;
    font-size: 15px;
    font-weight: bold;
    margin-top: 10px;
    margin-bottom: 100px;"> Mua tiếp</a>
        <a href="{!! URL::route('getThanhtoan') !!}" class="aa-cart-view-btn" style="display: inline-block;
    background: #FE980F;
    color: white;
    padding: 6px 23px;
    font-size: 15px;
    font-weight: bold;
    margin-top: 10px;
    margin-bottom: 100px;">Thanh Toán</a>

        @else
        <a href="{!! url('/') !!}" class="aa-cart-view-btn" style="display: inline-block;
    background: #FE980F;
    color: white;
    padding: 6px 23px;
    font-size: 15px;
    font-weight: bold;
    margin-top: 10px;
    margin-bottom: 100px;">Mua tiếp</a>
        <a href="{!! url('dang-nhap') !!}" class="aa-cart-view-btn" style="display: inline-block;
    background: #FE980F;
    color: white;
    padding: 6px 23px;
    font-size: 15px;
    font-weight: bold;
    margin-top: 10px;
    margin-bottom: 100px;">Thanh Toán</a>
        @endif

    </div>
</div>
@stop