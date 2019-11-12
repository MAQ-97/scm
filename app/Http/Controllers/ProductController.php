<?php
namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
//         dd($products);
        return view('products.products', ['products' => $products]);
    }
    public function add()
    {
        $category = Category::all();
        $manufacturer = User::role('manufacturer')->get();
//        dd($manufacturer);
        return view('products.add_product', ['categories' => $category,'manufacturers'=>$manufacturer]);
    }
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'category_id' => 'required|max:255',
            'manufacturer_id' => 'required|max:255',
            'quantity' => 'required|max:255',
            'price' => 'required|max:255',
            'manu_date'=> 'required|max:255',
            'exp_date' => 'required|max:255',
            'batch_no' => 'required|max:1000'
        ]);
        if ($validator->fails()) {
            return redirect()->route('product.add')->withErrors($validator)->withInput();
        }
        $products = new Product();
        $products->name = $request->input('name');
        $products->quantity = $request->input('quantity');
        $products->price = $request->input('price');
        $products->manu_date = $request->input('manu_date');
        $products->exp_date = $request->input('exp_date');
        $products->category_id = $request->input('category_id');
//        $products->image = $filename;
        $products->manufacturer_id = $request->input('manufacturer_id');
        $products->batch_no = $request->input('batch_no');
//        dd($request->input('qty')[0]);

        $products->save();
        return redirect()->route('products.list');

    }
    public function delete($id)
    {
        $product = Product::findorfail($id);
        ProductColors::where('product_id', $product->$id)->delete();
        ProductTypes::where('product_id', $product->$id)->delete();
        ProductCategory::where('product_id', $product->$id)->delete();
        $product->delete();
        return redirect()->route('products.list');
    }
    public function edit($id)
    {
        $product = Product::findorfail($id);
        $product_categories = Product::findorfail($id)->categories;
        $product_type = Product::findorfail($id)->types;
//        dd($product_color);
//        dd($product_color);
        $categories = array();
        $types = array();
        foreach ($product_categories as $key => $category) {
            $categories[$key] = $category->category_id;
        }
        foreach ($product_type as $key => $type) {
            $types[$key] = $type->type_id;
        }
//        dd($colors);
        $product['categories'] = $categories;
        $product['types'] = $types;
        $category = Category::all();
        $sub_category = ItemType::all();
//         dd($product);
        return view('products.edit_product', ['product' => $product, 'categories' => $category, 'sub_categories' => $sub_category]);
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'category_id' => 'required|max:255',
            'type_id' => 'required|max:255',
            'unit' => 'required|max:255',
//            'image' => 'required|max:255',
            'description' => 'required|max:1000'
        ]);
        if ($validator->fails()) {
            return redirect()->route('product.edit', ['id' => $id])->withErrors($validator)->withInput();
        }
        $product = Product::findorfail($id);
//
        $product->name = $request->input('name');
//
        $product->unit = $request->input('unit');
        $product->description = $request->input('description');
//        $product->image = $filename;
        if ($product->save()) {
            ProductCategory::where('product_id', $product->id)->delete();
            $product_id = $product->id;
            $categories = $request->input('category_id');
            foreach ($categories as $cat) {
                $product_categories = new ProductCategory();
                $product_categories->product_id = $product_id;
                $product_categories->category_id = $cat;
                $product_categories->save();
            }
            $types = $request->input('type_id');
            ProductTypes::where('product_id', $product_id)->delete();
            foreach ($types as $type) {
                $product_types = new ProductTypes();
                $product_types->product_id = $product_id;
                $product_types->type_id = $type;
                $product_types->save();
            }
            return redirect()->route('products.list');
        } else {
            $error = [
                'error' => 'An error occurred while saving!',
            ];
            return redirect()->route('product.edit', ['id' => $id])->withErrors($error)->withInput();
        }
    }
}
