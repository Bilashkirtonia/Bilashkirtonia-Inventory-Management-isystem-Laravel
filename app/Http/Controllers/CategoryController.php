<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Auth;

class CategoryController extends Controller
{
    public function view(){
        $data['Categorys'] = Category::paginate(5);
        return view('backend.admin.category.view_category',$data);
    }

    public function add(){
        return view('backend.admin.category.add_category');
    }

    public function store(Request $request){
        $request->validate([
            'name'=>'required|unique:categories,name',

        ]);
        $data = new Category();
        $data->name = $request->name;
        $data->created_by = Auth::User()->id;
        $data->save();
        return redirect()->route('view_category')->with('success','Data insert successfully');

        
    }
    public function edit($id){
        $data['editCategory'] = Category::find($id);
        return view('backend.admin.Category.add_Category',$data);
    }

    public function update(Request $request,$id){
        $request->validate([
            'name'=>'required',
        ]);
        $data = Category::find($id);
        $data->name = $request->name;
        $data->updated_by = Auth::User()->id;
        $data->save();
        return redirect()->route('view_category')->with('success','Data insert successfully');

  }

  public function delete($id){
    Category::find($id)->delete();
    return redirect()->route('view_category')->with('success','Data insert successfully');

    }

}
