<?php

namespace App\Http\Controllers\Fronted;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Logo;

class FrontedController extends Controller
{
    public function index(){
        $data['logo'] = Logo::first();
        
        return view('fronted.home',$data);
    }
    

}
