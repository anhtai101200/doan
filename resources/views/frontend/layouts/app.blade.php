<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/price-range.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/animate.css') }}" rel="stylesheet">
	<link href="{{ asset('frontend/css/main.css') }}" rel="stylesheet">
	<link href="{{ asset('frontend/css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/rate.css') }}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
	@include('frontend.layouts.header')
	

	<section>
		<div class="container">
			<div class="row">
                @if(!isset($hideMenu))

                    @include('frontend.layouts.menu-left')
                    @include('frontend.layouts.slide')

                    <div class="col-sm-9 padding-right">
                        @yield('content')
                    </div>

                @else

                    @yield('content')

                @endif

			</div>
		</div>
	</section>
    <!-- Footer -->
	@include('frontend.layouts.footer')
	
    <script src="{{ asset('frontend/js/jquery.js') }}"></script>
	<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('frontend/js/jquery.scrollUp.min.js') }}"></script>
	<script src="{{ asset('frontend/js/price-range.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.prettyPhoto.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("a[rel^='prettyPhoto']").prettyPhoto();
        });
    </script>
    <script>
        $(document).ready(function() {

            $('.add-to-cart').click(function() {

                let id = $(this).attr('id');

                //console.log(id);
                $.ajax({
                    url: "{{ route('cart.add') }}",
                    type:"POST",
                    data: {
                        id: id,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(res) {
                        console.log(res);
                        $('#cart-count').text(res.count);
                    }
                })

            });

        });
    </script>
    <script>
        $(document).ready(function() {
           $('.cart_quantity_up').click(function(e) {

                e.preventDefault();

                // Lấy ID sản phẩm
                let id = $(this).attr('id');

                // Lấy số lượng hiện tại
                let qty = $(this).next().val();

                qty = parseInt(qty);

                // Tăng số lượng
                qty++;

                // Hiển thị số lượng mới
                $(this).next().val(qty);

                let button = this;

                // AJAX gửi ID + qty lên PHP
                $.ajax({
                    url: "{{ route('cart.update') }}",
                    type: "POST",
                    data: {
                        id: id,
                        qty: qty,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(res) {
                        console.log(res);
                        $(button).closest('tr').find('.cart_total_price').text('$' + res.totalProduct);
                        // Tổng tất cả sản phẩm
                        $('#cart-sub-total').text('$' + res.total);
                        $('#cart-total').text('$' + res.total)
                    } 
                });

            });

            $('.cart_quantity_down').click(function(e) {

                e.preventDefault();

                // Lấy ID sản phẩm
                let id = $(this).attr('id');

                // Lấy số lượng
                let qty = $(this).prev().val();

                qty = parseInt(qty);

                if (qty > 1) {
                    qty--;

                    $(this).prev().val(qty);

                    let button = this;

                    $.ajax({
                        url: "{{ route('cart.update') }}",
                        type: "POST",
                        data: {
                            id: id,
                            qty: qty,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(res) {
                            console.log(res);
                            $(button).closest('tr').find('.cart_total_price').text('$' + res.totalProduct);
                            // Tổng tất cả sản phẩm
                            $('#cart-sub-total').text('$' + res.total);
                            $('#cart-total').text('$' + res.total)
                        }
                    });
                }

            });

            $('.cart_quantity_delete').click(function(e) {
                e.preventDefault();

                let id = $(this).attr('id');

                $.ajax({
                    url: "{{ route('cart.delete') }}",
                    type: "POST",
                    data: {
                        id: id,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(res) {
                        console.log(res);
                        location.reload();
                    }
                });
            });

        });
    </script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    @yield('rate')
    @yield('comment')
</body>
</html>