<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF</title>
    {{-- <link rel="stylesheet" href="{{ asset('') }}css/bootstrap.min.css"> --}}
    <style>
        *{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            list-style: none;
            text-decoration: none;
            text-align: center;
        }
        .container{    
            border: 3px solid #000;  
            margin: 10px;       
        }
        .container .row{
/*           
           display: flex;
           justify-content: space-between;
           align-items: center;
           
            */
        }
        h2,p,span{
            text-align: left;
            color: #000;
        }
        
    </style>
</head>
<body>
    <div class="container">
        <div class="row" style="margin: 50px ;text-align:center;">
           
            <table class="table" style="width=100%;margin-top:50px;">
                <tbody>
                    <tr>
                      <td style="text-align:left">
                        <h3 style="text-align:left">D-shop</h3>
                        <p style="text-align:left">Dhaka Farmgate</p>
                        <span style="margin-bottom:50px; text-align:left;">Mobile : 01778965412</span>
                        </td>
                      </tr>
                      <p><strong>Invoice no : {{ $allData->invoice_id }}</strong></p>
                  <tr>
                    <td ><strong>Customer info </strong></td>
                    <td ><strong>Name : {{ $payment->customer->name }}</strong></td>
                    <td ><strong>Mobile no: {{ $payment->customer->mobile }}</strong></td>
                    <td ><strong>Address : {{ $payment->customer->address }}</strong></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td colspan="1"><strong>Description : {{ $allData->descript }}</strong></td>
                  </tr>
                </tbody>
              </table>
              <table class="table" style="width: 100%;" border="2">
               <thead>
                <tr>
                  <th>Sl</th>
                  <th>Category </th>
                  <th>Product name</th>
                  <th>Current stock</th>
                  <th>Quanty</th>
                  <th>Unit price</th>
                  <th width="20%">Total price</th>
                  
                </tr>
               </thead>
               <tbody>
                @php
                  $totall_price = 0;
                @endphp
                @foreach ($allData['invoiceDetail'] as $key => $details)
                  <tr>
                    
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
                  <td style="text-align: left" colspan="6">Sub total</td>
                  <td style="text-align: center">{{ $totall_price }} Tk</td>
                </tr>
                <tr>
                  <td style="text-align: left" colspan="6">Discount</td>
                  <td style="text-align: center" >{{ $payment->discount_amount }}%</td>
                </tr>
                <tr>
                  <td style="text-align: left" colspan="6">Paid amount</td>
                  <td style="text-align: center">{{ $payment->paid_amount }} Tk</td>
                </tr>
                <tr>
                  <td style="text-align: left" colspan="6">Due amount</td>
                  <td style="text-align: center">{{ $payment->due_amount }} Tk</td>
                </tr>
                <tr>
                  <td style="text-align: left" colspan="6">Grand total</td>
                  <td style="text-align: center">{{ $payment->total_amount }} Tk</td>
                </tr>
                >
               </tbody>

              </table>
              <span style="text-decoration: underline; float:right;padding-top:50px;">Owner signature</i></span>
              <p>Date : {{ date('d-m-Y') }}</p>
            
        </div>


    {{-- <script src="{{ asset('') }}js/bootstrap.bundle.min.js"></script> --}}
</body>
</html>