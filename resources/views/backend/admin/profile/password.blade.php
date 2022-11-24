@extends('backend.admin.master')
@section('content')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">Change password</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Change password</li>
      </ol>
    </div>
  </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4>Change password</div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-10 m-auto">
                        <div class="card">
                          <div class="card-header">
                            <h3>Reset password <a style="float: right" href="{{ route('profile.view') }}" class="btn btn-success btn-sm float-end">
                                <i class="fa fa-user"></i> My profile 
                            </a></h3>
                          </div>

                          <div class="card-body bordered shadow p-4">
                            <div class="row">
                                <div class="col">
                                    <form action="{{ route('profile.password_update') }}" method="post" id="FormData">
                                        @csrf
                                        
                                        <div class="row">
                                            <div class="col-4">
                                              <div class="mb-3">
                                                  <label for="exampleFormControlInput1" class="form-label">Old assword</label>
                                                  <input type="password" name="old_password" id="old_password" class="form-control" id="exampleFormControlInput1" required>
                                              </div>
                                              </div>
                                              <div class="col-4">
                                                <div class="mb-3">
                                                  <label for="exampleFormControlInput1" class="form-label">New password</label>
                                                  <input type="password" name="new_password" id="new_password" class="form-control" id="exampleFormControlInput1" required>
                                                </div>
                                              </div>

                                              <div class="col-4">
                                                  <div class="mb-3">
                                                      <label for="exampleFormControlInput1" class="form-label">Again new password</label>
                                                      <input type="password" name="again_new_password" class="form-control" id="exampleFormControlInput1" required>
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
            
        </div>
    </div>



</div>





{{-- @extends('admin.admin_layout')
@section('content') --}}
{{-- <main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Static Navigation</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        </ol> 
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>Reset password<a href="{{ route('profile.view') }}" class="btn btn-success btn-sm float-end">
                                <i class="fa fa-user"></i> My profile 
                            </a></h3>
                        </div>
                    </div>
                    <div class="card-body bordered shadow p-4">
                        <div class="row">
                            <div class="col">
                                <form action="{{ route('profile.password_update') }}" method="post" id="FormData">
                                    @csrf
                                    
                                    <div class="row">
                                        <div class="col-4">
                                           <div class="mb-3">
                                              <label for="exampleFormControlInput1" class="form-label">Old assword</label>
                                              <input type="password" name="old_password" id="old_password" class="form-control" id="exampleFormControlInput1" required>
                                           </div>
                                          </div>
                                          <div class="col-4">
                                            <div class="mb-3">
                                               <label for="exampleFormControlInput1" class="form-label">New password</label>
                                               <input type="password" name="new_password" id="new_password" class="form-control" id="exampleFormControlInput1" required>
                                            </div>
                                           </div>

                                          <div class="col-4">
                                              <div class="mb-3">
                                                  <label for="exampleFormControlInput1" class="form-label">Again new password</label>
                                                  <input type="password" name="again_new_password" class="form-control" id="exampleFormControlInput1" required>
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
</main> --}}
<script>
    $(function () {
    //   $.validator.setDefaults({
    //     submitHandler: function () {
    //       alert( "Form successful submitted!" );
    //     }
    //   });
      $('#FormData').validate({
        rules: {
            old_password: {
            required: true,
            
          },
          new_password: {
            required: true,
            minlength: 6
          },
          again_new_password: {
            required: true,
            equalTo: '#new_password'
          },
          
        },
        messages: {
            old_password: {
            required: "Please provide a password",
            
          },
          new_password: {
            required: "Please provide a password",
            minlength: "Your password must be at least 6 characters long"
          },
          again_new_password: {
            required: "Please enter a comfirm password",
            equalTo: "Confirm password dose't match"
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