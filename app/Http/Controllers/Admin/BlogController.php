<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;


class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //return view('admin.blog.list');
    }

    public function add(Request $request)
    {
        $data = new Blog();
        return view('admin.blog.add', compact('data'));
    }

    public function insert(BlogRequest $request)
    {
        // dd($request->all());


        $data = $request->all();

         //kiem tra neu co file upload len thi lay ten file dua vao mang data
        if(!empty($file)){
            $data['avatar'] = $file->getClientOriginalName();
        }
        
        // if($request->hasFile('image')) { 
        //     $file = $request->file('image');
        //     $fileName = '_' .$file->getClientOriginalname();
        //     $file->move('upload/blog/image', $fileName);
        //     $data['image'] = $fileName;

        // }
        if (Blog::create($data)) {
             if(!empty($file)) {
                $file->move('upload/blog/avatar', $file->getClientOriginalName());
            }
            return redirect()->back()->with('success',__('Them bai viet thanh cong'));
        } else {
            return redirect()->back()->withErrors('Them bai viet that bai');

        }
    }

    public function list(Request $request)
    {

        //lay theo Model
        //$data = Blog::all();
        $data = Blog::select('id', 'title', 'image', 'description')->get();

        // dd($data);

        return view('admin.blog.list', compact('data'));

    }

    public function edit(Request $request)
    {
        // dd($request->all());

        $id = $request->route('id');//id tren URL
        // dd($id);
        $data = Blog::findorFail($id);//tim id trong table Blog
        return view('admin.blog.edit', compact('data'));
       
    }

    public function update(Request $request, Blog $blogs) 
    {
        $id = $request->route('id');
        $blog = Blog::findorFail($id);

        $data = $request->all();
        $file = $request->image;

        if(!empty($file)) {
            $data['image'] = $file->getClientOriginalName();
        }

        if($blog->update($data)) {
            if(!empty($file)) {
                $file->move('upload/blog/image', $file->getClientOriginalName());
            }

            return redirect()->back()->with('success', __('Update Image Success.'));

        } else {
            return redirect()->back()->withErrors('Update Image Error.');
        }
    }

    public function delete(Request $request)
    {
        $id = $request->route('id');
        $blog = Blog::find($id);

        if ($blog) {
            $blog->delete();

            return redirect('/blog/list')
                ->with('success', 'Xóa bài viết thành công');
        } else {
            return redirect('/blog/list')
                ->withErrors('Không tìm thấy bài viết');
        }

       
    }

}
