<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Stroage;

use App\Models\Product;

class ProductController extends Controller
{
    public function index(){
        return view('pages.product');
    }

    public function store(Request $request){

        $data=new product(); //the product here is the model

        $file=$request->my_file;

        // dd($file);
		        
        $filename=time().'.'.$file->getClientOriginalExtension();
    
        $request->my_file->move('assets/files',$filename);

        $data->file=$filename;
        $data->name = $request->product_name;
        $data->description = $request->description;
        $data->save();
        
        return redirect()->back();
    }

    public function show(){
        $data=product::all();
        return view('pages.showproduct', compact('data'));
    }

    public function download(Request $request, $file){
        return response()->download(public_path('assets/files/'.$file));
    }

    public function view($id){
        $data = Product::find($id);
        return view ('pages.viewproduct', compact('data'));
    }

}
