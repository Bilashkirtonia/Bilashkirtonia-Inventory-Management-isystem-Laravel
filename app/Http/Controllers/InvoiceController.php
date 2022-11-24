<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Unit;
use App\Models\{Supplier,Purchase};
use App\Models\{Invoice,InvoiceDetail,Payment,PaymentDetail,Customer};
use Auth;
use DB;
use Barryvdh\DomPDF\Facade\Pdf;


class InvoiceController extends Controller
{
    public function view(){
        $data['allData'] = Invoice::where('status','0')->orderBy('date','desc')->orderBy('id','desc')->get();
        return view('backend.admin.invoice.view_invoice',$data);
    }

    public function add(){
        
        $data['categories'] = Category::all();
        $invoice_data = Invoice::orderBy('id','desc')->first();
        if($invoice_data == null){
            $firstReg =0;
            $invoice_no = $firstReg+1;
        }else{
            $invoice_data = Invoice::orderBy('id','desc')->first()->invoice_id;
            $invoice_no = $invoice_data+1;
        }
        $data['invoice_no'] =$invoice_no;
        $data['customers'] = Customer::all();
        $data['date'] = date('Y-m-d');
        return view('backend.admin.invoice.add_invoice',$data);
    }

    public function store(Request $request){
        if($request->category_id == null){
            return redirect()->back()->with('success','Sorry data not found');
        }else{
            if($request->paid_amount>$request->eastmate_amount){
                return redirect()->back()->with('success','Sorry paid actual amount');
            }else{
                $invoice = new Invoice();
                $invoice->invoice_id = $request->invoice_no;
                $invoice->date = date('Y-m-d',strtotime($request->date));
                $invoice->descript = $request->descript;
                $invoice->status = '0';
                $invoice->created_by = Auth::user()->id;
                
                DB::transaction(function () use($request,$invoice) {
                    if($invoice->save()){
                        $totalCategory = count($request->category_id);
                        for ($i=0; $i < $totalCategory; $i++) { 
                            $invoiceDetails = new InvoiceDetail();
                            $invoiceDetails->date = date('Y-m-d',strtotime($request->date)); 
                            $invoiceDetails->invoice_id = $invoice->id; 
                            $invoiceDetails->category_id = $request->category_id[$i]; 
                            $invoiceDetails->product_id = $request->product_id[$i]; 
                            $invoiceDetails->selling_qty = $request->selling_qty[$i]; 
                            $invoiceDetails->unit_price = $request->unit_price[$i]; 
                            $invoiceDetails->selling_price = $request->selling_price[$i];
                            $invoiceDetails->status = '0';
                            $invoiceDetails->save();
                        }
                        if($request->customer == '0'){
                            $customer = new Customer();
                            $customer->name = $request->name;                      
                            $customer->mobile = $request->mobile;
                            $customer->address = $request->address;
                            $customer->save();
                            $customer_id = $customer->id;
                        }else{
                            $customer_id = $request->customer;
                        }
                        $payment = new Payment();
                        $paymentDetail = new PaymentDetail();
                        		
                        			
                        $payment->invoice_id = $invoice->id; 
                        $payment->customer_id = $customer_id; 
                        $payment->paid_status = $request->paid_status; 
                        $payment->discount_amount = $request->discount_amount;
                        $payment->total_amount = $request->eastmate_amount;
                        // $payment->created_at = Auth::user()->id;
                        if($request->paid_status == "full_paid"){
                            $payment->paid_amount = $request->eastmate_amount;
                            $payment->due_amount = '0';
                            $paymentDetail->current_paid_amount = $request->eastmate_amount;
                        }
                        if($request->paid_status == "full_due"){
                            $payment->paid_amount = '0';
                            $payment->due_amount = $request->eastmate_amount;
                            $paymentDetail->current_paid_amount = '0';
                        }
                        if($request->paid_status == "partial_paid"){
                            $payment->paid_amount = $request->paid_amount;
                            $payment->due_amount = $request->eastmate_amount - $request->paid_amount;
                            $paymentDetail->current_paid_amount = $request->paid_amount;
                        }
                        $payment->save();
                        $paymentDetail->invoice_id = $invoice->id; 
                        $paymentDetail->date = date('Y-m-d',strtotime($request->date)); 
                        $paymentDetail->save();
                    }
                });
            }
            
        }

        return redirect()->route('view_invoice')->with('success','Data insert successfully');   
        
    }

    
    public function delete($id){
        $invoice = Invoice::find($id);
        $invoice->delete();
        InvoiceDetail::where('invoice_id',$invoice->id)->delete();
        Payment::where('invoice_id',$invoice->id)->delete();
        PaymentDetail::where('invoice_id',$invoice->id)->delete();
        return redirect()->route('pending_invoice')->with('success','Data insert successfully');
    
        }

    public function pending(){
        $data['allData'] = Invoice::where('status','1')->orderBy('date','desc')->orderBy('id','desc')->get();           
         return view('backend.admin.invoice.pending_invoice',$data);
    }

    public function approved($id){
        $data['allData'] = Invoice::with(['invoiceDetail'])->find($id);
        $data['payment'] = Payment::where('invoice_id',$data['allData']->id)->first();
        return view('backend.admin.invoice.approve_invoice',$data);
}

    public function approved_store(Request $request,$id){
        foreach ($request->selling_qty as $key => $value) {
            $invoice_details = InvoiceDetail::where('id',$key)->first();
            $product = Product::where('id',$invoice_details->product_id)->first();
            if($product->quantity < $request->selling_qty[$key]){
                return redirect()->back()->with('success','Sorry stoke are null');
            }
        }
        $invoice = Invoice::find($id);
        $invoice->approved_by = Auth::user()->id;
        $invoice->status = '1';
        DB::transaction(function () use ($request, $invoice,$id){
            foreach ($request->selling_qty as $key => $value) {
            $invoice_details = InvoiceDetail::where('id',$key)->first();
            $invoice_details->status = '1';
            $invoice_details->save();
            $product_name = Product::where('id',$invoice_details->product_id)->first();
            $product_name->quantity = ((float)$product_name->quantity) - ((float)$request->selling_qty[$key]);
            $product_name->save();
            }
            $invoice->save();
        });
        return redirect()->route('view_invoice')->with('success','Data insert successfully');
    }
    

    public function print_invoice(){
        $data['allData'] = Invoice::where('status','1')->orderBy('date','desc')->orderBy('id','desc')->get();           
         return view('backend.admin.invoice.print_invoice',$data);
    }

    public function print_invoice_list($id){
        $data['allData'] = Invoice::with(['invoiceDetail'])->find($id);
        $data['payment'] = Payment::where('invoice_id',$data['allData']->id)->first();
          $pdf = Pdf::loadView('backend.admin.invoice.invoicePDF', $data);
          return $pdf->stream('document.pdf');
          
    }

    public function monthly_pdf_report(){
        return view('backend.admin.invoice.monthly_pdf_report');
        
    }
    public function monthly_pdf_report_list(Request $request){
        $s_date = date('Y-m-d',strtotime($request->s_date));
        $e_date = date('Y-m-d',strtotime($request->e_date));
        $data['allData'] = Invoice::whereBetween('date',[$s_date,$e_date])->where('status','1')->get();
        $data['s_date'] = date('Y-m-d',strtotime($request->s_date));
        $data['e_date'] = date('Y-m-d',strtotime($request->e_date));
        $pdf = Pdf::loadView('backend.admin.pdf.monthly_pdf_report_list',$data);
        return $pdf->stream('document.pdf');
    }
  

}
