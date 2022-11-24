<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Logo;
use Auth;

class LogoController extends Controller
{
    public function view_logo(){
        $data['users'] = Logo::all();
        $logo = count(Logo::all());
        return view('backend.admin.logo.user_view',compact('logo'),$data);
    }
    
    public function add_logo(){
        $logo = count(Logo::all());
        
        return view('backend.admin.logo.add_user');
    }

    public function store_logo(Request $request){
        

        $data = new Logo();
        $data->created_by = Auth::User()->id;
        if($request->file('image')){
            $file = $request->file('image');
            @unlink(public_path('upload/logo/').$data->image);
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload/logo'), $fileName);
            $data->image = $fileName;
        }
        $data->save();
        return redirect()->route('view_logo')->with('success',"Logo update successfully!");
        

       
        
    }

    public function edit_logo($id){
        $data['editLogo'] = Logo::find($id);
        return view('backend.admin.logo.add_user',$data);
    }

    public function update_logo(Request $request,$id){

        $data = Logo::find($id);
        $data->upload_by = Auth::User()->id;
        if($request->file('image')){
            $file = $request->file('image');
            @unlink(public_path('upload/logo/').$data->image);
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload/logo'), $fileName);
            $data->image = $fileName;
        }
        $data->save();
        return redirect()->route('view_logo')->with('success',"Logo update successfully!");
        
    }

    public function delete_logo($id){

        $logo = Logo::find($id);
        if(file_exists('public/upload/logo/'. $logo->image) && !empty($logo->image)){
            unlink('public/upload/logo/' . $logo->image); 
        }
        $logo->delete();
        return redirect()->route('view_logo')->with('success','Delete successfully!');

    }


    
}
