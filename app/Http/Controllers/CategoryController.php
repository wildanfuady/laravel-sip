<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::all();
        
        $data = [
            'categories' => $category
        ];

        return view('category/index')->with($data);
    }

    public function create()
    {
        return view('category/create');
    }

    public function store(Request $request)
    {
        $val = $request->validate([
            'name' => 'required',
            'status' => 'required',
            
        ]);

        // var_dump($val);

        $category = new Category;
        $category->category_name = $request->name;
        $category->category_status = $request->status;
        $simpan = $category->save();

        if($simpan){
            return redirect(url('categories'))->with('success', 'Category created successfully');
        }
    }

    public function show($category_id)
    {
        $category = Category::find($category_id);

        $data = [
            'category' => $category
        ];


        return view('category/show')->with($data);
    }

    public function edit($category_id)
    {
        $category = Category::find($category_id);

        $data['category'] = $category;

        return view('category/edit')->with($data);
    }

    public function update(Request $request, $category_id)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',
            
        ]);
        
        $category = Category::find($category_id);
        $category->category_name = $request->name;
        $category->category_status = $request->status;
        $ubah = $category->save();

        if($ubah){
            return redirect(url('categories'))->with('info', 'Category updated successfully');
        }

    }

    public function destroy($category_id)
    {
        // SELECT * FROM categories WHERE category_id = $category_id;
        $category = Category::find($category_id);
        // $category = Category::where('category_id', $category_id)->first();
        // Fungsi yang akan menghapus data berdasarkan model dan where
        $hapus = $category->delete();

        if($hapus){
            return redirect(url('categories'))->with('warning', 'Category deleted successfully');
        }
    }

}
