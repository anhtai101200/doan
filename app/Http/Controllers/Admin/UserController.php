<?php

namespace App\Http\Controllers\Admin;
use App\Models\User;
use App\Models\Country;


use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $countries = Country::all();
            return view('admin.user.profile', compact('user', 'countries'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
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
    public function update(UpdateProfileRequest $request)
    {
        //lay id cua user
        $userId = Auth::id();

        //viet ham sql lay thong tin all cua user co id = id
        $user = User::findOrFail($userId);

        //lay all thong tin tu form nhap vao
        $data = $request->all();
        //dd($request->all());

        //lay thong tin cua file upload
        $file = $request->avatar;


        //kiem tra neu co file upload len thi lay ten file dua vao mang data
        if(!empty($file)){
            $data['avatar'] = $file->getClientOriginalName();
        }
        
        if ($data['password']) {
            $data['password'] = bcrypt($data['password']);
        }else{
            $data['password'] = $user->password;
        }

        //update all thong tin co trong mang data vao table user co id nhu tren
        if ($user->update($data)) {
            if(!empty($file)){
                $file->move('upload/user/avatar', $file->getClientOriginalName());
            }
            return redirect()->back()->with('success', __('Update profile success.'));
        } else {
            return redirect()->back()->withErrors('Update profile error.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function logout()
    {
        //
        Auth::logout();
        return redirect('/login');
    }
}
