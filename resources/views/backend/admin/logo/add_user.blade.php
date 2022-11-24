@extends('backend.admin.master')
@section('content')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">Add user</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Add logo</li>
      </ol>
    </div>
  </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4>Add logo 
                  
                  <a href="{{ route('view_logo') }}" style="float: right;"  class="btn btn-primary">
                    <i class="fas fa-list"></i> View
                  </a>
                  
                </h4>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-10 m-auto">
                    <div class="card p-4">
                      <form action="{{ (@$editLogo)?route('update_logo',$editLogo->id):route('store_logo') }}" method="post" enctype="multipart/form-data" id="quickForm">
                        @csrf              
                        <div class="row">                                                 
                           <div class="col">
                            <div class="row">
                              <div class="col-4">
                                <label for="exampleFormControlInput1" class="form-label">Old image</label>
                                  <div class="mb-3" style="width: 200px;height:150px;">
                                      <img style="width: 150px;height:150px;" id="showImage" class="profile-user-img img-fluid img-circle"
                                        src="{{(@$editLogo)?url('upload/logo/'.$editLogo->image) : url('image/avatar.png')}}"
                                        
                                        alt="User profile picture">
                                      
                                   </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-4">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Image</label>
                                    <input id="image" type="file" value="" name="image" class="form-control" id="exampleFormControlInput1">                                            
                                 </div>
                              </div>
                            </div>
                           </div>
                        </div>
                          <div class="col-2">
                            <div class="mb-3">
                                <input type="submit" class="btn btn-success" value="Update" >
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


{{-- <script>
  $(function () {
    $.validator.setDefaults({
      submitHandler: function () {
        alert( "Form successful submitted!" );
      }
    });
    $('#quickForm').validate({
      rules: {
        email: {
          required: true,
          email: true,
        },
        name: {
          required: true,
          name: true,
        },
        usertype: {
          required: true,
          usertype: true,
        },
        password: {
          required: true,
          minlength: 6
        },
        password2: {
          required: true,
          equalTo: "#password",
        },
        terms: {
          required: true
        },
      },
      messages: {
        email: {
          required: "Please enter a email address",
          email: "Please enter a valid email address"
        },
        password: {
          required: "Please provide a password",
          minlength: "Your password must be at least 5 characters long"
        },
        password2: {
          required: "Please provide a password",
          equalTo: "Your password must be at least 5 characters long"
        },
        terms: "Please accept our terms"
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
</script> --}}
@endsection