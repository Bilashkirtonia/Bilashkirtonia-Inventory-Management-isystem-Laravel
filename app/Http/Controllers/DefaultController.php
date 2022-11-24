<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Unit;
use App\Models\{Supplier,Purchase};
use Auth;

class DefaultController extends Controller
{
    public function get_category(Request $request){
        $supplier = $request->supplier_id;
        $category = Product::with(['category'])->select('category_id')->groupBy('category_id')->where('supplier_id',$supplier)->get();
        return response()->json($category);
    }
    public function get_product(Request $request){
        $category_id = $request->category_id;
        $product = Product::where('category_id',$category_id)->get();
        return response()->json($product);
    }
    
    public function current_stock_now(Request $request){
        $product_id = $request->product_id;
       
        $product = Product::where('id',$product_id)->first()->quantity;
       
        return response()->json($product);
    }
}
