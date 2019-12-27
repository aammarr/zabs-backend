<?php

namespace App\Http\Controllers\CategoryController;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\Vendor;
use Input;
use Auth;

class CategoryController extends Controller
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
            $category = Category::leftJoin('vendor as v','v.id','category.vendor_id')
                ->OrWhere('v.name', 'LIKE', "%$keyword%")
                ->OrWhere('category_name', 'LIKE', "%$keyword%")
                ->where('v.id',$vendor_id)
                ->select(
                            'category.id as category_id',
                            'category.vendor_id as vendor_id',
                            'category.category_name as category_name',
                            'category.category_avatar as category_avatar',
                            'category.created_at as created_at',
                            'v.name as vendor_name')
				->paginate($perPage);
        } else {
            $category = Category::leftJoin('vendor as v','v.id','category.vendor_id')
                        ->where('v.id',$vendor_id)
                        ->select('category.*','v.id as vendor_id','v.name as vendor_name')
                        ->paginate($perPage);
        }

        return view('category.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $vendors = Vendor::pluck('name','id');
        return view('category.create', compact('vendors'));
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
            'category_name' => 'required'
        ]);
        $requestData = $request->all();
        $requestData['vendor_id'] = (int) $request->vendor_id?(int) $request->vendor_id:Auth::user()->vendor_id;
        unset($requestData['_token']);
        
        $name   = $request->category_name;
        $category_avatar = $request->category_avatar;

        // city image
        if(Input::file('category_avatar')){
            $avatarDocument = Input::file('category_avatar');
            $avatarfile = time() ."." . $avatarDocument->getClientOriginalExtension();
            $nameAvatar = url('images/category_avatar').'/'.$avatarfile;
            $pathAvatar = $nameAvatar;
            
            if(Input::file('category_avatar')->move('images/category_avatar/', $pathAvatar)) {

                $category_avatar = $nameAvatar;
                $requestData['category_avatar'] = $category_avatar;
            }

        }else{
            $category_avatar=null;
        }

        if(Auth::user()->role_id == 1){  
           Category::insert($requestData);
        }else if(Auth::user()->role_id == 2){
            $c = new Category();
            $c->vendor_id = Auth::User()->vendor_id;
            $c->category_name   = $name;
            $c->category_avatar = $category_avatar;
            $c->save();
        }
       

        return redirect('vendor/category')->with('flash_message', 'Category added!');
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
        // $category = Category::findOrFail($id);
        $category = Category::where('category.id',$id)
                        ->leftJoin('vendor as v','v.id','category.vendor_id')
                        ->select('category.*','v.id as vendor_id','v.name as vendor_name')
                        ->first();

        return view('category.show', compact('category'));
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
        // $category = Category::findOrFail($id);
        $category = Category::where('category.id',$id)
                        ->leftJoin('vendor as v','v.id','category.vendor_id')
                        ->select(
                            'category.id as category_id',
                            'category.vendor_id as vendor_id',
                            'category.category_name as category_name',
                            'category.category_avatar as category_avatar',
                            'category.created_at as created_at',
                            'v.name as vendor_name'
                            )->first();


        return view('category.edit', compact('category'));
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
			'category_name' => 'required'
		]);

        // $requestData = $request->all();
        // $category->update($requestData);

        
        $category = Category::find($id);
        
        if(Input::file('category_avatar')){
            $avatarDocument = Input::file('category_avatar');
            $avatarfile = time() ."." . $avatarDocument->getClientOriginalExtension();
            $nameAvatar = url('images/category_avatar').'/'.$avatarfile;
            $pathAvatar = $nameAvatar;
            
            if(Input::file('category_avatar')->move('images/category_avatar/', $pathAvatar)) {

                $avatar = $nameAvatar;
            }

        }else{
            $avatar=$category->category_avatar;
        }

        $name   = $request->category_name;

        $category->category_name = $name;
        $category->category_avatar =$avatar;
        $category->save();


        return redirect('vendor/category')->with('flash_message', 'Category updated!');
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
        $id = (int) $id;
        $c = Category::find($id);
        $products = Product::where('category_id',$id)->get();
          
        if(count($products) > 0){
            return redirect('vendor/category')->with('warning_message', 'Category cannot be deleted, There are some products associated with this category!');
        }else{
            $c = $c->destroy($id);
        }


        return redirect('vendor/category')->with('flash_message', 'Category deleted!');
    }
}
