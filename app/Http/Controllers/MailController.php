<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailNotify;
use App\Models\History;
use Exception;
use Illuminate\Support\Facades\Auth;

class MailController extends Controller
{
    //
    public function index() 
    {
        //Lay User dang dang nhap
        $user = Auth::user();

        //Neu chua dang nap khong cho dat hang
        if (!$user) {
            return "Vui lòng đăng nhập trước khi đặt hàng";
        }

        //Lay gio hang
        $array =[];
        $cart = session()->get('cart', $array);

        //Kiem tra gio hang
        if(empty($cart)) {
            return "Giỏ hàng đang trống!";
        }
        
        // Tính tổng tiền
        $total = 0;

        foreach ($cart as $product) {
            $total += (float) $product['price'] * (int) $product['qty'];
        }

        $data = [
            'subject' => 'Xac nhan don hang',
            'body' => 'Cam on ban da dat hang!'
        ];
        try {
            Mail::to('nnanhtai1012@gmail.com')->send(new MailNotify($data, $cart));

            //Lưu lịch sử mua hàng
            History::create([
                'email' => $user->email,
                'phone' => $user->phone,
                'name' => $user->name,
                'id_user'=> $user->id,
                'price' => $total,
            ]);

            // Xóa giỏ hàng sau khi đặt hàng thành công
            session()->forget('cart');
            
            return response()->json(['Great check your mail box']);
        } catch (Exception $th) {
            return response()->json(['sorry']);
        }
    }
}
