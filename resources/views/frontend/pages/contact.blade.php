@extends('frontend.master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-8">
            <div class="contact-form">
                <h2 class="title text-center">LIÊN HỆ</h2>
                <div class="status alert alert-success" style="display: none"></div>
                <form id="main-contact-form" class="contact-form row" name="contact-form" method="post"
                    action="{!! url('lien-he') !!}">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-group col-md-6">
                        <input type="text" name="ten" class="form-control" required="required" placeholder="Tên">
                    </div>
                    <div class="form-group col-md-6">
                        <input type="email" name="email" class="form-control" required="required" placeholder="Email">
                    </div>
                    <div class="form-group col-md-12">
                        <input type="text" name="chu_de" class="form-control" required="required" placeholder="Chủ đề">
                    </div>
                    <div class="form-group col-md-12">
                        <textarea name="noidung" id="message" required="required" class="form-control" rows="8"
                            placeholder="Nội dung"></textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <input type="submit" name="submit" class="btn btn-primary pull-right" value="Gửi">
                    </div>
                </form>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="contact-info">
                <h2 class="title text-center">THÔNG TIN LIÊN HỆ</h2>
                <address>
                    <p>AHT-MOBILE.</p>
                    <p>Trung Hòa, Cầu Giấy, Hà Nội</p>
                    <p>Việt Nam</p>
                    <p>Mobile: +2346 17 38 93</p>
                    <p>Fax: 1-714-252-0026</p>
                    <p>Email: ahtinfor@gmail.com</p>
                </address>
                <div class="social-networks">
                    <h2 class="title text-center">MẠNG XÃ HỘI</h2>
                    <ul>
                        <li>
                            <a href="#"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-google-plus"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-youtube"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@stop