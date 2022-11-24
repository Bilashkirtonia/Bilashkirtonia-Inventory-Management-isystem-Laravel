<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Customer,Payment};
use App\Models\InvoiceDetail;
use App\Models\{PaymentDetail};
use Barryvdh\DomPDF\Facade\Pdf;
use Auth;
class CustomerController extends Controller
{
    public function view(){
        $data['customers'] = Customer::paginate(5);
        return view('backend.admin.customer.view_customer',$data);
    }

    public function add(){
        return view('backend.admin.customer.add_customer');
    }

    public function store(Request $request){
        $request->validate([
            'name'=>'required|unique:Customers,name',
            'email'=>'required|unique:Customers,email',
            'mobile'=>'required',
            'address'=>'required'

        ]);
        $data = new Customer();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->mobile = $request->mobile;
        $data->address = $request->address;
        $data->save();
        return redirect()->route('view_customer')->with('success','Data insert successfully');

        
    }
    public function edit($id){
        $data['editCustomer'] = Customer::find($id);
        return view('backend.admin.customer.add_customer',$data);
    }

    public function update(Request $request,$id){
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'mobile'=>'required',
            'address'=>'required'

        ]);
        $data = Customer::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->mobile = $request->mobile;
        $data->address = $request->address;
        $data->save();
        return redirect()->route('view_customer')->with('success','Data insert successfully');

  }

  public function delete($id){
    Customer::find($id)->delete();
    return redirect()->route('view_customer')->with('success','Data insert successfully');

    }

    public function credit(){
        $data['allData']=Payment::whereIn('paid_status',['partial_paid','due_amount'])->get();
        return view('backend.admin.customer.credit_customer',$data);
    }

    public function credit_pdf(){
        $data['allData']=Payment::whereIn('paid_status',['partial_paid','full_due'])->get();
        $pdf = Pdf::loadView('backend.admin.pdf.credit_customer_pdf',$data);
        return $pdf->stream('document.pdf');
    }
    public function credit_edit_customer($invoice_id){
        $data['payment'] = Payment::where('invoice_id',$invoice_id)->first();
        $data['invoice_details'] = InvoiceDetail::where('invoice_id',$data['payment']->invoice_id)->get();
        return view('backend.admin.customer.credit_edit_customer',$data);
    }

    public function update_credit_customer(Request $request,$invoice_id){
        if($request->new_paid_amount < $request->paid_amount){
            return redirect()->back()->with('error',"Sorry increate amount");
        }else{
            $payment = Payment::where('invoice_id',$invoice_id)->first();
            $payment_details = new PaymentDetail();
            $payment->paid_status = $request->paid_status;
            if($request->paid_status == 'full_paid'){
               $amount =  $payment->paid_amount; 
               $request_new_paid_amount = $amount + $request->new_paid_amount;
               $payment->paid_amount = $request_new_paid_amount;
               $payment->due_amount = '0';
               $payment_details->current_paid_amount = $request->new_paid_amount;
            }else if($request->paid_status == 'partial_paid'){
               $amount =  $payment->paid_amount; 
               $request_new_paid_amount = $amount + $request->paid_amount;
               $payment->paid_amount = $request_new_paid_amount;
               $payment->due_amount = Payment::where('invoice_id',$invoice_id)->first()['due_amount'] - $request->paid_amount;
               $payment_details->current_paid_amount = $request->paid_amount;
            }
            $payment->save();
            $payment_details->invoice_id = $invoice_id;
            $payment_details->date = date('Y-m-d',strtotime($request->date));
            $payment_details->updated_by = Auth::user()->id;
            $payment_details->save();

        }
        return redirect()->route('credit_customer')->with('success','Data update successfully');
    }

    public function credit_details_customer($invoice_id){
        $data['payment'] = Payment::where('invoice_id',$invoice_id)->first();
        $data['invoice_details'] = InvoiceDetail::where('invoice_id',$data['payment']->invoice_id)->get();
        $data['payment_details'] = PaymentDetail::where('invoice_id',$data['payment']->invoice_id)->get();

        $pdf = Pdf::loadView('backend.admin.pdf.credit_details_customer',$data);
        return $pdf->stream('document.pdf');
    }

    public function paid(){
        $data['allData']=Payment::where('paid_status','!=','full_due')->get();
        return view('backend.admin.customer.paid_customer',$data);
    }

    public function paid_pdf(){
        $data['allData']=Payment::where('paid_status','!=','full_due')->get();
        $pdf = Pdf::loadView('backend.admin.pdf.paid_customer_pdf',$data);
        return $pdf->stream('document.pdf');
    }

    public function customer_wise_report(){
        $data['customers'] = Customer::all();
        return view('backend.admin.customer.customer_wise_report',$data);

    }

    public function customer_wise_credit_report_pdf(Request $request){
        $data['allData'] = Payment::where('customer_id',$request->supplier)->whereIn('paid_status',['partial_paid','full_due'])->get();
        $pdf = Pdf::loadView('backend.admin.pdf.customer_wise_credit_report_pdf',$data);
        return $pdf->stream('document.pdf');
    }

    public function customer_wise_paid_report_pdf(Request $request){
        $data['allData']=Payment::where('customer_id',$request->supplier1)->where('paid_status','!=','full_due')->get();
        $pdf = Pdf::loadView('backend.admin.pdf.customer_wise_paid_report_pdf',$data);
        return $pdf->stream('document.pdf');
    }

}
