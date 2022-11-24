
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
                      

                      <div class="row">
                        <div class="col-md-4 mt-5 shadow offset-md-4"  >
                            <div class="card card-primary card-outline">
                              <div class="card-body box-profile">
                                <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" style="width: 150px;height:150px;"
                                    src="{{(!empty($user->image))?url('upload/user_image',$user->image) : url('image/1.jfif')}}"
                                    
                                    alt="User profile picture">
                                </div>

                                <h3 class="profile-username text-center mt-3">{{ $user->name}}</h3>

                                <p class="text-muted text-center">{{ $user->address}}</p>

                                <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Email :- </b> <span class="float-right">{{ $user->email}}</span>
                                </li>
                                <li class="list-group-item">
                                    <b>Numper :- </b> <span class="float-right">{{{ $user->mobile}}}</span>
                                </li>
                                <li class="list-group-item">
                                    <b>Role :- </b> <span class="float-right">{{ $user->usertype}}</span>
                                </li>
                                </ul>

                                <a href="{{ route('profile.edit')}}" class="btn btn-primary btn-block"><b>Edit profile</b></a>
                            </div>
                            <!-- /.card-body -->
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
                            <h3>My Profile <a href="{{ route('user.add') }}">
                                    
                            </a></h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mt-5 shadow offset-md-4"  >
                            <div class="card card-primary card-outline">
                              <div class="card-body box-profile">
                                <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle w-50"
                                    src="{{(!empty($user->image))?url('upload/user_image',$user->image) : url('../../upload/empty-profile.png')}}"
                                    
                                    alt="User profile picture">
                                </div>

                                <h3 class="profile-username text-center mt-3">{{ $user->name}}</h3>

                                <p class="text-muted text-center">{{ $user->name}}</p>

                                <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Email</b> <span class="float-right">:- {{ $user->email}}</span>
                                </li>
                                <li class="list-group-item">
                                    <b>Numper</b> <span class="float-right">:- {{{ $user->email}}}</span>
                                </li>
                                <li class="list-group-item">
                                    <b>Role</b> <span class="float-right">;- {{ $user->role}}</span>
                                </li>
                                </ul>

                                <a href="{{ route('profile.edit')}}" class="btn btn-primary btn-block"><b>Edit profile</b></a>
                            </div>
                            <!-- /.card-body -->
                            </div>
                         </div>
                    </div>
                    
                </div>
            </div>
                
                
        </div>
    </div>
</main>
@endsection --}}