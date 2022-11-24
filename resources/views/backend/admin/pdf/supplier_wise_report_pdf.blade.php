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
              <p style="margin-bottom:10px;"><strong>Supplier name : {{ $allData[0]->supplier->name }}</strong></p>
              <table class="table" style="width: 100%;" border="2">
                <thead>
                    <tr>
                        <th>Si</th>
                       
                        <th >Category</th>
                        <th >Product name</th> 
                        <th >in.qty</th>
                        <th >out.qty</th>
                        <th >Stock</th>
                        <th >Unit name</th>                          
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($allData as $key=> $data)
                    @php
                    $buying_total = App\Models\Purchase::where('category_id',$data->category_id)->where('product_id',$data->id)->where('status','1')->sum('buying_qty');
                    $selling_total = App\Models\InvoiceDetail::where('category_id',$data->category_id)->where('product_id',$data->id)->where('status','1')->sum('selling_qty');
                    @endphp
                    <tr>
                        <td>{{ $key+1 }}</td>
                                                     
                        <td>{{ $data->category->name }}</td>
                        <td>{{ $data->name }}</td>
                        <td>{{ $buying_total }}</td>
                        <td>{{ $selling_total }}</td>
                        <td>{{ $data->quantity }}</td>
                        <td>{{ $data->unit->name }}</td>
                       
                    </tr>  
                    @endforeach
                    
                    
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