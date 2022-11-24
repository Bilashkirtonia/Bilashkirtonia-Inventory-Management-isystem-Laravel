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
              <p><strong>Supplie wise stock reports</strong></p>
              <table class="table" style="width: 100%;" border="2">
                <thead>
                    <tr>
                        <th>Si</th>
                        <th >Customer name</th>
                        <th >Invoice no</th>
                        <th >Date</th>
                        <th >Paid amount</th>   
                        <th >Due amount</th>                         
                        
                    </tr>
                </thead>
                @php
                  $totall_price = 0;
                @endphp
                 
                <tbody>
                    @foreach ($allData as $key=> $customer)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $customer->customer->name }}<br>
                              ({{ $customer->customer->address }} - {{ $customer->customer->mobile }})
                        </td>
                        <td>Invvoice #{{ $customer->invoice->invoice_id }}</td>
                        <td>{{ date("d-m-Y",strtotime($customer->invoice->date)) }}</td>
                        <td>{{ $customer->paid_amount }} Tk</td>
                        <td>{{ $customer->due_amount }} Tk</td>
                        @php
                        $totall_price += $customer->due_amount;
                        @endphp 
                        
                    </tr>  
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