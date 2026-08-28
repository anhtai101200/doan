<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CountryRequest;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
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
        return view('admin.coutry.list');
    }

    public function add(Request $request)
    {
        $data = new Country();
        return view('admin.country.addct', compact('data'));
    }

    public function insert(CountryRequest $request)
    {
        // dd($request->all());


        $data = $request->all();
        // $data = Country::select('id', 'name')->get();

        
        if (Country::create($data)) {
            return redirect()->back()->with('success',__('Them country thanh cong'));
        } else {
            return redirect()->back()->withErrors('Them country that bai');

        }
    }

    public function list(Request $request)
    {

        //lay theo Model
        $data = Country::all();
        //$data = Country::select('id', 'title')->get();

        // dd($data);

        return view('admin.country.listct', compact('data'));

    }

     public function delete(Request $request)
    {
        $id = $request->route('id');
        $country = Country::findorFail($id);

        if ($country) {
            $country->delete();

            return redirect('/country/list')
                ->with('success', 'Xóa country thành công');
        } else {
            return redirect('/country/list')
                ->withErrors('Không tìm thấy country');
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
