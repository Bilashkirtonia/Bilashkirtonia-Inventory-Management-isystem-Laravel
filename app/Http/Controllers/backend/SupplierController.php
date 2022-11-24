<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Product;
class SupplierController extends Controller
{
    public function view(){
        $data['suppliers'] = Supplier::all();
//$data['product'] = Product::where('supplier_id',$data['suppliers']['supplier_id']->id)->count();
        return view('backend.admin.supplier.view_supplier',$data);
    }

    public function add(){
        return view('backend.admin.supplier.add_supplier');
    }

    public function store(Request $request){
        $request->validate([
            'name'=>'required|unique:suppliers,name',
            'email'=>'required|unique:suppliers,email',
            'mobile'=>'required',
            'address'=>'required'

        ]);
        $data = new Supplier();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->mobile = $request->mobile;
        $data->address = $request->address;
        $data->save();
        return redirect()->route('view_supplier')->with('success','Data insert successfully');

        
    }
    public function edit($id){
        $data['editSupplier'] = Supplier::find($id);
        return view('backend.admin.supplier.add_supplier',$data);
    }

    public function update(Request $request,$id){
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'mobile'=>'required',
            'address'=>'required'

        ]);
        $data = Supplier::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->mobile = $request->mobile;
        $data->address = $request->address;
        $data->save();
        return redirect()->route('view_supplier')->with('success','Data insert successfully');

  }

  public function delete($id){
    Supplier::find($id)->delete();
    return redirect()->route('view_supplier')->with('success','Data insert successfully');

    }

}
