<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use Input, File;
use App\Http\Requests\signupRequest;

class FormValidationController  extends Controller{
    public function index(){
        return view ('formValidation');
    }
    public function displayInfor (signupRequest $Request){
        $user = [
            'name' => $name = $Request->Input("name"),
            'age' => $age = $Request->Input("age"),
            'date' => $date = $Request->Input("date"),
            'phone' => $phone = $Request->Input("phone"),
            'web' => $web = $Request->Input("web"),
            'address' => $address = $Request->Input("address")
        ];
        return view('formValidation') ->with ('user',$user);
    }
}
