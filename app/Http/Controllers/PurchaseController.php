<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Category;
use App\Models\Unit;
use App\Models\{Supplier,Purchase,Invoice};
use Auth;
use DB;
use Barryvdh\DomPDF\Facade\Pdf;

class PurchaseController extends Controller
{
    public function view(){
        $data['allData'] = Purchase::orderBy('date','desc')->orderBy('id','desc')->get();
        return view('backend.admin.purchase.view_purchase',$data);
    }

    public function add(){
        $data['suppliers'] = Supplier::all();
        $data['categories'] = Category::all();
        $data['units'] = Unit::all();
        return view('backend.admin.purchase.add_purchase',$data);
    }

    public function store(Request $request){
        if($request->category_id == null){
            return redirct()->back()->with('success','Sorry data not found');
        }else{
            $allCategory = count($request->category_id );

            for ($i=0; $i < $allCategory ; $i++) { 
                $purchase = New Purchase();
                $purchase->date = date('Y-m-d',strtotime($request->date[$i]));
                $purchase->purchase_no = $request->purchase_no[$i];
                $purchase->supplier_id = $request->supplier_id[$i];
                $purchase->category_id = $request->category_id[$i];
                $purchase->product_id = $request->product_id[$i];
                $purchase->buying_qty = $request->buying_qty[$i];
                $purchase->unit_price = $request->unit_price[$i];
                $purchase->description = $request->descript[$i];
                $purchase->buying_price = $request->buying_price[$i];
                $purchase->created_by = Auth::user()->id;
                $purchase->status = '0';
                $purchase->save();
                return redirect()->route('view_purchase')->with('success','Data insert successfully');

            }
        }

        
        
    }

    public function pending(){
        $data['allData'] = Purchase::orderBy('date','desc')->orderBy('id','desc')->where('status','0')->get();
        return view('backend.admin.purchase.pending_purchase',$data);
    }
    public function approve(Request $request,$id){
        $purchase = Purchase::find($id);
        $product = Product::where('id',$purchase->product_id)->first();
        $purchase_qty = ((float)($purchase->buying_qty))+((float)($product->quantity));
        $product->quantity = $purchase_qty;
        if($product->save()){
            DB::table('purchases')->where('id',$id)->update(['status'=>'1']);
        }

        return redirect()->route('pending_purchase')->with('success','Data insert successfully');
    }



  public function delete($id){
    Purchase::find($id)->delete();
    return redirect()->route('view_purchase')->with('success','Data insert successfully');

    }

    public function daily_purchase(){
        return view('backend.admin.purchase.daily_purchase');
    }

    

    public function daily_purchase_pdf(Request $request){
        $s_date = date('Y-m-d',strtotime($request->s_date));
        $e_date = date('Y-m-d',strtotime($request->e_date));
        $data['allData'] = Purchase::whereBetween('date',[$s_date,$e_date])->where('status','1')->orderBy('supplier_id')->orderBy('category_id')->get();
        $data['s_date'] = date('Y-m-d',strtotime($request->s_date));
        $data['e_date'] = date('Y-m-d',strtotime($request->e_date));
        $pdf = Pdf::loadView('backend.admin.pdf.daily_purchase_pdf',$data);
        return $pdf->stream('document.pdf');
        
        }

}
