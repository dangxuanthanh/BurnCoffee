<?php
    $danhmuc = DB::table('danhmuc')->select('Id_DM', 'Ten_DM')
    ->orderby('ThuTu','asc')->where('AnHien','=','1')->get();
?>
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="imgc" href="{{ url('/') }}"><img src="images/logoburncoffee3.png" alt=""></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
        </button>
        <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active"><a href="{{ url('/') }}" class="nav-link">Trang chủ</a></li>
            <li class="nav-item"><a href="{{ url('/gioi-thieu') }}" class="nav-link">Giới thiệu</a></li>
            <li class="nav-item"><a href="{{ url('/san-pham') }}" class="nav-link">Sản Phẩm</a></li>
            <li class="nav-item dropdown">
                <a href="{{ url('/san-pham') }}" class="nav-link dropdown-toggle" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >Danh Mục</a>
                <div class="dropdown-menu" aria-labelledby="dropdown04">
                    @foreach($danhmuc as $dm)
                        <a class="dropdown-item" href="{{action("ProductController@sptodm",['Id_DM'=>$dm->Id_DM])}}"><?= $dm->Ten_DM ?></a>
                    @endforeach
                </div>
            </li>
            <li class="nav-item"><a href="{{ url('/tin-tuc') }}" class="nav-link">Tin tức</a></li>
            <!-- <li class="nav-item"><a href="{{ url('/dich-vu') }}" class="nav-link">Về chúng tôi</a></li> -->
            <li class="nav-item"><a href="{{ url('/lien-he') }}" class="nav-link">Liên hệ</a></li>
            @if(Session::has('khachhang'))
                <li class="nav-item  dropdown">
                    <a  class="nav-link" href="{{ url('/ho-so') }}">
                        {{ Session::get('khachhang')['Ten_KH'] }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdown04">
                        <a href="{{ url('/logouted') }}" class="dropdown-item"> Đăng xuất</a>
                    </div>
                </li>
                <?php
                    $cartitem = \Cart::session(Session::get('khachhang')['Id_KH'])->getContent();
                ?>
                <li class="nav-item cart" id="change-item-cart">
                    <a href="{{ url('/gio-hang') }}" class="nav-link">
                        <span class="icon icon-shopping_cart"></span>
                        <span class="bag d-flex justify-content-center align-items-center">
                            <small id="slgh">{{$cartitem->count()}}</small>
                        </span>
                    </a>
                    <div class="khung">
                        <div >
                            <table class="carts">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Tên</th>
                                        <th>Số Ly</th>
                                        <th>Giá</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cartitem as $cart)
                                        <?php
                                            $sp = DB::table('sanpham')->select('Id_SP', 'urlHinh1')->where('Id_SP', '=' ,$cart->id)->first();
                                        ?>
                                        <tr id="sid{{ $cart->id }}">
                                            <td><img width="70px" height="70px" class="mt-3 mb-3 c" src="./images/{{$sp->urlHinh1}}" alt=""></td>
                                            <td>{{$cart->name}}</td>
                                            <td>{{$cart->quantity}}</td>
                                            <td class="totals">{{ number_format($cart->price) }}đ</td>
                                            <td class="product-remove dl"><a href="javascript:" onclick="deleteCart({{$cart->id}})"><span class="icon-close"></span></a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tbody class="bd2">
                                    <tr>
                                        <th class="ml-2 mt-3 mb-3">Tổng tiền:</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th class="tien">{{number_format(\Cart::getSubTotal())}}đ</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="but ml-2 mr-2 mt-2 mb-2">
                            <a type="submit" href="/thanh-toan" class="btn btn-primary">Thanh toán</a>
                        </div>
                    </div>
                </li>
                
            @else
                <li class="nav-item login dropdown">
                    <a href="#" class="nav-link">
                        <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-person-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13.468 12.37C12.758 11.226 11.195 10 8 10s-4.757 1.225-5.468 2.37A6.987 6.987 0 0 0 8 15a6.987 6.987 0 0 0 5.468-2.63z"/>
                        <path fill-rule="evenodd" d="M8 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                        <path fill-rule="evenodd" d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1zM0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8z"/>
                        </svg>
                    </a>
                    
                    <div class="dropdown-menu" aria-labelledby="dropdown04">
                        <a href="{{ url('/dang-nhap') }}" class="dropdown-item"> Đăng nhập</a>
                        <a href="{{ url('/dang-ky') }}" class="dropdown-item">Đăng ký</a>
                    </div>
                </li>
                <li class="nav-item cart">
                    <a href="{{ url('/gio-hang') }}" class="nav-link">
                        <span class="icon icon-shopping_cart"></span>
                    </a>
                </li>
            @endif
            
        </ul>
        </div>
    </div>
</nav>
<script>
    function deleteCart(id) {
        $.ajax({
            type: "GET",
            url: "/del/"+id,
            data: {
                _token : $("input[name=_token]").val()
            },
            success: function (response) {
                $("#sid"+id).remove();
                $("#change-item-cart").html(response);
                alertify.error('Sản phẩm đã được xóa');
            }
        });
    }
</script>