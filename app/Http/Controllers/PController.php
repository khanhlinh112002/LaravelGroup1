<?php

namespace App\Http\Controllers;
use App\Models\Slide;
use App\Models\Products;

use Illuminate\Http\Request;

class PController extends Controller
{
    //
    

    public function getIndex(){
        $slide = Slide::all();
        $new_product = Products::where('new',1)->paginate(4);
        $promotion_product = Products::where('promotion_price','<>',0)->paginate(8);
        $count1 = Products::where('new',1)->count();
        return view('homepage',compact('slide','new_product','promotion_product','count1'));
    }
}
