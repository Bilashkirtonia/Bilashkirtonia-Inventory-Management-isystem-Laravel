@extends('backend.admin.master')
@section('content')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">Category</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Category</li>
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
                <h4>Category list 
                  
                  <a href="{{ route('add_category') }}" style="float: right;"  class="btn btn-primary">
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
                              <th >Category name</th>
                                                      
                              <th >Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($Categorys as $key=> $Category)
                          <tr>
                              <td>{{ $key+1 }}</td>
                              <td>{{ $Category->name }}</td>
                              @php
                                $count = App\Models\Product::where('category_id',$Category->id)->count();
                              @endphp
                              
                              <td>
                                <a title="Edit" href="{{ route('edit_category',$Category->id) }}" class="btn btn-success"><i class="fas fa-edit"></i></a>
                                @if ($count<1)
                                <a title="Delete" href="{{ route('delete_category',$Category->id) }}" class="btn btn-danger"><i class="fas fa-trash"></i></a>  
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