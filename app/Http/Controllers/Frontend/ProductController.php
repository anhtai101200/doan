<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        //
    }

    public function add()
    {
    	// $getArrImage = json_decode($getProducts['filename'], true);
        $hideMenu = true;

        $data = new Product();

        $categories = Category::all();
        $brands = Brand::all();

        $getArrImage = [];

        return view('frontend.member.product.add', compact('data', 'categories','brands','hideMenu','getArrImage'));
    }

    public function insert(ProductRequest $request)
    {

        $data = $request->all();

        //thêm ID của người đang đăng nhập vào dữ liệu sản phẩm trước khi lưu vào database.
        $data['id_user'] = Auth::id();

        $dataimg = [];

        if($request->hasfile('hinhanh'))
        {

            foreach($request->file('hinhanh') as $xx)
            {
                $image = Image::read($xx);

                $name = $xx->getClientOriginalName();
                $name_2 = "hinh50_".$xx->getClientOriginalName();
                $name_3 = "hinh200_".$xx->getClientOriginalName();

                //$image->move('upload/product/', $name);
                
                
                $path = public_path('upload/product/image/' . $name);
                $path2 = public_path('upload/product/image/' . $name_2);
                $path3 = public_path('upload/product/image/' . $name_3);

                // Lưu ảnh gốc
                $image->save($path);

                //Tạo ảnh 50x70
                $image->resize(50, 70)->save($path2);

                $image->resize(200, 300)->save($path3);
                
                // lấy từng tên hình ảnh đưa vào mảng
                $dataimg[] = $name;
            }

        }

        //chuyen mang thanh chuoi json sau do gan chuoi do vao $data['hinhanh']
        $data['hinhanh'] = json_encode($dataimg);
        
        if(Product::create($data)) {
            return redirect()->back()->with('success', __('Them product thanh cong'));
        } else {
            return redirect()->back()->withErrors('Them product that bai');
        }
       
    }

    public function list() {
        $hideMenu = true;

        $data = Product::select('id','hinhanh', 'name', 'price')
                ->orderBy('id', 'desc')
                ->paginate(3);
        return view('frontend.member.product.index', compact('data','hideMenu'));
    }

    public function edit(Request $request)
    {
        //dd($request->all());
        $hideMenu = true;

        $id = $request->route('id');//id tren URL
        // dd($id);
        $data = Product::findorFail($id);//tim id trong table Product

        $categories = Category::all();
        $brands = Brand::all();
        return view('frontend.member.product.edit', compact('data','categories','brands', 'hideMenu'));
       
    }

    public function update(Request $request, Product $products) 
    {
        $id = $request->route('id');//id tren URL

        //Kiem tra xem da tick checkbox chua
        if (isset($request->hinhxoa)) {
            $hinhxoa = $request->hinhxoa;
        } else {
            $hinhxoa = [];
        }
        $product = Product::find($id);
        $hinhcu = json_decode($product->hinhanh, true);//lấy hình ảnh cũ trong database và chuyển sang mang PHP
        $hinhconlai = array_diff($hinhcu, $hinhxoa);//xóa value khỏi mảng theo value
        $hinhconlai = array_values($hinhconlai);//reset key của array


        // Kiểm tra có upload hình mới không
        $files = $request->file('hinhanh');
        
        if (!empty($files)) {
            //Neu co hinh moi thi Hinhmoi + hinhconlai > 3
            $slhinhmoi = count($files);
            if (count($hinhconlai) + $slhinhmoi > 3) {
                return back()->withErrors('Tong so hinh khong duoc lon hon 3');
            } else {
                //upload anh moi
                $hinhmoi = [];
    
                foreach ($files as $file) {
    
                   $file->move('upload/product/image', $file->getClientOriginalName());
    
                   // Lấy tên ảnh mới đưa vào mảng
                    $hinhmoi[] = $file->getClientOriginalName();
                }
    
                // Ghép hình mới vào hình cũ còn lại
                $hinhconlai = array_merge($hinhconlai, $hinhmoi);
 
            }
        }

        // khong upload hình mới thì cũng lưu lại danh sách hình
        $product->hinhanh = json_encode($hinhconlai);
        $product->save();
        
        //Chuyển về danh sách sản phẩm
        return redirect()->route('frontend.list');
    }
}
