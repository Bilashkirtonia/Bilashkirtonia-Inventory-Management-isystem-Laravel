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
                </tbody>
              </table>
              <p><strong>Details</strong></p>
              <table class="table" style="width:100%;margin-bottom:20px;">
                <tr>
                    <td> Customer name : <strong>{{ $payment->customer->name }}</strong></td>
                    <td> Customer address : <strong>{{ $payment->customer->address }}</strong></td>
                    <td> Customer mobile : <strong>{{ $payment->customer->mobile }}</strong></td>
                </tr>
              </table>
              <table class="table" style="width:100%;" border="1">
                <thead>
                    <tr>
                      <th>Sl</th>
                      <th>Category </th>
                      <th>Product name</th>
                      
                      <th>Quanty</th>
                      <th>Unit price</th>
                      <th width="20%">Total price</th>
                      
                    </tr>
                   </thead>
                   <tbody>
                    @php
                      $totall_price = 0;
                    @endphp
                    @foreach ($invoice_details as $key => $details)
                      <tr>
                        
                        <td>{{ $key+1 }}</td>
                        <td>{{ $details->category->name }}</td>
                        <td>{{ $details->product->name }}</td>
                        
                        <td>{{ $details->selling_qty }}</td>
                        <td>{{ $details->unit_price }} Tk</td>
                        <td>{{ $details->selling_price }} Tk</td>
                      </tr>
                      @php
                      $totall_price += $details->selling_price;
                    @endphp
                    @endforeach
                    
                    <tr>
                      <td style="text-align: left" colspan="5">Sub total</td>
                      <td style="text-align: left">{{ $totall_price }} Tk</td>
                    </tr>
                    <tr>
                      <td style="text-align: left" colspan="5">Discount</td>
                      <td style="text-align: left" >{{ $payment->discount_amount }}%</td>
                    </tr>
                    <tr>
                      <td style="text-align: left" colspan="5">Paid amount</td>
                      <td style="text-align: left">{{ $payment->paid_amount }} Tk</td>
                      
                    </tr>
                    <tr>
                      <td style="text-align: left" colspan="5">Due amount</td>
                      <td style="text-align: left">{{ $payment->due_amount }} Tk</td>
                     
                    </tr>
                    <tr>
                      <td style="text-align: left" colspan="5">Grand total</td>
                      <td style="text-align: left">{{ $payment->total_amount }} Tk</td>
                    </tr>
                    <tr>
                        <td style="text-align: center" colspan="6"><strong>Paid summary</strong></td>
                    </tr>
                    <tr>
                        <td style="text-align: right" colspan="3">Date</td>
                        <td style="text-align: left" colspan="3">Amount</td>
                      
                    </tr>
                    <tr>
                        @foreach ($payment_details as $payment_detail)
                        <td style="text-align: right" colspan="3">{{ $payment_detail->date }}</td>
                        <td style="text-align: left" colspan="3">{{ $payment_detail->current_paid_amount }}</td>
                        @endforeach
                    </tr>
                    
                   </tbody>
            </table>
              <span style="text-decoration: underline; float:right">Owner signature</i></span>

              <p>Date : {{ date('d-m-Y') }}</p>


            
        </div>


    {{-- <script src="{{ asset('') }}js/bootstrap.bundle.min.js"></script> --}}
</body>
</html>