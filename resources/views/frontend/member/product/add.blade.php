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
                                            <a href="#"> List Product </a> 
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
                <div class="blog-post-area">
                    <h2 class="title text-center">Create product</h2>

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                        <div class="signup-form"><!--sign up form-->
                    <h2>Create Product!</h2>
                    <form action="{{ route('frontend.insert') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="col-md-12">Product Name</label>
                            <div class="col-md-12">
                                <input type="text" name="name" placeholder="Vui long nhap ten san pham" class="form-control form-control-line" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="example-email" class="col-md-12">Price</label>
                            <div class="col-md-12">
                                <input type="number" name="price" placeholder="Vui long nhap gia" class="form-control form-control-line" value="">
                            </div>
                        </div>
                        
                       <div class="form-group">
                            <label class="col-sm-12">Select Category</label>
                            <div class="col-sm-12">
                                <select name="id_category" class="form-control form-control-line">
                                    <option value="">-- Chon Category --</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">
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
                                        <option value="{{ $brand->id }}">
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
                                    <option value="0">New</option>
                                    <option value="1">Sale</option>
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
                                        class="form-control form-control-line" min="0" max="100">

                                    <span style="margin-left: 3px;">%</span>
                                </div> 
                            </div>
                        </div> 

                        <div class="form-group">
                            <label class="col-md-12"> Company</label>
                            <div class="col-md-12">
                                <input type="text" name="company" placeholder="Nhap Company" class="form-control form-control-line" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Image</label>
                            <div class="col-md-12">
                                <input type="file" name="iamge" placeholder="Chon anh" class="form-control form-control-line" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12">Detail</label>
                            <div class="col-md-12">
                                <input type="text" name="detail" placeholder="Nhap chi tiet" class="form-control form-control-line" value="">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-default">Add Product</button>
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

