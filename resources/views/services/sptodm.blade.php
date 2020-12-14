@extends('../layoutchild')
  @include('services.backG')
  <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
      <div class="col-md-7 heading-section ftco-animate text-center">
          <span class="subheading" style="margin-bottom: 5px">Burn Coffee</span>
        <h2 class="mb-4">Thức uống ưa thích</h2>
        <p>Được trải nghiệm nhiều loại thức uống, nhưng khách hàng vẫn ưa thích những món nước này. Đó là nguyên nhân Burn Coffee luôn cuốn hút và giữ chân khách hàng</p>
      </div>
    </div>
    <div class="row border-box">
        @foreach($sp_to_dm as $dm)
          <?php
            $sanpham = DB::table('sanpham')->select('Id_SP', 'Ten_SP', 'urlHinh1', 'Gia')->where("Id_SP", '=' ,$dm->Id_SP )->get();
            $kh = Session::has('khachhang');
          ?>
            @foreach ($sanpham as $showsp)
            <?php
            $gh = DB::table('giohang')->select('Id_GH', 'Id_SP', 'So_Luong', 'Id_KH')->where('Id_SP', '=',$showsp->Id_SP)->first();
          ?>
          <div class="col-md-3">
            <div class="menu-entry">
                <a href="{{action("ProductController@detailproduct",['Id_SP'=>$showsp->Id_SP])}}" class="img" style="background-image: url(images/{{ $showsp->urlHinh1 }});"></a>
                <div class="text text-center pt-4">
                  <h3><a href="{{action("ProductController@detailproduct",['Id_SP'=>$showsp->Id_SP])}}"><?= $showsp->Ten_SP ?></a></h3>
                  {{-- <p class="mota">{{ $showsp->MoTa }}</p> --}}
                  <p class="price"><span>{{ $showsp->Gia }} đ</span></p>
                  {{-- <p><a href="{{action("ProductController@detailproduct",['Id_SP'=>$showsp->Id_SP])}}" class="btn btn-primary btn-outline-primary">Chi tiết</a></p> --}}
                  
                    <form id="cartform-{{ $showsp->Id_SP }}">
                      @csrf
                      <div class="div" style="display: none;">
                        <input type="text" id="id-{{ $showsp->Id_SP }}" name="id" value="{{ $showsp->Id_SP }}">
                      </div>
                      <div class="text-center">
                        <button class="btn btn-primary btn-outline-primary" type="submit">Thêm</button>
                      </div>
                    </form>
                </div>
                
              </div>
          </div>
        
          <script>
            var idkh =  {{$kh}}
            $('#cartform-{{ $showsp->Id_SP }}').submit(function (e) { 
              e.preventDefault();
              if ( idkh > 0) {
                let id = $("#id-{{ $showsp->Id_SP }}").val()
                $.ajax({
                  type: "POST",
                  url: "{{route('ct.add')}}",
                  data: {
                    "_token": "{{ csrf_token() }}",
                    id:id,
                  },
                  success: function (response) {
                    if(response){
                      $("#change-item-cart").empty();
                      $("#change-item-cart").html(response);
                      alertify.success('Sản phẩm đã được thêm');
                    }
                  }
                });
              } else {
                alertify.error('Đăng nhập để thêm giỏ hàng');
              }
            });  
          </script>
            @endforeach
          @endforeach
    </div>
    </div>
</section>

<section>
	<div class="slider-banner" style="background-image: url(images/BurnCoffee_Banner.jpg);">
      	<div class="overlay"></div>
        
        </div>
      </div>
	</section>