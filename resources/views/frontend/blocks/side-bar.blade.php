<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Danh mục sản phẩm</h2>
                    <div class="panel-group category-products" id="accordian">
                        <!--category-productsr-->
                        @foreach($cate_product as $key=>$cate)
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordian" href="#sportswear">
                                        <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                        {{$cate->loaisanpham_ten}}
                                    </a>
                                </h4>
                            </div>

                            <div id="sportswear" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul>
                                        @foreach($product as $key=>$pro)
                                        @if($cate->id == $pro->loaisanpham_id)
                                        <li><a href="#">{{$pro->sanpham_ten}} </a></li>
                                        @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @foreach($promotion as $promo)
                    <div class="shipping text-center">
                        <img src="{!! asset('resources/upload/quangcao/'.$promo->quangcao_anh) !!}" alt="">
                    </div>
                    @endforeach

                </div>
            </div>
            <div class="col-sm-9 padding-right">
                @yield('content')
            </div>
        </div>
    </div>
</section>