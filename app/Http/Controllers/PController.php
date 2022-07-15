<?php

namespace App\Http\Controllers;
use App\Models\Slide;
use App\Models\Products;
use App\Models\Comment;
use App\Models\ProductType;
use App\Models\Wishlist;

use Facade\FlareClient\View;
use Illuminate\Contracts\View\View as ViewView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View as FacadesView;
use App\Http\Requests\AddProduct;
use App\Http\Requests;
use App\Models\Cart;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\Customer;



class PController extends Controller
{
    //
    

    public function getIndex(){
        $slide = Slide::all();
        $new_product = Products::where('new',1)->paginate(4);
        $promotion_product = Products::where('promotion_price','<>',0)->paginate(8);
        $count1 = Products::where('new',1)->count();
        $count2 = Products::where('promotion_price','<>',0)->count();


        return view('homepage',compact('slide','new_product','promotion_product','count1','count2'));
    }
    public function getLoaiSp($type){
        $type_product = ProductType::all();
        $sp_theoloai = Products::where('id_type',$type)->get();
        $sp_khac = Products::where('id_type','<>',$type)->paginate(3);
        return view('loai_sanpham',compact('sp_theoloai','type_product','sp_khac'));
    }
    public function getLoaiSanpham(){
        return view('loai_sanpham');
    }
    public function getAdmin(){
        $products = Products ::all();
        return view('admin', compact('products')); 
        
    }
    public function getAdminAdd(){
        
        return view('formAdd');
    }
    public function postAdminAdd(Request $request){
        $product= new Products();
        if ($request->hasFile('inputImage')){
            $file = $request -> file ('inputImage');
            $fileName=$file->getClientOriginalName('inputImage');
            $file->move('source/image/product',$fileName);
        }
        $fileName=null;
        if ($request->file('inputImage')!=null){
            $file_name=$request->file('inputImage')->getClientOriginalName();

        }
        $product->name=$request->inputName;
        $product->image=$file_name;
        $product->description=$request->inputDescription;
        $product->unit_price=$request->inputPrice;
        $product->promotion_price=$request->inputPromotionPrice;
        $product->unit=$request->inputUnit;
        $product->new=$request->inputNew;
        $product->id_type=$request->inputType;
        $product->save();
        return redirect('/admin')->with('success', 'Đăng ký thành công');
    }
    public function Editform(){
        return view ('formEdit');
    }
    
    public function getAdminEdit($id){
        $product = Products::find($id);
        return view('formEdit')->with('product',$product);
    }
    
    public function postAdminEdit(Request $request){
        $id = $request->editId;

        $product = Products::find($id);
        if($request->hasFile('editImage')){
            $file = $request -> file ('editImage');
            $fileName=$file->getClientOriginalName('editImage');
            $file->move('source/image/product',$fileName);
        }
        if ($request->file('editImage')!=null){
            $product ->image=$fileName;
        }
        $product->name=$request->editName;
        // $product->image=$file_name;
        $product->description=$request->editDescription;
        $product->unit_price=$request->editPrice;
        $product->promotion_price=$request->editPromotionPrice;
        $product->unit=$request->editUnit;
        $product->new=$request->editNew;
        $product->id_type=$request->editType;
        $product->save();
        return redirect('/admin');
    }
    public function postAdminDelete($id){
        $product =Products::find($id);
        $product->delete();
        return redirect('/admin');
}
    public function getDetail(Request $request){
        $sanpham = Products::where('id',$request->id)->first();
        $splienquan = Products::where('id','<>',$sanpham->id,'and','id_type','=',$sanpham->id_type)->paginate(3);
        $comments = Comment::where('id_product',$request->id)->get();
        return view('Detail',compact('sanpham','splienquan','comments'));
    }
    						
	public function getAddToCart(Request $req, $id){	
        $product = Products::find($id);					
        $oldCart = Session('cart')?Session::get('cart'):null;					
        $cart = new Cart($oldCart);					
        $cart->add($product,$id);					
        $req->session()->put('cart', $cart);	
  
        return redirect()->back();					
    }					
                    
    public function getDelItemCart($id)
    {
    $oldCart = Session::has('cart')?Session :: get('cart'):null;
    $cart = new Cart($oldCart);
    $cart->removeItem($id);
   
    if(count($cart->items) > 0 && Session::has('cart')){
        Session :: put('cart',$cart);
    }else{             
        Session :: forget('cart');
    return redirect()->back();

    }   
    }
       //--------------- CHECKOUT --------------//
       public function getCheckout()
       {
           if (Session::has('cart')) {
               $oldCart = Session::get('cart');
               $cart = new Cart($oldCart);
               return view('checkout')->with(['cart' => Session::get('cart'), 'product_cart' => $cart->items, 'totalPrice' => $cart->totalPrice, 'totalQty' => $cart->totalQty]);;
           } else {
               return redirect('homepage');
           }
       }
   
       public function postCheckout(Request $req)
       {
           $cart = Session::get('cart');
           $customer = new Customer;
           $customer->name = $req->full_name;
           $customer->gender = $req->gender;
           $customer->email = $req->email;
           $customer->address = $req->address;
           $customer->phone_number = $req->phone;
   
           if (isset($req->notes)) {
               $customer->note = $req->notes;
           } else {
               $customer->note = "Không có ghi chú gì";
           }
   
           $customer->save();
   
           $bill = new Bill;
           $bill->id_customer = $customer->id;
           $bill->date_order = date('Y-m-d');
           $bill->total = $cart->totalPrice;
           $bill->payment = $req->payment_method;
           if (isset($req->notes)) {
               $bill->note = $req->notes;
           } else {
               $bill->note = "Không có ghi chú gì";
           }
           $bill->save();
   
           foreach ($cart->items as $key => $value) {
               $bill_detail = new BillDetail;
               $bill_detail->id_bill = $bill->id;
               $bill_detail->id_product = $key; //$value['item']['id'];
               $bill_detail->quantity = $value['qty'];
               $bill_detail->unit_price = $value['price'] / $value['qty'];
               $bill_detail->save();
           }
   
           Session::forget('cart');
           $wishlists = Wishlist::where('id_user', Session::get('user')->id)->get();
           if (isset($wishlists)) {
               foreach ($wishlists as $element) {
                   $element->delete();
               }
           }
           echo '<script>alert("Đặt hàng thành công");window.location.assign("homepage");</script>';

       }
}

