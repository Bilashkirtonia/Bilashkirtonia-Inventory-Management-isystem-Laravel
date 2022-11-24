<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
class ProfileController extends Controller
{
    public function index(){
        $id = Auth::User()->id;
        $user = User::find($id);
        return view('backend.admin.profile.index',compact('user'));
    }

    public function edit(){
        $id = Auth::User()->id;
        $user = User::find($id);

        return view('backend.admin.profile.edit',compact('user')); 
    }

    public function update(Request $request){
        $this->validate($request,[
            'user_name'=>"required",
            'email'=>"required",
            'gender'=>"required",
            'number'=>"required",
            'address'=>"required",
         ]);

        $id = Auth::User()->id;
        $data = User::find($id);
        $data->name = $request->user_name;
        $data->gender = $request->gender;
        $data->email = $request->email;
        $data->mobile = $request->number;
        $data->address = $request->address;
        if($request->file('image')){
            $file = $request->file('image');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            @unlink(public_path('upload/user_image/').$data->image);
            $file->move(public_path('upload/user_image'), $fileName);
            $data->image = $fileName;
        }
        $data->save();
        return redirect()->route('profile.view')->with('success',"Data update successfully!");
        
    }
    public function password_view(){
        return view("backend.admin.profile.password");
    }

    public function password_update(Request $request){
        if(Auth::attempt(['id'=>Auth::User()->id ,'password'=>$request->old_password])){
            $id = Auth::User()->id;
            $data = User::find($id);
            $data->password = bcrypt($request->new_password);
            $data->save();
            return redirect()->route('profile.password_view')->with('success','Password set successfully!');
        }else{
            return redirect()->back()->with("errors","Try one more time!");
        }
    }

    
}
