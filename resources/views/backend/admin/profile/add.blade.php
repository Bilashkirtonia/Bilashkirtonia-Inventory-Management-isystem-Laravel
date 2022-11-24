@extends('admin.admin_layout')
@section('content')
<main>
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
                            <h3>Add User<a href="{{ route('user.view') }}" class="btn btn-success btn-sm float-end">
                                <i class="fa fa-list"></i> User list 
                            </a></h3>
                        </div>
                    </div>
                    <div class="card-body bordered shadow p-4">
                        <div class="row">
                            <div class="col">
                                <form action="{{ route('user.store') }}" method="post" id="FormData">
                                    @csrf
                                    {{-- {{ csrf_field() }} --}}
                                   <div class="row">
                                      <div class="col-4">
                                         <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">Name</label>
                                            <select name="role" id="exampleFormControlInput1" class="form-control" >
                                                <option value="" disabled selected>Select role</option>
                                                <option value="2">Admin</option>
                                                <option value="1">moderator</option>
                                            </select>
                                         </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">Name</label>
                                                <input type="text" name="user_name" class="form-control" id="exampleFormControlInput1">
                                                <font style="color: red">{{ ($errors->has('user_name'))?($errors->first('user_name')):" " }}</font>
                                             </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">Email address</label>
                                                <input type="email" name="email" class="form-control" id="exampleFormControlInput1" required>
                                                <font style="color: red">{{ ($errors->has('email'))?($errors->first('email')):" " }}</font>
                                             </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-4">
                                           <div class="mb-3">
                                              <label for="exampleFormControlInput1" class="form-label">Password</label>
                                              <input type="password" name="password" id="password" class="form-control" id="exampleFormControlInput1" required>
                                           </div>
                                          </div>
                                          <div class="col-4">
                                              <div class="mb-3">
                                                  <label for="exampleFormControlInput1" class="form-label">Conform password</label>
                                                  <input type="password" name="confrim_password" class="form-control" id="exampleFormControlInput1" required>
                                               </div>
                                          </div>
                                      </div>

                                      <div class="col-2">
                                        <div class="mb-3">
                                            <input type="submit" class="btn btn-success" value="Insert" >
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
</main>
<script>
    $(function () {
      $.validator.setDefaults({
        submitHandler: function () {
          alert( "Form successful submitted!" );
        }
      });
      $('#FormData').validate({
        rules: {
            user_name: {
            required: true,
            user_name: true,
          },
          email: {
            required: true,
            email: true,
          },
          password: {
            required: true,
            minlength: 6
          },
          confrim_password: {
            required: true,
            equalTo: '#password'
          },
          
        },
        messages: {
            user_name: {
            required: "Please enter a name",
            user_name: "Please enter a name"
          },
          email: {
            required: "Please enter a email address",
            email: "Please enter a valid email address"
          },
          password: {
            required: "Please provide a password",
            minlength: "Your password must be at least 6 characters long"
          },
          confrim_password: {
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