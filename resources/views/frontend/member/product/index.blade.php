@extends('frontend.layouts.app')
@section('content')
<section id="form" >
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Account</h2>
                    <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                        
                        
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title"><a href="{{ route('frontend.account') }}">account</a></h4>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a href="#my-product" data-toggle="collapse">My product
                                        <span class="pull-right">
                                            <i class="fa fa-plus"></i>
                                        </span>
                                    </a>
                                </h4>
                            </div>
                            <div id="my-product" class="panel-collapse collapse"> 
                                <div class="panel-body"> 
                                    <ul> 
                                        <li> 
                                            <a href="{{ route('frontend.list') }}"> List Product </a> 
                                        </li> 
                                        <li> 
                                            <a href="{{ route('frontend.add') }}"> Create Product </a> 
                                        </li> 
                                    </ul> 
                                </div> 
                            </div>
                        </div>
                        
                    </div><!--/category-products-->
                
                     
                </div>
            </div>
            <div class="col-sm-9">
                <div class="table-responsive cart_info">

                    <table class="table table-condensed">
                        <thead>
                            <tr class="cart_menu">
                                <td class="image">Image</td>
                                <td class="description">Name</td>
                                <td class="price">Price</td>
                                <td class="total">Action</td>
                            </tr>
                        </thead>

                        <tbody>
                            @if($data->count() > 0)
                                @foreach($data as $row)
                                    @php
                                        $getProducts = $row->toArray();
                                        $getArrImage = json_decode($getProducts['hinhanh'], true);
                                    @endphp
                                    <tr>
                                        <td class="cart_product">
                                            @if(!empty($getArrImage))
                                                <img width="100px"
                                                    src="{{ asset('upload/product/image/' . $getArrImage[0]) }}"
                                                    alt="{{ $row->name }}">
                                            @endif
                                        </td>

                                        <td class="cart_description">
                                            <h4>{{ $row->name }}</h4>
                                        </td>

                                        <td class="cart_price">
                                            <p>${{ ($row->price) }} </p>
                                        </td>

                                        <td class="cart_total">
                                            <a href="{{ route('frontend.edit', ['id' => $row->id]) }}">Edit</a>
                                            <a href="#">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else

                                <tr>
                                    <td colspan="4" style="text-align: center;">
                                        Không có mặt hàng nào
                                    </td>
                                </tr>

                            @endif
                        </tbody>

                    </table>

                </div>
            </div>

        </div>
    </div>
</section>
@endsection