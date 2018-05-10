<?php

namespace App\Http\Controllers\UserController;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;
use Auth;
use Config;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
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

            /*$user = User::where('of_vendor',$vendor_id)->where('role_id',3)
                ->orwhere('first_name', 'LIKE', "%$keyword%")
                ->orwhere('last_name', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->orderBy('created_at','desc')
                ->paginate($perPage);*/


            $user = User::where('role_id',3)
                ->where('of_vendor',2)
                ->where(function($q) use ($keyword){
                    $q->where('first_name','like','%'.$keyword.'%')
                    ->orwhere('last_name','like','%'.$keyword.'%')
                    ->orwhere('email','like','%'.$keyword.'%');
                })
                ->orderBy('created_at','desc')
                ->paginate($perPage);
                    
            
        } else {
            $user = User::where('role_id','3')->where('of_vendor',$vendor_id)->paginate($perPage);

        }

        return view('user.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('user.create');
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
        
        $requestData = $request->all();
        
        User::create($requestData);

        return redirect('admin/user')->with('flash_message', 'User added!');
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
        $user = User::find($id);

        return view('user.show', compact('user'));
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
        $user = User::findOrFail($id);

        return view('user.edit', compact('user'));
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
        
        $requestData = $request->all();
        
        $user = User::findOrFail($id);
        $user->update($requestData);

        return redirect('admin/user')->with('flash_message', 'User updated!');
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
        User::destroy($id);

        return redirect('admin/user')->with('flash_message', 'User deleted!');
    }
}
