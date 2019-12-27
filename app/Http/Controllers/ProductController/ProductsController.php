<?php

namespace App\Http\Controllers\ProductController;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Vendor;
use App\Product;
use App\Category;
use Illuminate\Http\Request;

use DB;
use config;
use Input;
use Auth;

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
        $vendor_id = Auth::user()->vendor_id;

        if (!empty($keyword)) {
            $products = Product::leftJoin('category as c','c.id','products.category_id')
                        // ->leftJoin('vendor as v','v.id','products.vendor_id')
                        ->where(function($q) use ($keyword){
                            $q->orwhere('products.product_name', 'LIKE', "%$keyword%")
                                ->orWhere('products.product_description', 'LIKE', "%$keyword%")
                                ->orWhere('products.product_price', 'LIKE', "%$keyword%")
                                ->orWhere('c.category_name', 'LIKE', "%$keyword%");
                        })
                        ->orderBy('products.created_at','desc')
                ->paginate($perPage);

        } else {

            $products = Product::leftJoin('category as c','c.id','products.category_id')
                        // ->leftJoin('vendor as v','v.id','products.vendor_id')
                        ->whereNull('products.deleted_at')
                        ->where('products.vendor_id',$vendor_id)
                        ->select('products.*','c.category_name','c.category_name')
                        ->orderBy('products.created_at','desc')
                        ->paginate($perPage);
        }

        return view('products.index', compact('products'));
    }

    public function inStock(Request $request){
        $id =$request->id;
        
        $product = Product::find($id);
        $product->stock = "1";
        $product->save();

        return redirect('vendor/products');
    }

    public function outStock(Request $request){
       
        $id =$request->id;
        
        $product = Product::find($id);
        $product->stock = "0";
        $product->save();

        return redirect('vendor/products');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {   
        $vendor_id = Auth::user()->vendor_id;
        $categories = Category::where('vendor_id',$vendor_id)->pluck('category_name','id');

        if(Auth::user()->role_id == 1){
            $vendors = Vendor::pluck('name','id');
            $categories = Category::pluck('category_name','id');
        }
        else if(Auth::user()->role_id == 2){
            $categories = Category::where('vendor_id',$vendor_id)->pluck('category_name','id');
        }

        return view('products.create', compact('categories'));
        // return view('products.create')->with('categories',$categories);
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

        if(Input::file('product_pic_1')){
            $avatarDocument = Input::file('product_pic_1');
            $avatarfile = time() ."." . $avatarDocument->getClientOriginalExtension();
            $nameAvatar = url('images/products').'/1'.$avatarfile;
            $pathAvatar = $nameAvatar;
            
            if(Input::file('product_pic_1')->move('images/products/', $pathAvatar)) {

                $product_pic_1 = $nameAvatar;
            }

        }else{
            $product_pic_1=null;
        }

        if(Input::file('product_pic_2')){
            $avatarDocument = Input::file('product_pic_2');
            $avatarfile = time() ."." . $avatarDocument->getClientOriginalExtension();
            $nameAvatar = url('images/products').'/2'.$avatarfile;
            $pathAvatar = $nameAvatar;
            
            if(Input::file('product_pic_2')->move('images/products/', $pathAvatar)) {

                $product_pic_2 = $nameAvatar;
            }

        }else{
            $product_pic_2=null;
        }

        if(Input::file('product_pic_3')){
            $avatarDocument = Input::file('product_pic_3');
            $avatarfile = time() ."." . $avatarDocument->getClientOriginalExtension();
            $nameAvatar = url('images/products').'/3'.$avatarfile;
            $pathAvatar = $nameAvatar;
            
            if(Input::file('product_pic_3')->move('images/products/', $pathAvatar)) {

                $product_pic_3 = $nameAvatar;
            }

        }else{
            $product_pic_3=null;
        }

        if(Input::file('product_pic_4')){
            $avatarDocument = Input::file('product_pic_4');
            $avatarfile = time() ."." . $avatarDocument->getClientOriginalExtension();
            $nameAvatar = url('images/products').'/4'.$avatarfile;
            $pathAvatar = $nameAvatar;
            
            if(Input::file('product_pic_4')->move('images/products/', $pathAvatar)) {

                $product_pic_4 = $nameAvatar;
            }

        }else{
            $product_pic_4=null;
        }

        if(Input::file('product_pic_5')){
            $avatarDocument = Input::file('product_pic_5');
            $avatarfile = time() ."." . $avatarDocument->getClientOriginalExtension();
            $nameAvatar = url('images/products').'/5'.$avatarfile;
            $pathAvatar = $nameAvatar;
            
            if(Input::file('product_pic_5')->move('images/products/', $pathAvatar)) {

                $product_pic_5 = $nameAvatar;
            }

        }else{
            $product_pic_5=null;
        }

        // Product::create($requestData);
        // dd( $product_pic_1, $product_pic_2, $product_pic_3, $product_pic_4, $product_pic_5);

        $vendor_id = Auth::user()->vendor_id;
        
        $p = new Product();

        $p->vendor_id       = $vendor_id;
        $p->category_id     = $request->category;
        $p->product_name    = $request->product_name;
        $p->product_description = $request->product_description;
        $p->product_price   = $request->product_price;
        $p->product_pic_1   = $product_pic_1;
        $p->product_pic_2   = $product_pic_2;
        $p->product_pic_3   = $product_pic_3;
        $p->product_pic_4   = $product_pic_4;
        $p->product_pic_5   = $product_pic_5;
        $p->stock           = 1;
        $p->save();

        return redirect('vendor/products')->with('flash_message', 'Product added!');
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
        $product = Product::leftJoin('category as c','c.id','products.category_id')
                        ->leftJoin('vendor as v','v.id','products.vendor_id')
                        ->where('products.id',$id)
                        ->where('products.deleted_at',null)
                        ->select('products.*','c.category_name','v.name as vendor_name')
                        ->first();

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

        $vendor_id = Auth::user()->vendor_id;

        // if(Auth::user()->role_id == 1){
        //     $vendors = Vendor::pluck('name','id');
        //     $categories = Category::pluck('category_name','id');
        // }else{
        //     $categories = Category::where('vendor_id',$vendor_id)->pluck('category_name','id');
        // }
        
        $categories = Category::where('vendor_id',$vendor_id)->pluck('category_name','id');

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
            'product_price' => 'required'
        ]);
        $requestData = $request->all();



        $product = Product::find($id);


        if(Input::file('product_pic_1')){
            $avatarDocument = Input::file('product_pic_1');
            $avatarfile = time() ."." . $avatarDocument->getClientOriginalExtension();
            $nameAvatar = url('images/products').'/1'.$avatarfile;
            $pathAvatar = $nameAvatar;
            
            if(Input::file('product_pic_1')->move('images/products/', $pathAvatar)) {

                $product_pic_1 = $nameAvatar;
            }

        }else{
            $product_pic_1=$product->product_pic_1;
        }

        if(Input::file('product_pic_2')){
            $avatarDocument = Input::file('product_pic_2');
            $avatarfile = time() ."." . $avatarDocument->getClientOriginalExtension();
            $nameAvatar = url('images/products').'/2'.$avatarfile;
            $pathAvatar = $nameAvatar;
            
            if(Input::file('product_pic_2')->move('images/products/', $pathAvatar)) {

                $product_pic_2 = $nameAvatar;
            }

        }else{
            $product_pic_2=$product->product_pic_2;
        }

        if(Input::file('product_pic_3')){
            $avatarDocument = Input::file('product_pic_3');
            $avatarfile = time() ."." . $avatarDocument->getClientOriginalExtension();
            $nameAvatar = url('images/products').'/3'.$avatarfile;
            $pathAvatar = $nameAvatar;
            
            if(Input::file('product_pic_3')->move('images/products/', $pathAvatar)) {

                $product_pic_3 = $nameAvatar;
            }

        }else{
            $product_pic_3=$product->product_pic_3;
        }

        if(Input::file('product_pic_4')){
            $avatarDocument = Input::file('product_pic_4');
            $avatarfile = time() ."." . $avatarDocument->getClientOriginalExtension();
            $nameAvatar = url('images/products').'/4'.$avatarfile;
            $pathAvatar = $nameAvatar;
            
            if(Input::file('product_pic_4')->move('images/products/', $pathAvatar)) {

                $product_pic_4 = $nameAvatar;
            }

        }else{
            $product_pic_4=$product->product_pic_4;
        }

        if(Input::file('product_pic_5')){
            $avatarDocument = Input::file('product_pic_5');
            $avatarfile = time() ."." . $avatarDocument->getClientOriginalExtension();
            $nameAvatar = url('images/products').'/5'.$avatarfile;
            $pathAvatar = $nameAvatar;
            
            if(Input::file('product_pic_5')->move('images/products/', $pathAvatar)) {

                $product_pic_5 = $nameAvatar;
            }

        }else{
            $product_pic_5=$product->product_pic_5;
        }

        
        $product->product_pic_1 = $product_pic_1;
        $product->product_pic_2 = $product_pic_2;
        $product->product_pic_3 = $product_pic_3;
        $product->product_pic_4 = $product_pic_4;
        $product->product_pic_5 = $product_pic_5;
        $product->stock = 1;
        $product->save();

        $product->update($requestData);

        return redirect('vendor/products')->with('flash_message', 'Product updated!');
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

        return redirect('vendor/products')->with('flash_message', 'Product deleted!');
    }
}
