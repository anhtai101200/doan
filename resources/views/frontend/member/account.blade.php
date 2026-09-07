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
                    <h2 class="title text-center">Update user</h2>

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                        <div class="signup-form"><!--sign up form-->
                    <h2>New User Signup!</h2>
                    <form action="{{ url('/account/update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="col-md-12">Full Name</label>
                            <div class="col-md-12">
                                <input type="text" name="name" placeholder="Johnathan Doe" class="form-control form-control-line" value="{{ $user->name }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="example-email" class="col-md-12">Email</label>
                            <div class="col-md-12">
                                <input type="email" name="email" placeholder="johnathan@admin.com" class="form-control form-control-line" value="{{ $user->email }}" readonly>
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
                                <input type="text" name="phone" placeholder="Nhap so dien thoai" class="form-control form-control-line" value="{{ $user->phone }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Address</label>
                            <div class="col-md-12">
                                <input type="text" name="address" class="form-control form-control-line" value="{{ $user->address }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-12">Select Country</label>
                            <div class="col-sm-12">
                                <select name="id_country" class="form-control form-control-line">
                                    <option value="">-- Chon Country --</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}" {{ $user->id_country == $country->id ? 'selected' : '' }}>
                                            {{ $country->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-default">Update Profile</button>
                            </div>
                        </div>

                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
