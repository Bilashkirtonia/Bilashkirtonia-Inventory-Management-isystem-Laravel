<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Unit;
use App\Models\Supplier;
use Auth;
use Barryvdh\DomPDF\Facade\Pdf;


class StockController extends Controller
{
    public function stock_report(){
        $data['allData'] = Product::orderBy('supplier_id','asc')->orderBy('category_id','asc')->get();
        return view('backend.admin.stock.stock_report',$data);
    }

    public function stock_download(){
        $data['allData'] = Product::orderBy('supplier_id','asc')->orderBy('category_id','asc')->get();
        $pdf = Pdf::loadView('backend.admin.pdf.stock_pdf',$data);
        return $pdf->stream('document.pdf');
    }
    public function supplier_wise_report(){
        $data['suppliers'] = Supplier::all();
        $data['categories'] = Category::all();
        return view('backend.admin.stock.stock_rsupplier_wise_reporteport',$data);
    }

    public function supplier_wise_report_pdf(Request $request){
        $request->validate([
            'supplier'=>'required'
        ]);
        $data['allData'] = Product::where('supplier_id',$request->supplier)->orderBy('supplier_id','asc')->orderBy('category_id','asc')->get();
        $pdf = Pdf::loadView('backend.admin.pdf.supplier_wise_report_pdf',$data);
        return $pdf->stream('document.pdf');        
    }

    public function product_wise_report_pdf(Request $request){
        $request->validate([
            'product_id'=>'required',
            'category_id'=>'required',
        ]);
        $data['allData'] = Product::where('id',$request->product_id)->where('category_id',$request->category_id)->first();
        $pdf = Pdf::loadView('backend.admin.pdf.product_wise_report_pdf',$data);
        return $pdf->stream('document.pdf');        
    }
    








}
