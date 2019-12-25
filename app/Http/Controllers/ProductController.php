<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Category;
use App\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Category
        $data['category'] = $request->query('category');
        $category = $data['category'];
        // Keyword
        $data['keyword'] = $request->query('keyword');
        // Categories
        $keyword = $data['keyword'];
        $data['categories'] = Category::pluck('category_name', 'category_id');
        // Batas Paginate
        $paginate = 1;
        // Array Where Conditional
        $where = [];
        $or_where1 = [];
        $or_where2 = [];
        // Kondisi jika category terpilih
        if(!empty($category)){
            $where[] = ['category_id', '=', $category];
        }
        // Kondisi jika keyword terinput
        if(!empty($data['keyword'])){
            $where[] = ['product_name', 'LIKE', "%{$keyword}%"];
            $or_where1[] = ['product_sku', 'LIKE', "%{$keyword}%"];
            $or_where2[] = ['product_description', 'LIKE', "%{$keyword}%"];
        }
        // Query berdasarkan pencarian
        if(empty($data['category']) && empty($data['keyword'])){
            $data['products'] = Product::with(['category'])->paginate($paginate);

        } else {
            
            $data['products'] = Product::with(['category'])->where($where)->orWhere($or_where1)->orWhere($or_where2)->paginate($paginate);
        }

        // View
        return view('product.index', $data)->with('i', ($request->input('page', 1) - 1) * $paginate); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['categories'] = Category::where('category_status', 'Active')->pluck('category_name', 'category_id');
        // dd($categories);
        return view('product.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductRequest $request)
    {
        $product = new Product;
        $product->category_id = $request->category_id;
        $product->product_name = $request->product_name;
        $product->product_price = $request->price;
        $product->product_sku = $request->sku;
        $product->product_status = $request->status;
        $product->product_description = $request->description;

        if(!empty($request->file('image'))){
            // Request dari form
            $image = $request->file('image');
            // Dapatkan nama asli file image
            $filename = $image->getClientOriginalName();
            // Ubah spasi menjadi - di dalam file name image
            $charFileName = str_replace(" ", "-", $filename);
            //Simpan gambar ke storage
            $image->storeAs('products', $charFileName, 'public');

        } else {

            $charFileName = "no-image.png";

        }

        $product->product_image = "products/".$charFileName;

        $simpan = $product->save();

        if($simpan){
            return redirect()->route('product.index')->with('success', 'Product created successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['categories'] = Category::pluck('category_name', 'category_id');
        
        $data['product'] = Product::find($id);
        return view('product.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['categories'] = Category::pluck('category_name', 'category_id');
        
        $data['product'] = Product::find($id);
        return view('product.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::find($id);
        $product->category_id = $request->category_id;
        $product->product_name = $request->product_name;
        $product->product_price = $request->price;
        $product->product_sku = $request->sku;
        $product->product_status = $request->status;
        $product->product_description = $request->description;

        if(!empty($request->file('image'))){
            // Request dari form
            $image = $request->file('image');
            // Dapatkan nama asli file image
            $filename = $image->getClientOriginalName();
            // Ubah spasi menjadi - di dalam file name image
            $charFileName = str_replace(" ", "-", $filename);
            //Simpan gambar ke storage
            $image->storeAs('products', $charFileName, 'public');

            $product->product_image = "products/".$charFileName;

        } 


        $ubah = $product->save();

        if($ubah){
            return redirect()->route('product.index')->with('info', 'Product updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $hapus = $product->delete();

        if($hapus){
            return redirect()->route('product.index')->with('warning', 'Product deleted successfully');
        }
    }
}
