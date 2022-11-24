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
                  
                  <a href="{{ route('add_invoice') }}" style="float: right;"  class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add
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
                              <th width='10%'>Date</th>
                              <th width='10%'>Amount</th>
                              <th width='30%'>Description</th>
                              <th width='10%'>Status</th>
                              <th width='10%'>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($allData as $key=> $data)
                          <tr>
                              <td>{{ $key+1 }}</td>
                              <td>{{ $data->payment->customer->name }}
                                ({{ $data->payment->customer->address }}
                               - {{ $data->payment->customer->mobile }})
                              </td>
                              <td>{{ $data->invoice_id }}</td>
                              <td>{{ date('d-m-Y',strtotime($data->date)) }}
                                <td>{{ $data->payment->total_amount }}</td>
                              <td>{{ $data->descript }}</td>
                              <td>
                                @if($data->status == '0')
                                  <span class="text-danger">Pending</span>
                                @elseif ($data->status == '1')
                                  <span class="text-success">Approved</span>
                                @endif
                              </td>
                              <td >
                                @if ($data->status == '0')
                                <a title="Delete" href="{{ route('delete_product',$data->id) }}" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                                 @endif 
                                 @if ($data->status == '0')
                                <a title="Approve" href="{{ route('approved_invoice',$data->id) }}" class="btn btn-sm btn-success"><i class="fas fa-check-circle"></i></a>
                                @endif 
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