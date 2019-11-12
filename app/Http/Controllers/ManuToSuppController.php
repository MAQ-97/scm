<?php
namespace App\Http\Controllers;
use App\Product;
use App\ManuToSuppDetail;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ManuToSupp;
use Illuminate\Support\Facades\Validator;
class ManuToSuppController extends Controller
{
    public function index()
    {
        $supplies = ManuToSupp::all();
        foreach ($supplies as $supply)
        {
            $supplier = User::find($supply->supplier_id);
//            dd($supplier);
            $supply->supplier_name = $supplier->name;
        }
//        dd($supplies);
        return view('purchases.index',['supplies'=>$supplies]);
    }
    public function add()
    {
        $products = Product::all();
        $supplier = User::role('supplier')->get();
        return view('purchases.add', ['products' => $products,'suppliers'=>$supplier]);
    }
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|max:20',
            'quantity' => 'required|max:255'
//            'image' => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:2048'
        ]);
        if($validator->fails()){
            return redirect()->route('supplies.add')->withErrors($validator)->withInput();
        }
        $ManuToSupp = new ManuToSupp();
        $ManuToSupp->supplier_id = $request->supplier_id;
        $ManuToSupp->verified = 0;
        if($ManuToSupp->save()){
            foreach ($request->product_id as $key =>$value){
                $quantity =$request->quantity[$key];
                $ManuToSuppDetails = new ManuToSuppDetail();
                $ManuToSuppDetails->ManuToSupp_id = $ManuToSupp->id;
                $ManuToSuppDetails->product_id = $value;
                $ManuToSuppDetails->quantity = $quantity;
                $ManuToSuppDetails->save();
                $product = Product::find($value);
                $product->quantity = $product->quanity - $ManuToSuppDetails->quantity;
                $product->save();
            }
        }
        return redirect(route('supplies.add'));
    }
    public function view($id){
        $purchase = Purchases::with('ProductColorPurchases')->where('id',$id)->first();
//         dd($purchase);
        foreach ($purchase->ProductColorPurchases as $productColorPurchase) {
            $product_color = ProductColors::find($productColorPurchase->product_color_id);
            $color = Color::find($product_color->color_id);
            $product = Product::find($product_color->product_id);
            $productColorPurchase->color_code = $color->code;
            $productColorPurchase->product_name = $product->name;
        }
        return view('purchases.view',['purchase'=>$purchase]);
    }
    public function delete($id){
        $purchase = Purchases::with('ProductColorPurchases')->where('id',$id)->first();
//         dd($purchase);
        foreach ($purchase->ProductColorPurchases as $productColorPurchase) {
            $product_color = ProductColors::find($productColorPurchase->product_color_id);
            $product_color->quantity_in_hand = $product_color->quantity_in_hand - $productColorPurchase->quantity;
            $product_color->save();
        }
        $purchase->delete();
//
        return redirect(route('supplies.all'));
    }
    public function verify()
    {
        $supplies = ManuToSupp::all();
        foreach ($supplies as $supply)
        {
            $supplier = User::find($supply->supplier_id);
//            dd($supplier);
            $supply->supplier_name = $supplier->name;
        }
        return view('purchases.verify',['supplies'=>$supplies]);
    }


    public function verified($id)
    {
        $supply = ManuToSupp::find(id);
        $supply->verified = 1;
        $supply->save();
        return redirect(route('supplies.verify'));
    }
}
