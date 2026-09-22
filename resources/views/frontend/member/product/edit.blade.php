@extends('frontend.layouts.app')
@section('content')
<section id="form">
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
                                            <a href="{{ route('frontend.add') }}"> Edit Product </a> 
                                        </li> 
                                    </ul> 
                                </div> 
                            </div>
                        </div>
                        
                    </div><!--/category-products-->
                
                    
                </div>
            </div>
            <div class="col-sm-9">
                <div class="blog-post-area">
                    <h2 class="title text-center">Edit product</h2>

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                        <div class="signup-form"><!--sign up form-->
                    <h2>Edit Product!</h2>
                    <form action="{{ route('frontend.update', ['id' => $data->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="col-md-12">Product Name</label>
                            <div class="col-md-12">
                                <input type="text" name="name" placeholder="Vui long nhap ten san pham" class="form-control form-control-line" value="{{ $data->name }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="example-email" class="col-md-12">Price</label>
                            <div class="col-md-12">
                                <input type="number" name="price" placeholder="Vui long nhap gia" class="form-control form-control-line" value="{{ $data->price }}">
                            </div>
                        </div>
                        
                       <div class="form-group">
                            <label class="col-sm-12">Select Category</label>
                            <div class="col-sm-12">
                                <select name="id_category" class="form-control form-control-line">
                                    <option value="">-- Chon Category --</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $data->id_category == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>  
                        </div>

                        <div class="form-group">
                            <label class="col-sm-12">Select Brand</label>
                            <div class="col-sm-12">
                                <select name="id_brand" class="form-control form-control-line">
                                    <option value="">-- Chon Brand --</option>
                                     @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}"
                                            {{ $data->id_brand == $brand->id ? 'selected' : '' }}>
                                            {{ $brand->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-12">Sale</label>
                            <div class="col-sm-12">
                                <select name="sale" id="sale" class="form-control form-control-line" onchange="checkSale()">
                                    <option value="0" {{ $data->sale == 0 ? 'selected' : '' }}>New</option>
                                    <option value="1" {{ $data->sale == 1 ? 'selected' : '' }}>Sale</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group" id="sale-price" style="display: none;">
                            <label class="col-md-12">Sale (%)</label> 
                            <div class="col-md-3"> 
                                <div style="display: flex; align-items: center;">
                                    <input type="number"
                                        name="sale_price"
                                        placeholder="Nhập % giảm giá"
                                        class="form-control form-control-line" min="0" max="100" value="{{ $data->sale_price }}">

                                    <span style="margin-left: 3px;">%</span>
                                </div> 
                            </div>
                        </div> 

                        <div class="form-group">
                            <label class="col-md-12"> Company</label>
                            <div class="col-md-12">
                                <input type="text" name="company" placeholder="Nhap Company" class="form-control form-control-line" value="{{ $data->company }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Image</label>
                            <div class="col-md-12">
                                @if(!empty($data->hinhanh))
                                    @php
                                        $getArrImage = json_decode($data->hinhanh, true);
                                    @endphp

                                    @if(!empty($getArrImage))
                                        @foreach($getArrImage as $image)
                                            <div style="display: inline-block; text-align: center; margin-right: 20px;">
                                                <img width="100px"
                                                    src="{{ asset('upload/product/image/' . $image) }}"
                                                    style="display: block; margin-bottom: 8px;">
                                                <input type="checkbox" name="hinhxoa[]" value="{{ $image }}" placeholder="Chon anh">
                                                
                                            </div>
                                        @endforeach
                                    @endif
                                @endif 
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12">Detail</label>
                            <div class="col-md-12">
                                <input type="text" name="detail" placeholder="Nhap chi tiet" class="form-control form-control-line" value="{{ $data->detail }}">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-default">Update Product</button>
                            </div>
                        </div>

                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    function checkSale() {
        var sale = document.getElementById('sale').value;
        var salePrice = document.getElementById('sale-price');

        if (sale == '1') {
            salePrice.style.display = 'block';
        } else {
            salePrice.style.display = 'none';
        }
    }
</script>
@endsection

