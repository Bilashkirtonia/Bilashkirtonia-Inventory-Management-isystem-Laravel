@extends('backend.admin.master')
@section('content')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0"> {{ (@$editProduct)?"Daily purchase":"Daily purchase " }}</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active"> {{ (@$editProduct)?"Daily purchase":"Daily purchase " }}</li>
      </ol>
    </div>
  </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4>
                  
                  {{ (@$editProduct)?"Daily purchase":"Daily purchase " }}
                  
                  <a href="{{ route('view_invoice') }}" style="float: right;"  class="btn btn-primary">
                    <i class="fas fa-list"></i> View
                  </a>
                  
                </h4>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12 m-auto">
                    <form action="{{ route('daily_purchase_pdf') }}" method="GET" target="_blank" id="myForm">
                        
                        <div class="card p-4">
                            <div class="row">
                              <div class="col-4">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Start Date</label>
                                   <input type="date"  name="s_date" id="invoice_no" class="form-control form-control-sm">
                                    <font style="color: red">{{ ($errors->has('s_date'))?($errors->first('s_date')):" " }}</font>
                                 </div>
                              </div>
      
                              <div class="col-4">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">End Date</label>
                                   <input type="date"  name="e_date" id="invoice_no" class="form-control form-control-sm">
                                    <font style="color: red">{{ ($errors->has('s_date'))?($errors->first('s_date')):" " }}</font>
                                 </div>
                              </div>
                              
                            
                           </div>
                           <div class="col-2">
                            <div class="mb-3">
                              <input type="submit" class="btn btn-success btn-sm" value="{{ (@$editProduct)?'Update':'Search' }}" >
                            </div>
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


<script>
    $(function () {
      $.validator.setDefaults({
        submitHandler: function () {
          alert( "Form successful submitted!" );
        }
      });
      $('#myForm').validate({
        rules: {
            s_date: {
            required: true,
            s_date: true,
          },
          e_date: {
            required: true,
            e_date: true,
          }
          
        },
        messages: {
            s_date: {
            required: "Please enter a s_date",
            s_date: "Please enter a s_date"
          },
          e_date: {
            required: "Please enter a e_date address",
            e_date: "Please enter a valid e_date address"
          }
          
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