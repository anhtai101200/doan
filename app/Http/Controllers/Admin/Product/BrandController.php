<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // return view('admin.product.category.index');
    }

    public function add(Request $request)
    {
        $data = new Brand();
        $brands = Brand::all();
        return view('admin.product.brand.create', compact('data', 'brands'));
    }

    public function insert(BrandRequest $request)
    {
        // dd($request->all());


        $data = $request->all();
        // $data = Country::select('id', 'name')->get();

        
        if (Brand::create($data)) {
            return redirect()->back()->with('success',__('Them Brand thanh cong'));
        } else {
            return redirect()->back()->withErrors('Them Brand that bai');

        }
    }

    public function list(Request $request)
    {

        //lay theo Model
        $data = Brand::all();
        //$data = Country::select('id', 'title')->get();

        // dd($data);

        return view('admin.product.brand.index', compact('data'));

    }

    public function edit(Request $request)
    {
        // dd($request->all());

        $id = $request->route('id');//id tren URL
        // dd($id);
        $data = Brand::findorFail($id);//tim id trong table Blog
        return view('admin.product.brand.edit', compact('data'));
       
    }

    public function update(Request $request, Brand $brand) 
    {
        $id = $request->route('id');
        $brand = Brand::findorFail($id);

        $data = $request->all();
       
        $brand->update($data);

        return redirect('/brand/list')
            ->with('success', 'Cập nhật brand thành công');

       
    }

     public function delete(Request $request)
    {
        $id = $request->route('id');
        $brand = Brand::findorFail($id);

        if ($brand) {
            $brand->delete();

            return redirect('/brand/list')
                ->with('success', 'Xóa Brand thành công');
        } else {
            return redirect('/brand/list')
                ->withErrors('Không tìm thấy Brand');
        }

       
    }
}
