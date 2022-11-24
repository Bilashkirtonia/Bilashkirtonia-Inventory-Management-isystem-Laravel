<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Unit;
use App\Models\Supplier;
use Auth;

class ProductController extends Controller
{
    public function view(){
        $data['allData'] = Product::paginate(5);
        return view('backend.admin.product.view_product',$data);
    }

    public function add(){
        $data['suppliers'] = Supplier::all();
        $data['categories'] = Category::all();
        $data['units'] = Unit::all();
        return view('backend.admin.product.add_product',$data);
    }

    public function store(Request $request){
        $request->validate([
            'name'=>'required',
            'supplier_id'=>'required',
            'unit_id'=>'required',
            'category_id'=>'required',

        ]);
        $data = new Product();
        $data->supplier_id = $request->supplier_id;
        $data->unit_id = $request->unit_id;
        $data->category_id = $request->category_id;
        $data->name = $request->name;
        $data->created_by = Auth::User()->id;
        $data->save();
        return redirect()->route('view_product')->with('success','Data insert successfully');

        
    }
    public function edit($id){
        $data['editProduct'] = Product::find($id);
        $data['suppliers'] = Supplier::all();
        $data['categories'] = Category::all();
        $data['units'] = Unit::all();
        return view('backend.admin.product.add_product',$data);
    }

    public function update(Request $request,$id){
        $request->validate([
            'name'=>'required',
            'supplier_id'=>'required',
            'unit_id'=>'required',
            'category_id'=>'required',

        ]);

        $data = Product::find($id);
        $data->supplier_id = $request->supplier_id;
        $data->unit_id = $request->unit_id;
        $data->category_id = $request->category_id;
        $data->name = $request->name;
        $data->updated_by = Auth::User()->id;
        $data->save();
        return redirect()->route('view_product')->with('success','Data insert successfully');
  }

  public function delete($id){
    Product::find($id)->delete();
    return redirect()->route('view_product')->with('success','Data insert successfully');

    }

}
