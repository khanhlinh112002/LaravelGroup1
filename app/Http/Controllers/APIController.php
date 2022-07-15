<?php
namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class APIController extends Controller{
    
    public function getProducts(){
        $products = Products::all();
        return response()->json($products);
    }
    public function addProduct(Request $request)
    {
        $product = new Products();
        $product->name = $request->input('name');
        $product->image = $request->input('image');
        $product->description = $request->input('description');
        $product->unit_price = intval($request->input('unit_price'));
        $product->promotion_price = intval($request->input('promotion_price'));
        $product->unit = $request->input('unit');
        $product->new = intval($request->input('new'));
        $product->id_type = intval($request->input('id_type'));
        $product->save();
        return $product;

    }
    public function deleteProduct($id)
    {
        $product = Products::find($id);
        $fileName = 'sources/image/product/' . $product->image;
        if (File::exists($fileName)) {
            File::delete($fileName);
        }
        $product->delete();
        return ['status' => 'ok', 'msg' => 'Delete successed'];
    }
    public function editProduct(Request $request, $id)
    {
    $product = Products::find($id);
 
    $product->name = $request->input('name');
    $product->image = $request->input('image');
    $product->description = $request->input('description');
    $product->unit_price = intval($request->input('unit_price'));
    $product->promotion_price = intval($request->input('promotion_price'));
    $product->unit = $request->input('unit');
    $product->new = intval($request->input('new'));
    $product->id_type = intval($request->input('id_type'));
 
    $product->save();
    return response()->json(['status' => 'ok', 'msg' => 'Edit successed']);
    }
 
    public function uploadImage(Request $request){
        // process image
        if ($request->hasFile('uploadImage')) {
            $file = $request->file('uploadImage');
            $fileName = $file->getClientOriginalName();
 
            $file->move('sources/image/product', $fileName);
 
            return response()->json(["message" => "ok"]);
    }
    else return response()->json(["message" => "false"]);
    }

    public function getProductsByKeyword(Request $request)
    {
        if($request->keyword == null)
        {
            return DB::all();
        }
        $result = DB::table('products')
                ->where('name', 'like', "% $request->keyword %")
                ->get();
        return $result;
    }
    public function getOneProduct($id)
    {
        $product = Products::find($id);
        return response()->json($product);
    }
}