<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Danh mục sản phẩm</h2>
                    <div class="panel-group category-products" id="accordian"
                        style="text-align: center; letter-spacing: 0.5px">
                        <!--category-productsr-->
                        @foreach($cate_product as $key=>$cate)
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordian"
                                        href="{!! url('loai-san-pham',$cate->loaisanpham_url) !!}">
                                        <span class="badge pull-right"></span>
                                        {{$cate->loaisanpham_ten}}
                                    </a>
                                </h4>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @foreach($promotion as $promo)
                    @if($promo->quangcao_trang_thai == 1)
                    <div class="shipping text-center">
                        <a href="{{$promo->link}}"><img
                                src="{!! asset('resources/upload/quangcao/'.$promo->quangcao_anh) !!}" alt=""></a>
                    </div>
                    @endif
                    @endforeach

                </div>
            </div>
            <div class="col-sm-9 padding-right">
                @yield('content')
            </div>
        </div>
    </div>
</section>