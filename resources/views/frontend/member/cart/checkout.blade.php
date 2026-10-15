@extends('frontend.layouts.app')
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Check out</li>
            </ol>
        </div><!--/breadcrums-->

        <div class="step-one">
            <h2 class="heading">Step1</h2>
        </div>
        <div class="checkout-options">
            <h3>New User</h3>
            <p>Checkout options</p>
            <ul class="nav">
                <li>
                    <label><input type="checkbox"> Register Account</label>
                </li>
                <li>
                    <label><input type="checkbox"> Guest Checkout</label>
                </li>
                <li>
                    <a href=""><i class="fa fa-times"></i>Cancel</a>
                </li>
            </ul>
        </div><!--/checkout-options-->

        <div class="register-req">
            <p>Please use Register And Checkout to easily get access to your order history, or use Checkout as Guest</p>
        </div><!--/register-req-->

        <div class="shopper-informations">
            <div class="row">
                <div class="col-sm-4">
                <div class="signup-form"><!--sign up form-->
                <!-- Hiển thị thông báo thành công -->
                @if(session('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{ session('success') }}
                </div>
                @endif

                <!-- Hiển thị lỗi -->
                @if($errors->any())
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if(!Auth::check())
                    <h2>New User Signup!</h2>

                    <form method="POST" action="{{ route('checkout.register') }}" class="form-horizontal form-material" enctype="multipart/form-data">
                        <div class="form-group">
                            @csrf
                            <label class="col-md-12">Full Name</label>
                            <div class="col-md-12">
                                <input type="text" name="name" placeholder="Johnathan Doe" class="form-control form-control-line" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="example-email" class="col-md-12">Email</label>
                            <div class="col-md-12">
                                <input type="email" name="email" placeholder="johnathan@admin.com" class="form-control form-control-line" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Password</label>
                            <div class="col-md-12">
                                <input type="password" name="password" class="form-control form-control-line">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12">Avatar</label>
                            <div class="col-md-12">
                                <input type="file" name="avatar" class="form-control form-control-line">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Phone No</label>
                            <div class="col-md-12">
                                <input type="text" name="phone" placeholder="Nhap so dien thoai" class="form-control form-control-line" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Address</label>
                            <div class="col-md-12">
                                <input type="text" name="address" class="form-control form-control-line" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-12">Select Country</label>
                            <div class="col-sm-12">
                                <select name="id_country" class="form-control form-control-line">
                                    <option value="">-- Chon Country --</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}">
                                            {{ $country->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-success">Register</button>
                            </div>
                        </div>
                    </form>
                @endif
                </div><!--/sign up form-->
                </div>					
            </div>
        </div>
        <div class="review-payment">
            <h2>Review & Payment</h2>
        </div>
        
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total = 0;
                    @endphp
                    @foreach($cart as $product)
                    <tr>
                        <td class="cart_product">
                            @php
                                $getArrImage = json_decode($product['hinhanh'], true);
                            @endphp

                            @if(!empty($getArrImage))
                                <a href=""><img src="{{asset('upload/product/image/' .$getArrImage[0]) }}" alt="" width="80" height="80" style="object-fit: cover;"></a>
                            @endif
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{ $product['name'] }}</a></h4>
                            <p>Web ID: {{ $product['id'] }}</p>
                        </td>
                        <td class="cart_price">
                            <p>${{ number_format($product['price'])}}</p>
                        </td>
                       
                        <td class="cart_total">
                            <p class="cart_total_price"> ${{ number_format((float)$product['price'] * (int)$product['qty']) }}</p>
                        </td>
                       
                    </tr>
                    @php
                        $total += (float)$product['price'] * (int)$product['qty'];
                    @endphp
                    @endforeach

                </tbody>
            </table>
            <div>
                <a class="btn btn-default check_out" href="{{ route('cart.order')}}">ORDER</a>
            </div>
        </div>
        <div class="payment-options">
                <span>
                    <label><input type="checkbox"> Direct Bank Transfer</label>
                </span>
                <span>
                    <label><input type="checkbox"> Check Payment</label>
                </span>
                <span>
                    <label><input type="checkbox"> Paypal</label>
                </span>
            </div>
    </div>
</section> <!--/#cart_items-->
@endsection