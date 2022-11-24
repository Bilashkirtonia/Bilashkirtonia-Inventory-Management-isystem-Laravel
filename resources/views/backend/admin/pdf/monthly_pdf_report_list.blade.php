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
                  <tr style="text-align: center">
                    <td style="text-align: center"><strong>Report Date : ({{ $s_date }}-{{ $e_date }})</strong></td>
                  </tr>
                  
                </tbody>
              </table>
              <table class="table" style="width: 100%;" border="2">
               <thead>
                <tr>
                  <th>Sl</th>
                  <th>Name </th>
                  <th>Address-Mobile</th>
                  <th>Invoice no</th>
                  <th>Description</th>
                  <th>Totall amount</th>
                  
                  
                </tr>
               </thead>
               <tbody>
                @php
                  $totall_price = 0;
                @endphp
                @foreach ($allData as $key => $details)
                  <tr>
                    
                    <td>{{ $key+1 }}</td>
                    <td>{{ $details->payment->customer->name }}</td>
                    <td>{{ $details->payment->customer->mobile }} - {{ $details->payment->customer->address }}</td>
                    <td>Invoice no #{{ $details->invoice_id}}</td>
                    <td>{{ $details->descript }}</td>
                    <td>{{ $details->payment->total_amount }} Tk</td>
                    
                  </tr>
                  @php
                  $totall_price += $details->payment->total_amount;
                  @endphp
                  
                @endforeach
                  
                  <tr>
                    <td style="text-align: left" colspan="5">Grand price</td>
                    <td>{{ $totall_price  }}</td>
                  </tr>
                
               </tbody> 
               <div>
                
               </div>
              </table>
              <span style="text-decoration: underline; float:right">Owner signature</i></span>

              <p>Date : {{ date('d-m-Y') }}</p>


            
        </div>


    {{-- <script src="{{ asset('') }}js/bootstrap.bundle.min.js"></script> --}}
</body>
</html>