<section id="slider">
    <!--slider-->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#slider-carousel" data-slide-to="1"></li>
                        <li data-target="#slider-carousel" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        @php
                        $i=0;
                        @endphp
                        @foreach($slide as $slides)
                        @php $i++ @endphp
                        <div class="item {{$i == 1 ? 'active':''}}">
                            <div class="col-sm-6">
                                <h1><span>AHT</span>-MOBILE</h1>
                                <h2>Mừng sinh nhật AHT-MOBILE Shop</h2>
                                <p>Mừng xinh nhật 20 năm thành lập, giảm giá 30% các sản phẩm duy nhất hai ngày cuối
                                    tuần</p>
                                <button type="button" class="btn btn-default get">Xem Ngay</button>
                            </div>
                            <div class="col-sm-6">
                                <img src="{!! asset('resources/upload/slides/'.$slides->anh) !!}"
                                    class="girl img-responsive" alt="" />
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>