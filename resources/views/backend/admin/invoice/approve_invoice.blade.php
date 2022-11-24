@extends('backend.admin.master')
@section('content')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">Product pending list</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Pending list</li>
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
                <h4>invoice_id : {{ $allData->invoice_id }} , Date : {{ $allData->date }}
                  
                 <a href="{{ route('pending_invoice') }}" style="float: right;"  class="btn btn-primary">
                    <i class="fas fa-list"></i> pending invoice list
                  </a>
                  
                </h4>
              </div>
              <form action="{{ route('approved_store',$allData->id) }}" method="post">
                @csrf
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12 m-auto">
                      <table class="table" width="100%">
                        <tbody>
                          <tr >
                            <td class="text-center" width="15"><strong>Customer info </strong></td>
                            <td width="25"><strong>Name : {{ $payment->customer->name }}</strong></td>
                            <td class="text-center" width="25"><strong>Mobile no: {{ $payment->customer->mobile }}</strong></td>
                            <td class="text-center" width="35"><strong>Address : {{ $payment->customer->address }}</strong></td>
                          </tr>
                          <tr>
                            <td></td>
                            <td colspan="3"><strong>Description : {{ $allData->descript }}</strong></td>
                          </tr>
                        </tbody>
                      </table>
                      <table class="table" border="2">
                       <thead>
                        <tr>
                          <th>Sl</th>
                          <th>Category </th>
                          <th>Product name</th>
                          <th>Current stock</th>
                          <th>Quanty</th>
                          <th>Unit price</th>
                          <th width="20%">Total price</th>
                          <th></th>
                        </tr>
                       </thead>
                       <tbody>
                        @php
                          $totall_price = 0;
                        @endphp
                        @foreach ($allData['invoiceDetail'] as $key => $details)
                          <tr>
                            <input type="hidden" name="category_id[]" value="{{ $details->category_id }}">
                            <input type="hidden" name="product_id[]" value="{{ $details->product_id }}">
                            <input type="hidden" name="selling_qty[{{ $details->id }}]" value="{{ $details->selling_qty }}">
                            <td>{{ $key+1 }}</td>
                            <td>{{ $details->category->name }}</td>
                            <td>{{ $details->product->name }}</td>
                            <td>{{ $details->product->quantity }}</td>
                            <td>{{ $details->selling_qty }}</td>
                            <td>{{ $details->unit_price }} Tk</td>
                            <td>{{ $details->selling_price }} Tk</td>
                          </tr>
                          @php
                          $totall_price += $details->selling_price;
                        @endphp
                        @endforeach
                        <tr>
                          <td colspan="6">Sub total</td>
                          <td>{{ $totall_price }} Tk</td>
                        </tr>
                        <tr>
                          <td colspan="6">Discount</td>
                          <td>{{ $payment->discount_amount }}%</td>
                        </tr>
                        <tr>
                          <td colspan="6">Paid amount</td>
                          <td>{{ $payment->paid_amount }} Tk</td>
                        </tr>
                        <tr>
                          <td colspan="6">Due amount</td>
                          <td>{{ $payment->due_amount }} Tk</td>
                        </tr>
                        <tr>
                          <td colspan="6">Grand total</td>
                          <td>{{ $payment->total_amount }} Tk</td>
                        </tr>
                       </tbody>

                      </table>
                    <input type="submit" class="btn btn-success" value="Purchase" name="submit">
                    </div>
                  </div>
                </div>
              </form>
              
            </div>
            
        </div>
    </div>



</div>

@endsection