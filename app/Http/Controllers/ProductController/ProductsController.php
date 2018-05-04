<?php

namespace App\Http\Controllers\ProductController;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Product;
use App\Category;
use Illuminate\Http\Request;

use DB;
use config;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $products = Product::where('product_name', 'LIKE', "%$keyword%")
				->orWhere('product_description', 'LIKE', "%$keyword%")
				->orWhere('product_price', 'LIKE', "%$keyword%")
				->orWhere('product_pic_1', 'LIKE', "%$keyword%")
				->orWhere('product_pic_2', 'LIKE', "%$keyword%")
				->orWhere('product_pic_3', 'LIKE', "%$keyword%")
				->orWhere('product_pic_4', 'LIKE', "%$keyword%")
				->orWhere('product_pic_5', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            // $products = Product::paginate($perPage);

            $products = DB::table('products as p')
                        ->leftJoin('category as c','c.id','p.category_id')
                        ->where('p.deleted_at',null)
                        ->select('p.*','c.category_name')
                        ->orderBy('p.created_at','desc')
                        ->paginate($perPage);
        }

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {   
        $categories = Category::pluck('category_name','id');
        // dd($categories);
        return view('products.create')->with('categories',$categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {   
        $this->validate($request, [
			'product_name' => 'required',
			'product_description' => 'required',
			'product_price' => 'required',
			'product_pic_1' => 'required'
		]);
        $requestData = $request->all();

        // Product::create($requestData);
        
        $p = new Product();

        $p->vendor_id       = '1';
        $p->category_id     = $request->category;
        $p->product_name    = $request->product_name;
        $p->product_description = $request->product_description;
        $p->product_price   = $request->product_price;
        $p->product_pic_1   = $request->product_pic_1;
        $p->product_pic_2   = $request->product_pic_2;
        $p->product_pic_3   = $request->product_pic_3;
        $p->product_pic_4   = $request->product_pic_4;
        $p->product_pic_5   = $request->product_pic_5;
        $p->save();

        return redirect('admin/products')->with('flash_message', 'Product added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $product = DB::table('products as p')
                        ->leftJoin('category as c','c.id','p.category_id')
                        ->where('p.id',$id)
                        ->where('p.deleted_at',null)
                        ->select('p.*','c.category_name')
                        ->get();
        dd($product);

        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // $product = Product::findOrFail($id);
        $product = DB::table('products as p')
                        ->leftJoin('category as c','c.id','p.category_id')
                        ->where('p.id',$id)
                        ->where('p.deleted_at',null)
                        ->select('p.*','c.category_name')
                        ->get();

        $categories = Category::pluck('category_name','id');

        // dd($categories);
        return view('products.edit', compact('product','categories'));

        // return view('products.edit')->with('product');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
			'product_name' => 'required',
			'product_description' => 'required',
			'product_price' => 'required',
			'product_pic_1' => 'required'
		]);
        $requestData = $request->all();
        
        $product = Product::findOrFail($id);
        $product->update($requestData);

        return redirect('admin/products')->with('flash_message', 'Product updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Product::destroy($id);

        return redirect('admin/products')->with('flash_message', 'Product deleted!');
    }
}
