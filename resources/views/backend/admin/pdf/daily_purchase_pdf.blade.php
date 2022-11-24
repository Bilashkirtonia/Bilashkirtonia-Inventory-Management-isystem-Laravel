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
                    <td style="text-align: center"><strong>Daily purchase : ({{ $s_date }}-{{ $e_date }})</strong></td>
                  </tr>
                  
                </tbody>
              </table>
              <table class="table" style="width: 100%;" border="2">
                <thead>
                  <tr>
                      <th>Si</th>
                      <th >Purchase no</th>
                      <th width="10%" >Date</th>
                      <th >Supplier name</th>
                      <th >Category</th>
                      <th >Product name</th> 
                      <th >Description</th>
                      <th >Quantity</th> 
                      <th >Unit price</th>
                      <th >Buying price</th>  
                      
                  </tr>
              </thead>
              <tbody>
                @php
                  $totall_price = 0;
                @endphp
                  @foreach ($allData as $key=> $data)
                  <tr>
                      <td>{{ $key+1 }}</td>
                      <td>{{ $data->purchase_no }}</td>
                      <td>{{ date('d-m-Y',strtotime($data->date)) }}</td>
                      <td>{{ $data->supplier->name }}</td>
                      <td>{{ $data->category->name }}</td>
                      <td>{{ $data->product->name }}</td>
                      <td>{{ $data->description }}</td>
                      <td>{{ $data->buying_qty }} {{ $data->product->unit->name }}</td>
                      <td>{{ $data->unit_price }}</td>
                      <td>{{ $data->buying_price }}</td>
                      
                  </tr> 
                  @php
                  $totall_price += $data->buying_price;
                  @endphp 
                  @endforeach
                  
                  <tr>
                    <td style="text-align: left" colspan="9">Grand price</td>
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