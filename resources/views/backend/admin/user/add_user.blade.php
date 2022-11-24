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
        <li class="breadcrumb-item active">add user</li>
      </ol>
    </div>
  </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4>User info <a href="{{ route('view_user') }}" style="float: right;"  class="btn btn-primary">
                  <i class="fas fa-list"></i> View
                </a>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-10 m-auto">
                    <div class="card p-4">
                        <form action="{{ (@$editUser)?route('update_user',$editUser->id):route('store_user') }}" method="post" enctype="multipart/form-data" id="quickForm">
                            @csrf
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <select name="usertype" id="usertype" class="form-control">
                                            <option disabled selected value="">Select status</option>
                                            <option value="admin"{{ (@$editUser->usertype == 'admin')?"selected":'' }}>Admin</option>
                                            <option value="operator" {{ (@$editUser->usertype == 'operator')?"selected":'' }} >operator</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">name</label>
                                        <input type="text" name="name" value="{{ (@$editUser->name) }}" class="form-control" id="exampleFormControlInput1" placeholder="Enter your name...">
                                        <span class="text-danger">{{ ($errors->has('name'))?($errors->first('name')):'' }}</span>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" name="email" value="{{ (@$editUser->email) }}"  class="form-control" id="email" placeholder="Enter your email...">
                                        <span class="text-danger">{{ ($errors->has('email'))?($errors->first('email')):'' }}</span>
                                    </div>
                                </div>

                                
                            </div>
                            @if (isset($editUser))
                              
                            @else
                            <div class="row">
                              <div class="col-md-4">
                                <div class="mb-3">
                                  <label for="password">Password</label>
                                    <input type="password" name="password" id="password" class="form-control">
                                    <span class="text-danger">{{ ($errors->has('password'))?($errors->first('password')):'' }}</span>
                                  </label>
                                </div>
                               </div>
                                <div class="col-md-4">
                                  <div class="mb-3">
                                     <label for="password">Confirm Password</label>
                                      <input type="password" name="password2" class="form-control">
                                      <span class="text-danger">{{ ($errors->has('password2'))?($errors->first('password2')):'' }}</span>
                                    </label>
                                  </div>
                                </div>                          
                            </div> 
                            @endif
                            
                           
                                                       
                            <div class="col-md-4">
                                <input type="submit" name="submit" value="Send" class="btn btn-success" >
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
  </script>
@endsection