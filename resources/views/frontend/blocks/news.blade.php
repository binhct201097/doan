
  <!-- Latest Blog -->
  <section id="aa-latest-blog">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-latest-blog-area">
            <h2>Bài viết gần đây</h2>
            <div class="row">
              <!-- single latest blog -->
              <?php $baiviet = DB::table('baiviet')->orderBy('id','desc')->take(3)->get(); ?>
              @foreach ($baiviet as $item)
              <div class="col-md-4 col-sm-4">
                <div class="aa-latest-blog-single">
                  <figure class="aa-blog-img">                    
                    <a href="{!! url('bai-viet',$item->baiviet_url) !!}"><img src="{!! asset('resources/upload/baiviet/'.$item->baiviet_anh) !!}" alt="img"></a>  
                      <figcaption class="aa-blog-img-caption">
                      <span href="{!! url('bai-viet',$item->baiviet_url) !!}"><i class="fa fa-clock-o"></i>{!! $item->created_at !!}</span>
                    </figcaption>                          
                  </figure>
                  <div class="aa-blog-info">
                    <h3 class="aa-blog-title"><a href="{!! url('bai-viet',$item->baiviet_url) !!}">{!! $item->baiviet_tieu_de !!}</a></h3>
                    <p>{!! cut($item->baiviet_tom_tat,50) !!}</p> 
                    <a href="{!! url('bai-viet',$item->baiviet_url) !!}" class="aa-read-mor-btn">Xem tiếp <span class="fa fa-long-arrow-right"></span></a>
                  </div>
                </div>
              </div>
              @endforeach 
              
            </div>
          </div>
        </div>    
      </div>
    </div>
  </section>
  <!-- / Latest Blog -->