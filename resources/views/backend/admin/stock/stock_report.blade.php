@extends('backend.admin.master')
@section('content')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">Product</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Product</li>
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
                <h4>Product list 
                  
                  <a href="{{ route('stock_download') }}" target="_blank" style="float: right;"  class="btn btn-primary">
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
                              <th >Supplier name</th>
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
                              <td>{{ $data->supplier->name }}</td>                             
                              <td>{{ $data->category->name }}</td>
                              <td>{{ $data->name }}</td>
                              <td>{{ $buying_total }}</td>
                              <td>{{ $selling_total }}</td>
                              <td>{{ $data->quantity }}</td>
                              <td>{{ $data->unit->name }}</td>
                             
                          </tr>  
                          @endforeach
                          
                          
                      </tbody>
                    </table>
                  {{-- {{ $suppliers->links() }} --}}
                  </div>
                </div>
              </div>
            </div>
            
        </div>
    </div>



</div>

@endsection