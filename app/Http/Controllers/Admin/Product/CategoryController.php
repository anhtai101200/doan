<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
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
        $data = new Category();
        $categories = Category::all();
        return view('admin.product.category.create', compact('data', 'categories'));
    }

    public function insert(CategoryRequest $request)
    {
        // dd($request->all());


        $data = $request->all();
        // $data = Country::select('id', 'name')->get();

        
        if (Category::create($data)) {
            return redirect()->back()->with('success',__('Them category thanh cong'));
        } else {
            return redirect()->back()->withErrors('Them category that bai');

        }
    }

    public function list(Request $request)
    {

        //lay theo Model
        $data = Category::all();
        //$data = Country::select('id', 'title')->get();

        // dd($data);

        return view('admin.product.category.index', compact('data'));

    }

    public function edit(Request $request)
    {
        // dd($request->all());

        $id = $request->route('id');//id tren URL
        // dd($id);
        $data = Category::findorFail($id);//tim id trong table Blog
        return view('admin.product.category.edit', compact('data'));
       
    }

    public function update(Request $request, Category $category) 
    {
        $id = $request->route('id');
        $category = Category::findorFail($id);

        $data = $request->all();
       
        $category->update($data);

        return redirect('/category/list')
            ->with('success', 'Cập nhật category thành công');

       
    }

     public function delete(Request $request)
    {
        $id = $request->route('id');
        $category = Category::findorFail($id);

        if ($category) {
            $category->delete();

            return redirect('/category/list')
                ->with('success', 'Xóa category thành công');
        } else {
            return redirect('/category/list')
                ->withErrors('Không tìm thấy category');
        }

       
    }
}
