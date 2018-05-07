<?php

namespace App\Http\Controllers\CategoryController;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Category;
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

        if (!empty($keyword)) {
            $category = Category::where('category_name', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $category = Category::paginate($perPage);
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
        return view('category.create');
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
        
        // dd($requestData);
        // Category::create($requestData);
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
            }

        }else{
            $category_avatar=null;
        }
        
        $c = new Category();
        $c->vendor_id = Auth::User()->vendor_id;
        $c->category_name   = $name;
        $c->category_avatar = $category_avatar;
        $c->save();

        return redirect('admin/category')->with('flash_message', 'Category added!');
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
        $category = Category::findOrFail($id);

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
        $category = Category::findOrFail($id);

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


        return redirect('admin/category')->with('flash_message', 'Category updated!');
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
        $c = Category::find($id);
        $c = $c->delete($id);

        return redirect('admin/category')->with('flash_message', 'Category deleted!');
    }
}
