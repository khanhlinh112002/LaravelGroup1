<?php

namespace App\Http\Controllers;
use App\Models\Slide;
use App\Models\Products;
use App\Models\Comment;
use App\Models\ProductType;
use Facade\FlareClient\View;
use Illuminate\Contracts\View\View as ViewView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View as FacadesView;
use App\Http\Requests\AddProduct;


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

}
