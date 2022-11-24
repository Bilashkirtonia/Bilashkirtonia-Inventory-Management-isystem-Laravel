@extends('backend.admin.master')
@section('content')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0"> {{ (@$editUnits)?"Edit Units":"Add Units " }}</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active"> {{ (@$editUnits)?"Edit Units":"Add Units " }}</li>
      </ol>
    </div>
  </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4>
                  
                  {{ (@$editUnits)?"Edit Units":"Add Units " }}
                  
                  <a href="{{ route('view_unit') }}" style="float: right;"  class="btn btn-primary">
                    <i class="fas fa-list"></i> View
                  </a>
                  
                </h4>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-10 m-auto">
                    <div class="card p-4">
                        <form action="{{ (@$editUnits)?route('update_unit',$editUnits->id):route('store_unit') }}" method="post" id="FormData">
                            @csrf
                            
                           <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Name</label>
                                        <input type="text" name="name" value="{{ @$editUnits->name }}" class="form-control" id="exampleFormControlInput1">
                                        <font style="color: red">{{ ($errors->has('name'))?($errors->first('name')):" " }}</font>
                                     </div>
                                </div>
                                
                            </div>
                              <div class="col-2">
                                <div class="mb-3">
                                    <input type="submit" class="btn btn-success" value="{{ (@$editUnits)?'Update':'Send' }}" >
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