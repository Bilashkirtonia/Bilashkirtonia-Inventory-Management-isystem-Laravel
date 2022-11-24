@extends('backend.admin.master')
@section('content')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0"> {{ (@$editProduct)?"Edit Product":"Add Product " }}</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active"> {{ (@$editProduct)?"Edit Product":"Add Product " }}</li>
      </ol>
    </div>
  </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4>
                  
                  {{ (@$editProduct)?"Edit Product":"Add Product " }}
                  
                  <a href="{{ route('view_product') }}" style="float: right;"  class="btn btn-primary">
                    <i class="fas fa-list"></i> View
                  </a>
                  
                </h4>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-10 m-auto">
                    <div class="card p-4">
                        <form action="{{ (@$editProduct)?route('update_product',$editProduct->id):route('store_product') }}" method="post" id="FormData">
                            @csrf
                            
                           <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Supplier Name</label>
                                        <select name="supplier_id" id="exampleFormControlInput1" class="form-control">
                                          <option value="">Select supplier</option>
                                        @foreach ($suppliers as $supplier)
                                          <option value="{{ $supplier->id  }}" {{ (@$editProduct->supplier_id == $supplier->id)?'selected':'' }}>{{ $supplier->name }}</option>
                                        @endforeach
                                      </select>
                                        <font style="color: red">{{ ($errors->has('supplier_id'))?($errors->first('supplier_id')):" " }}</font>
                                     </div>
                                </div>

                                <div class="col-6">
                                  <div class="mb-3">
                                      <label for="exampleFormControlInput1" class="form-label">Unit Name</label>
                                      <select name="unit_id" id="exampleFormControlInput1" class="form-control">
                                        <option value="">Select units</option>
                                      @foreach ($units as $unit)
                                        <option value="{{ $unit->id  }}" {{ (@$editProduct->unit_id == $unit->id)?'selected':'' }} >{{ $unit->name }}</option>
                                      @endforeach
                                    </select>
                                      <font style="color: red">{{ ($errors->has('unit_id'))?($errors->first('unit_id')):" " }}</font>
                                   </div>
                              </div>

                              <div class="col-6">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Category Name</label>
                                    <select name="category_id" id="exampleFormControlInput1" class="form-control">
                                      <option value="">Select category</option>
                                    @foreach ($categories as $category)
                                      <option value="{{ $category->id  }}" {{ (@$editProduct->category_id == $category->id)?'selected':'' }} >{{ $category->name }}</option>
                                    @endforeach
                                  </select>
                                    <font style="color: red">{{ ($errors->has('category_id'))?($errors->first('category_id')):" " }}</font>
                                 </div>
                            </div>


                            <div class="col-6">
                              <div class="mb-3">
                                  <label for="exampleFormControlInput1" class="form-label">Product Name</label>
                                  <input type="text" name="name" value="{{ @$editProduct->name }}" class="form-control" id="exampleFormControlInput1" required>
                                  <font style="color: red">{{ ($errors->has('name'))?($errors->first('name')):" " }}</font>
                               </div>
                           </div>
                         </div>
                              <div class="col-2">
                                <div class="mb-3">
                                    <input type="submit" class="btn btn-success" value="{{ (@$editProduct)?'Update':'Send' }}" >
                                 </div>
                            </div>
                        
                        </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
      $.validator.setDefaults({
        submitHandler: function () {
          alert( "Form successful submitted!" );
        }
      });
      $('#FormData').validate({
        rules: {
            name: {
            required: true,
            name: true,
          },
          email: {
            required: true,
            email: true,
          },
          mobile: {
            required: true,
            mobile: true
          },
          address: {
            required: true,
            address: true
          },
          
        },
        messages: {
            name: {
            required: "Please enter a name",
            name: "Please enter a name"
          },
          email: {
            required: "Please enter a email address",
            email: "Please enter a valid email address"
          },
          mobile: {
            required: "Please provide a password",
            mobile: "Please enter a valid email address"
          },
          address: {
            required: "Please provide a address",
            address: "Please enter a valid address"
          },
          
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        }
      });
    });
</script>
@endsection