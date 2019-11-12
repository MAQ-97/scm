<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
class CategoriesController extends Controller
{
    public function index()
    {
        $categories = DB::table('categories')->get();
        return view('categories.categories', ['all_categories' => $categories]);
    }
    public function add()
    {
        return view('categories.add_category');
    }
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255'
        ]);
        if ($validator->fails()) {
            return redirect('category/add')->withErrors($validator)->withInput();
        }
        $category = new Category();
        $name = $request->input('name');
        $category->name = $name;
        if ($category->save()) {
            return redirect('categories');
        } else {
            $error = [
                'error' => 'An error occurred while saving!',
            ];
            return redirect('category/add')->withErrors($error)->withInput();
        }
    }
    public function delete($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect('categories');
    }
    public function edit($id)
    {
        $category = Category::find($id);
        return view('categories.edit_category', ['category' => $category]);
    }
    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255'
        ]);
        if ($validator->fails()) {
            return redirect()->route('category.edit', [$id])->withErrors($validator)->withInput();
        }
        $category = Category::find($id);
        $category->name = $request->input('name');
        if ($category->save()) {
            return redirect('categories');
        } else {
            $error = [
                'error' => 'An error occurred while saving!',
            ];
            return redirect()->route('category.edit', [$id])->withErrors($error)->withInput();
        }
    }
}
