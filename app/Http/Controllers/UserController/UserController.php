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

            /*$user = User::where('vendor_id',$vendor_id)->where('role_id',3)
                ->orwhere('first_name', 'LIKE', "%$keyword%")
                ->orwhere('last_name', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->orderBy('created_at','desc')
                ->paginate($perPage);*/


            $user = User::where('role_id',3)
                ->where('vendor_id',$vendor_id)
                ->where(function($q) use ($keyword){
                    $q->where('first_name','like','%'.$keyword.'%')
                    ->orwhere('last_name','like','%'.$keyword.'%')
                    ->orwhere('email','like','%'.$keyword.'%');
                })
                ->orderBy('created_at','desc')
                ->paginate($perPage);
                    
            
        } else {
            $user = User::where('role_id','3')->where('vendor_id',$vendor_id)->paginate($perPage);

        }

        return view('user.index', compact('user'));
    }



    /**
     * 
     *
     */

    public function changePasssword(Request $request){
        
        $oldPassword        = $request->old_password;
        $new_password       = $request->new_password;
        $confirm_password   = $request->confirm_password;

        $email      = Auth::User()->email;
        $password   = Auth::User()->password;

        if (Auth::attempt(['email' => $email, 'password' => $oldPassword, 'role_id' => 1]))
        {   
            if( $new_password != $confirm_password){
                return redirect('/change_password')->with('warning_message', 'New Password donot match!');
            
            }else{
                
                $user = Auth::User();
                $user->password = bcrypt($new_password);
                $user->save();

                return redirect('/home')->with('flash_message', 'Password Successfuly Changed!');
            }

        }
        else if (Auth::attempt(['email' => $email, 'password' => $oldPassword, 'role_id' => 2]))
        {   
            if( $new_password != $confirm_password){
                return redirect('/change_password')->with('warning_message', 'New Password donot match!');
            }else{
                
                $user = Auth::User();
                $user->password = bcrypt($new_password);
                $user->save();

                return redirect('/home')->with('flash_message', 'Password Successfuly Changed!');
            }

        }
        else{
            return redirect('/change_password')->with('warning_message', 'Password Entered Incorrect!');
            dd('Password Entered Incorrect');

        }

    }

     /**
     * 
     *
     */

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
