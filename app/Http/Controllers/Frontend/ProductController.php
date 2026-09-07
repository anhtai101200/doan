<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('frontend.member.product.index');
    }

    public function add()
    {
        $hideMenu = true;
        $data = new Product();

        $categories = Category::all();
        $brands = Brand::all();

        return view('frontend.member.product.add', compact('data', 'categories','brands','hideMenu'));
    }
}
