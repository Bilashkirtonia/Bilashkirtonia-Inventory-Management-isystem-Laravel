@extends('backend.admin.master')
@section('content')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0"> {{ (@$editCategory)?"Edit Category":"Add Category " }}</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active"> {{ (@$editCategory)?"Edit Category":"Add Category " }}</li>
      </ol>
    </div>
  </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4>
                  
                  {{ (@$editCategory)?"Edit Category":"Add Category " }}
                  
                  <a href="{{ route('view_category') }}" style="float: right;"  class="btn btn-primary">
                    <i class="fas fa-list"></i> View
                  </a>
                  
                </h4>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-10 m-auto">
                    <div class="card p-4">
                        <form action="{{ (@$editCategory)?route('update_category',$editCategory->id):route('store_category') }}" method="post" id="FormData">
                            @csrf
                            
                           <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Name</label>
                                        <input type="text" name="name" value="{{ @$editCategory->name }}" class="form-control" id="exampleFormControlInput1">
                                        <font style="color: red">{{ ($errors->has('name'))?($errors->first('name')):" " }}</font>
                                     </div>
                                </div>
                                
                            </div>
                              <div class="col-2">
                                <div class="mb-3">
                                    <input type="submit" class="btn btn-success" value="{{ (@$editCategory)?'Update':'Send' }}" >
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
         
          
        },
        messages: {
            name: {
            required: "Please enter a name",
            name: "Please enter a name"
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