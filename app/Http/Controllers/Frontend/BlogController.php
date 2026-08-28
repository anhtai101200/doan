<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;



class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function list(Request $request)
    {
        $data = Blog::select('id','title', 'image', 'description')
                ->orderBy('id', 'desc')
                ->paginate(3);
        return view('frontend.blog.list', compact('data'));
    }

    public function detail(Request $request)
    {
        $id = $request->route('id');//lấy giá trị id từ parameter của URL route
        $data = Blog::select('id','title', 'image', 'description')->where('id', $id)
                ->first();

        $prev = Blog::where('id', '<', $id)
                ->orderBy('id', 'desc')
                ->first();

        $next = Blog::where('id', '>', $id)
                ->orderBy('id', 'asc')
                ->first();

        $avgRate = DB::table('rates')->where('id_blog', $id)->avg('rate');

        $avgRate = round($avgRate ?? 0);
        
        //Lay CMT khong dung Ajax
        $comments = DB::table('comments')
                ->join('users', 'comments.id_user', '=', 'users.id')
                ->where('comments.id_blog', $id)
                ->select(
                    'comments.*',
                    'users.name',
                    'users.avatar'
                )
                ->orderBy('comments.id', 'desc')
                ->get();

            foreach ($comments as $comment) {
                $comment->replies = $comments->where('parent_id', $comment->id);//tim cmt con
            }

            $comments = $comments->whereNull('parent_id');//lay nhung cmt khong co cha

        return view('frontend.blog.detail', compact('data', 'prev', 'next', 'avgRate', 'comments'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function rate(Request $request)
    {

        // dd($request->all());
        //Khi click danh giá thi lây sô diểm đó save vao table rate
        DB::table('rates')->insert([
            'id_blog' => $request->id_blog,
            'id_user' => $request->id_user, 
            'rate' => $request->rate
        ]);
        
        return response()->json([
            'success'=>true,
            'message'=>'Danh gia thanh cong!'
        ]);
    }

    public function comment(Request $request) 
    {
        //$data = $request->all();
        // dd($request->all());

        //lay cmt khong dung ajax

        // if (!Auth::check()) {
        //     return redirect()->back()->with('error', 'Vui lòng đăng nhập để comment');
        // }

        // DB::table('comments')->insert([
        //     'id_blog' => $request->id_blog,
        //     'id_user' => Auth::id(),
        //     'parent_id' => $request->parent_id,
        //     'name' => Auth::user()->name,
        //     'cmt' => $request->cmt,
        //     'created_at' => now(),
        //     'updated_at' => now()
        // ]);

        //lay cmt dung ajax
        $id = DB::table('comments')->insertGetId([
            'id_blog' => $request->id_blog,
            'id_user' => Auth::id(),
            'parent_id' => $request->parent_id,
            'name' => Auth::user()->name,
            'cmt' => $request->cmt,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $data = DB::table('comments')
            ->join('users', 'comments.id_user', '=', 'users.id')
            ->where('comments.id', $id)
            ->select(
                'comments.*',
                'users.name',
                'users.avatar'
            )
            ->first();

        return response()->json([
            'data'=>$data
        ]);

        // return redirect()->back()->with('success', 'Comment thành công');
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
