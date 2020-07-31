<div class="aa-sidebar-widget">
  <h3>Bài viết mới</h3>
  <div class="aa-recently-views">
  <?php $baiviet = DB::table('baiviet')->orderBy('id','desc')->take(5)->get(); ?>
    <ul>
    @foreach ($baiviet as $item)
      <li>
        <a href="{!! url('bai-viet',$item->baiviet_url) !!}"><img src="{!! asset('resources/upload/baiviet/'.$item->baiviet_anh) !!}" alt="img"  style="width: 100px; height: 100px;"></a>
        <div class="aa-cartbox-info">
          <h4><a href="{!! url('bai-viet',$item->baiviet_url) !!}">{!! $item->baiviet_tieu_de !!}</a></h4>
          <p>{{date("d-m-Y", strtotime("$item->created_at"))}}</p>
        </div>                    
      </li>
    @endforeach                                         
    </ul>
  </div>                            
</div>