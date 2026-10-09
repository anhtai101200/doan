<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


class CartController extends Controller
{
    public function index(Request $request) 
    {
        $hideMenu = true;
        $array = [];
        $cart = session()->get('cart', $array);
        return view('frontend.member.cart.index', compact('cart','hideMenu'));
    }

    public function cart(Request $request) 
    {

        //Nhan ID tu ajax
        $id = $request->id;

        //lay thong tin product theo ID
        $product = Product::find($id);

        //Chuyen product thanh mang
        $product = $product->toArray();

        //Tang qty
        $product['qty'] = 1;

        //Dua mang vao session
        session()->push('cart', $product);

        // Lấy cart ra
        $array = [];

        $cart = session()->get('cart', $array);
    
        
        // Trả về cho AJAX
        return response()->json([
            'message' => 'Thêm vào giỏ hàng thành công',
            'count' => count($cart),
            'cart' => $cart
        ]);

    }

    public function delete(Request $request)
    {
        $id = $request->id;

        $cart = session()->get('cart', []);

        foreach ($cart as $key => $product) {
            if ($product['id'] == $id) {
                unset($cart[$key]);
                break;
            }
        }

        session()->put('cart', $cart);

        return response()->json([
            'message' => 'Xóa sản phẩm thành công',
            'cart' => $cart
        ]);
    }

    public function update(Request $request) 
    {
        
        $id = $request->id;
        $qty = (int) $request->qty;

        $array = [];
        $cart = session()->get('cart', $array);
    
        //Tính tiền của sản phẩm vừa cập nhật
        $totalProduct = 0;

        // Tìm sản phẩm theo ID
        
        foreach ($cart as $key => $product) {
            if ((int) $product['id'] == $id) {

                // Cập nhật số lượng
                $cart[$key]['qty'] = $qty;

                // Tính tiền sản phẩm
                $totalProduct = (float) $cart[$key]['price'] * $qty;

                break;
            }
        }

        // Lưu giỏ hàng vào session
        session()->put('cart', $cart);

        //Tính tổng tiền tất cả sản phẩm
        $total = 0;

        foreach ($cart as $product) {
            $total += (float)$product['price'] * (int)$product['qty'];
        }
      
        return response()->json([
            'totalProduct' => number_format($totalProduct),
            'total' => number_format($total)
        ]);
    }

    public function checkout(Request $request)
    {
        $hideMenu = true;
        return view('frontend.member.cart.checkout', compact('hideMenu'));
    }
}
