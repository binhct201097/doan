@extends('frontend.master')
@section('content')
<!-- catg header banner section -->

<div class="container">
    <div class="breadcrumbs">
        <ol class="breadcrumb" style="margin-bottom: 30px">
            <li><a href="{!! url('/') !!}">Trang chủ</a></li>
            <li class="active">Thanh toán</li>
        </ol>
    </div>
</div>

<!-- / product category -->
<!-- Cart view section -->
<section id="checkout">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="checkout-area">
                    <form action="{!! route('vnpay') !!}" method="POST" style="margin-bottom: 100px;">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                        <div class="row">
                            <div class="panel-body">

                                <input type="submit" value="Hoàn tất mua hàng" class="aa-browse-btn" style="background: #FE980F;
    border: none;
    padding: 10px;
    color: white;
    font-weight: bold;">
                            </div>
                            <div class="col-md-8">
                                <div class="checkout-left">
                                    <div class="panel-group" id="accordion">
                                        <!-- Billing Details -->
                                        <div class="panel panel-default aa-checkout-billaddress">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion"
                                                        href="#collapseThree">
                                                        Thông tin khách hàng
                                                    </a>
                                                </h4>
                                            </div>
                                            <input type="hidden" name="" value="{!! Auth::user()->id !!}" />
                                            <?php
$khachhang = DB::table('khachhang')->where('user_id', Auth::user()->id)->first();
// dd($khachhang);
?>
                                            <input type="hidden" name="txtKHID" value="{!! $khachhang->id !!}" />
                                            <div id="collapseThree" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="aa-checkout-single-bill">
                                                                <input type="text" name="txtKHName"
                                                                    value="{{ $khachhang->khachhang_ten }}"
                                                                    placeholder="Họ và tên*" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="aa-checkout-single-bill">
                                                                <input type="email" name="txtKHEmail"
                                                                    value="{{ $khachhang->khachhang_email }}"
                                                                    placeholder="Mail*">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="aa-checkout-single-bill">
                                                                <input type="tel" name="txtKHPhone"
                                                                    value="{{ $khachhang->khachhang_sdt }}"
                                                                    placeholder="Số điện thoại*">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="aa-checkout-single-bill">
                                                                <textarea cols="8" rows="3" name="txtKHAddr"
                                                                    placeholder="Địa chỉ*"> {{ $khachhang->khachhang_dia_chi }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Shipping Address -->
                                        <div class="panel panel-default aa-checkout-billaddress">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion"
                                                        href="#collapseFour">
                                                        Thông tin nhận hàng
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseFour" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="aa-checkout-single-bill">
                                                                <input type="text" name="txtNNName"
                                                                    value="{{ $khachhang->khachhang_ten }}"
                                                                    placeholder="Họ và tên*">
                                                                <div>
                                                                    {!! $errors->first('txtNNName') !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="aa-checkout-single-bill">
                                                                <input type="email"
                                                                    value="{{ $khachhang->khachhang_email }}"
                                                                    name="txtNNEmail" placeholder="Email*">
                                                                <div>
                                                                    {!! $errors->first('txtNNEmail') !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="aa-checkout-single-bill">
                                                                <input type="tel"
                                                                    value="{{ $khachhang->khachhang_sdt }}"
                                                                    name="txtNNPhone" placeholder="Số điện thoại*">
                                                                <div>
                                                                    {!! $errors->first('txtNNPhone') !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="aa-checkout-single-bill">
                                                                <textarea cols="8" name="txtNNAddr" rows="3"
                                                                    placeholder="Địa chỉ*">{{ $khachhang->khachhang_dia_chi }}</textarea>
                                                                <div>
                                                                    {!! $errors->first('txtNNAddr') !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="aa-checkout-single-bill">
                                                                <textarea cols="8" name="txtNNNote" rows="3"
                                                                    placeholder="Ghi chú"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="checkout-right">
                                    <h4>Đơn hàng</h4>
                                    <div class="aa-order-summary-area">
                                        <table class="table table-responsive">
                                            <thead>
                                                <tr>
                                                    <th>Sản phẩm</th>
                                                    <th>Thành tiền</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($content as $item)
                                                <tr>
                                                    <td>{!! $item->name !!} <strong> x {!! $item->qty !!}</strong></td>
                                                    <td>{!! number_format($item->price*$item->qty,0,",",".") !!} vnđ
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Tổng cộng</th>
                                                    <td>{!! number_format($total,0,",",".") !!} vnđ</td>
                                                </tr>

                                            </tfoot>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <h4 class="aa-browse-btn">Phương thức thanh toán</h4>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" id="exampleRadios1"
                                value="vnpay">
                            <label class="form-check-label" for="exampleRadios1">
                                Thanh toán qua VnPay
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" id="exampleRadios1"
                                value="normal" checked>
                            <label class="form-check-label" for="exampleRadios1">
                                Thanh toán khi nhận hàng
                            </label>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@stop