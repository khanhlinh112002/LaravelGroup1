<?php
namespace App\Http\Controllers;

class UserController extends Controller
{
   public function hello(){
       $title = "Bé Khánh Linh nè <3";
       return view('test')->with('title', $title);
    //    echo "WELCOME TO KHÁNH LINH XINH ĐẸP NHỨT THẾ GIAN";
   }
}
//php artisan make:controller UserController