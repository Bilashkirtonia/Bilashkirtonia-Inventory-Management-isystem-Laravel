
@extends('backend.admin.master')
@section('content')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">View profile</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">View profile</li>
      </ol>
    </div>
  </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4>User profile</div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-10 m-auto">
                    <div class="card">
                      <div class="card-header">
                        <h3>Edit profile <a style="float: right;" href="{{ route('profile.view') }}" class="btn btn-success btn-sm float-end">
                            <i class="fa fa-user"></i> My profile
                        </a></h3>
                    </div>
                    <div class="card-body bordered shadow p-4">
                      <div class="row">
                          <div class="col">
                              <form action="{{ route('profile.update',$user->id) }}" method="post" enctype="multipart/form-data">
                                  @csrf              
                                  <div class="row">
                                    <div class="col-4">
                                       <div class="mb-3">
                                          <label for="exampleFormControlInput1" class="form-label">Gender</label>
                                          <select name="gender" id="exampleFormControlInput1" class="form-control" >
                                              <option value="" disabled selected>Select gender</option>
                                              <option  value="admin" {{ ($user->usertype == "admin")?"selected" : ""}}>Admin</option>
                                              <option value="operator" {{ ($user->usertype == "operator")?"selected" : ""}} >Operator</option>
                                          </select>
                                       </div>
                                      </div>
                                      <div class="col-4">
                                          <div class="mb-3">
                                              <label for="exampleFormControlInput1" class="form-label">Name</label>
                                              <input type="text" value="{{ $user->name }}" name="user_name" class="form-control" id="exampleFormControlInput1">
                                              <font style="color: red">{{ ($errors->has('user_name'))?($errors->first('user_name')):" " }}</font>
                                           </div>
                                      </div>
                                      <div class="col-4">
                                          <div class="mb-3">
                                              <label for="exampleFormControlInput1" class="form-label">Email address</label>
                                              <input type="email" value="{{ $user->email }}" name="email" class="form-control" id="exampleFormControlInput1" required>
                                              <font style="color: red">{{ ($errors->has('email'))?($errors->first('email')):" " }}</font>
                                           </div>
                                      </div>
                                      <div class="col-4">
                                          <div class="mb-3">
                                              <label for="exampleFormControlInput1" class="form-label">Number</label>
                                              <input type="text" value="{{ $user->mobile }}" name="number" class="form-control" id="exampleFormControlInput1">
                                              <font style="color: red">{{ ($errors->has('user_name'))?($errors->first('user_name')):" " }}</font>
                                           </div>
                                      </div>
                                      <div class="col-4">
                                          <div class="mb-3">
                                              <label for="exampleFormControlInput1" class="form-label">Address</label>
                                              <input type="text" value="{{ $user->address }}" name="address" class="form-control" id="exampleFormControlInput1" required>
                                              <font style="color: red">{{ ($errors->has('email'))?($errors->first('email')):" " }}</font>
                                           </div>
                                      </div>

                                      <div class="col-4">
                                          <div class="mb-3">
                                              <label for="exampleFormControlInput1" class="form-label">Image</label>
                                              <input id="image" type="file" value="" name="image" class="form-control" id="exampleFormControlInput1">                                            
                                           </div>
                                      </div>

                                      <div class="col-4">
                                        <label for="exampleFormControlInput1" class="form-label">Old image</label>
                                          <div class="mb-3" style="width: 200px;height:150px;">
                                              <img style="width: 150px;height:150px;" id="showImage" class="profile-user-img img-fluid img-circle"
                                                src="{{(!empty($user->image))?url('upload/user_image/'.$user->image) : url('image/avatar.png')}}"
                                                
                                                alt="User profile picture">
                                              
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

@endsection


















{{-- @extends('admin.admin_layout')
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
                            <h3>Edit profile<a href="{{ route('profile.view') }}" class="btn btn-success btn-sm float-end">
                                <i class="fa fa-user"></i> My profile
                            </a></h3>
                        </div>
                    </div>
                    <div class="card-body bordered shadow p-4">
                        <div class="row">
                            <div class="col">
                                <form action="{{ route('profile.update',$user->id) }}" method="post" enctype="multipart/form-data">
                                    @csrf --}}
                                    
                                    {{-- {{ csrf_field() }} --}}
                                   {{-- <div class="row">
                                      <div class="col-4">
                                         <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">Gender</label>
                                            <select name="gender" id="exampleFormControlInput1" class="form-control" >
                                                <option value="" disabled selected>Select gender</option>
                                                <option  value="male" {{ ($user->gander == "male")?"selected" : ""}}>Male</option>
                                                <option value="female" {{ ($user->gander == "female")?"selected" : ""}} >Female</option>
                                            </select>
                                         </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">Name</label>
                                                <input type="text" value="{{ $user->name }}" name="user_name" class="form-control" id="exampleFormControlInput1">
                                                <font style="color: red">{{ ($errors->has('user_name'))?($errors->first('user_name')):" " }}</font>
                                             </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">Email address</label>
                                                <input type="email" value="{{ $user->email }}" name="email" class="form-control" id="exampleFormControlInput1" required>
                                                <font style="color: red">{{ ($errors->has('email'))?($errors->first('email')):" " }}</font>
                                             </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">Number</label>
                                                <input type="text" value="{{ $user->name }}" name="number" class="form-control" id="exampleFormControlInput1">
                                                <font style="color: red">{{ ($errors->has('user_name'))?($errors->first('user_name')):" " }}</font>
                                             </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">Address</label>
                                                <input type="text" value="{{ $user->email }}" name="address" class="form-control" id="exampleFormControlInput1" required>
                                                <font style="color: red">{{ ($errors->has('email'))?($errors->first('email')):" " }}</font>
                                             </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">Image</label>
                                                <input id="image" type="file" value="" name="image" class="form-control" id="exampleFormControlInput1">
                                                
                                             </div>
                                        </div>

                                        <div class="col-4">
                                        <label for="exampleFormControlInput1" class="form-label">Old image</label>
                                            <div class="mb-3">
                                                <img id="showImage" class="profile-user-img img-fluid img-circle w-50"
                                                  src="{{(!empty($user->image))?url('upload/user_image/'.$user->image) : url('../../upload/empty-profile.png')}}"
                                                  
                                                  alt="User profile picture">
                                                
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
{{-- <script>
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
@endsection --}}