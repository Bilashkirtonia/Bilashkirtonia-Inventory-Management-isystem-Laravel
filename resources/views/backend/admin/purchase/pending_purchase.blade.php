@extends('backend.admin.master')
@section('content')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">purchase</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">purchase</li>
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
                <h4>purchase list 
                  
                  {{-- <a href="{{ route('add_purchase') }}" style="float: right;"  class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add
                  </a> --}}
                  
                </h4>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12 m-auto">
                    <table class="table table-striped table-hover table-responsive" border="2">
                      <thead>
                          <tr>
                              <th>Si</th>
                              <th >Purchase no</th>
                              <th >Date</th>
                              <th >Supplier name</th>
                              <th >Category</th>
                              <th >Product name</th> 
                              <th >Description</th>
                              <th >Quantity</th> 
                              <th >Unit price</th>
                              <th >Buying price</th>  
                              <th>Status</th>                       
                              <th width='10%'>Action</th>
                          </tr>
                      </thead>
                      <tbody>
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
                              <td>
                                @if($data->status == '0')
                                  <span class="bg-danger p-2">Pending</span>
                                @elseif ($data->status == '1')
                                  <span class="bg-success p-2">Pending</span>
                                @endif
                              </td>
                              <td >
                                @if ($data->status == '0')
                                <a title="Approve" href="{{ route('approve_purches',$data->id) }}" class="btn btn-sm btn-danger"><i class="fas fa-check rounded"></i></a>
                                 @endif 
                              </td>
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