@extends('backend.admin.master')
@section('content')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">Customer</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Customer</li>
      </ol>
    </div>
  </div>
  <style>
    .w-5{
      width: 100px;
    }
  </style>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4>Customer list 
                  
                  <a href="{{ route('paid_customer_pdf') }}" target="_blank" style="float: right;"  class="btn btn-primary">
                    <i class="fas fa-download"></i> Download
                  </a>
                  
                </h4>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12 m-auto">
                    <table class="table table-striped table-hover" border="2">
                      <thead>
                          <tr>
                              <th>Si</th>
                              <th >Customer name</th>
                              <th >Invoice no</th>
                              <th >Date</th>
                              <th >Paid amount</th>   
                              {{-- <th >Due amount</th> --}}
                              <th >Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($allData as $key=> $customer)
                          <tr>
                              <td>{{ $key+1 }}</td>
                              <td>{{ $customer->customer->name }}<br>
                                    ({{ $customer->customer->address }} - {{ $customer->customer->mobile }})
                              </td>
                              <td>Invoice #{{ $customer->invoice->invoice_id }}</td>
                              <td>{{ date("d-m-Y",strtotime($customer->invoice->date)) }}</td>
                              <td>{{ $customer->paid_amount }} Tk</td>
                              {{-- <td>{{ $customer->due_amount }} Tk</td> --}}
                              
                              <td>
                                <a title="Edit" href="{{ route('credit_edit_customer',$customer->invoice_id) }}" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                                <a title="Details" href="{{ route('credit_details_customer',$customer->invoice_id) }}" target="_blank" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                              </td>
                          </tr>  
                          @endforeach
                          
                          
                      </tbody>
                  </table>
                 
                  </div>
                </div>
              </div> 
            </div>
            
        </div>
    </div>



</div>

@endsection