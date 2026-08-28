<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Controller;
use App\Http\Requests\MemberLoginRequest;
use App\Http\Requests\MemberRegisterRequest;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('frontend.member.login');
    }

    public function account()
    {
        $user = Auth::user();
        $countries = Country::all();
        $hideMenu = true;
        return view('frontend.member.account', compact('user', 'countries', 'hideMenu'));
    }


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
        
        if (!empty($data['password'])) {
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


    public function register()
    {
        $countries = Country::all();
        return view('frontend.member.register', compact('countries'));
    }

    public function insert(MemberRegisterRequest $request)
    {
        $data = $request->all();
        //dd($request->all());

        //lay thong tin cua file upload
        $file = $request->avatar;


        if(!empty($file)) {
            $data['avatar'] = $file->getClientOriginalName();
        }

        //ma hoa pass dua vao mang data
        $data['password'] = bcrypt($data['password']);

        // Đăng ký từ frontend nên là Member
        $data['level'] = 0;
        if (User::create($data)) {
            if(!empty($file)) {
                $file->move('upload/user/avatar', $file->getClientOriginalName());
            }
            return redirect()->back()->with('success',__('Dang ki tai khoan thanh cong'));
        } else {
            return redirect()->back()->withErrors('Dang ki tai khoan that bai');

        }

    }

    public function login(MemberLoginRequest $request) {
        $login = [
            'email' => $request->email,
            'password' => $request->password,
            'level' => 0
        ];

        $remember = false;

        if ($request->remember_me) {
            $remember = true;
        }

        if (Auth::attempt($login, $remember)) {
            return redirect('/frontend/home');
        } else {
            return redirect()->back()->withErrors('Email or pasword is not correct!');
        }
    }

    public function logout()
    {
        //
        Auth::logout();
        return redirect('/frontend/login');
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
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
