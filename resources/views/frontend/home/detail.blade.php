@extends('frontend.layouts.app')
@section('content')
<div class="col-sm-9 padding-right">
    <div class="product-details"><!--product-details-->
        <div class="col-sm-5">
            <div class="view-product">
                @php
                    $getArrImage = json_decode($products->hinhanh, true);
                @endphp

                @if(!empty($getArrImage))
                    <a id="zoom-image" href="{{ asset('upload/product/image/' .$getArrImage[0]) }}" rel="prettyPhoto">
                        <img id="big-image" src="{{ asset('upload/product/image/' .$getArrImage[0]) }}" alt="" />
                        <h3>ZOOM</h3>

                    </a>
                    <!-- <a id="zoom-image" href="{{ asset('upload/product/image/' .$getArrImage[0]) }}" rel="prettyPhoto"><h3>ZOOM</h3></a> -->
                @endif
            </div>
            <div id="similar-product" class="carousel slide" data-ride="carousel">
                
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">

                        <div class="item active">
                            @if(isset($getArrImage[0]))
                                <a href="{{ asset('upload/product/image/' . $getArrImage[0] ) }}">

                                    <img src="{{ asset('upload/product/image/' . $getArrImage[0]) }}"
                                        alt="{{ $products->name }}"
                                        onclick="changeImage(this.src, event)">
                                </a>
                            @endif

                            @if(isset($getArrImage[1]))
                                <a href="{{ asset('upload/product/image/' . $getArrImage[1]) }}">

                                    <img src="{{ asset('upload/product/image/' . $getArrImage[1]) }}"
                                        alt="{{ $products->name }}"
                                        onclick="changeImage(this.src, event)">
                                </a>
                            @endif

                            @if(isset($getArrImage[2]))
                                <a href="{{ asset('upload/product/image/' . $getArrImage[2]) }}">

                                    <img src="{{ asset('upload/product/image/' . $getArrImage[2]) }}"
                                        alt="{{ $products->name }}"
                                        onclick="changeImage(this.src, event)">
                                </a>
                            @endif

                        </div>
                    </div>

                    <!-- Controls -->
                    <a class="left item-control" href="#similar-product" data-slide="prev">
                    <i class="fa fa-angle-left"></i>
                    </a>
                    <a class="right item-control" href="#similar-product" data-slide="next">
                    <i class="fa fa-angle-right"></i>
                    </a>
            </div>

        </div>

        <div class="col-sm-7">
            <div class="product-information"><!--/product-information-->
                <img src="images/product-details/new.jpg" class="newarrival" alt="" />
                <h2>{{$products->name }}</h2>
                <p>Web ID: 1089772</p>
                <img src="images/product-details/rating.png" alt="" />
                <span>
                    <span>US ${{ number_format($products->price, 0, '.', '') }}</span>
                    <label>Quantity:</label>
                    <input type="text" value="1" />
                    <button type="button" class="btn btn-fefault cart">
                        <i class="fa fa-shopping-cart"></i>
                        Add to cart
                    </button>
                </span>
                <p><b>Availability:</b> In Stock</p>
                <p><b>Condition:</b> New</p>
                <p><b>Brand:</b> E-SHOPPER</p>
            </div><!--/product-information-->
        </div>
    </div><!--/product-details-->
    
   
    
    <div class="recommended_items"><!--recommended_items-->
        <h2 class="title text-center">recommended items</h2>
        
        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="item active">	
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="images/home/recommend1.jpg" alt="" />
                                    <h2>$56</h2>
                                    <p>Easy Polo Black Edition</p>
                                    <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="images/home/recommend2.jpg" alt="" />
                                    <h2>$56</h2>
                                    <p>Easy Polo Black Edition</p>
                                    <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="images/home/recommend3.jpg" alt="" />
                                    <h2>$56</h2>
                                    <p>Easy Polo Black Edition</p>
                                    <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">	
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="images/home/recommend1.jpg" alt="" />
                                    <h2>$56</h2>
                                    <p>Easy Polo Black Edition</p>
                                    <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="images/home/recommend2.jpg" alt="" />
                                    <h2>$56</h2>
                                    <p>Easy Polo Black Edition</p>
                                    <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="images/home/recommend3.jpg" alt="" />
                                    <h2>$56</h2>
                                    <p>Easy Polo Black Edition</p>
                                    <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                <i class="fa fa-angle-left"></i>
                </a>
                <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                <i class="fa fa-angle-right"></i>
                </a>			
        </div>
    </div><!--/recommended_items-->
    
</div>

<script>
    function changeImage(src, e) {
        e.preventDefault();

        var image = document.getElementById('big-image');
        image.src = src;

        var zoom = document.getElementById('zoom-image');
        zoom.href = src;
    }
</script>
@endsection