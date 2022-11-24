<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unit;

class UnitController extends Controller
{
    public function view(){
        $data['Units'] = Unit::paginate(5);
        return view('backend.admin.unit.view_unit',$data);
    }

    public function add(){
        return view('backend.admin.unit.add_unit');
    }

    public function store(Request $request){
        $request->validate([
            'name'=>'required|unique:units,name',

        ]);
        $data = new Unit();
        $data->name = $request->name;
        $data->save();
        return redirect()->route('view_unit')->with('success','Data insert successfully');

        
    }
    public function edit($id){
        $data['editUnits'] = Unit::find($id);
        return view('backend.admin.unit.add_unit',$data);
    }

    public function update(Request $request,$id){
        $request->validate([
            'name'=>'required',
        ]);
        $data = Unit::find($id);
        $data->name = $request->name;
        $data->save();
        return redirect()->route('view_unit')->with('success','Data insert successfully');

  }

  public function delete($id){
    Unit::find($id)->delete();
    return redirect()->route('view_unit')->with('success','Data insert successfully');

    }

}
