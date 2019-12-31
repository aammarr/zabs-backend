<?php

namespace App\Http\Controllers\VendorController;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\Vendor;
use App\User;
use Input;


class VendorController extends Controller
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
            $vendor = Vendor::leftJoin('users as u','u.id','vendor.user_id')
                ->where('vendor.name', 'LIKE', "%$keyword%")
				->orWhere('vendor.description', 'LIKE', "%$keyword%")
				->orWhere('vendor.address', 'LIKE', "%$keyword%")
				->orWhere('vendor.city', 'LIKE', "%$keyword%")
				->orWhere('vendor.country', 'LIKE', "%$keyword%")
				->orWhere('vendor.phone', 'LIKE', "%$keyword%")
                ->whereNull('vendor.deleted_at')
                ->paginate($perPage);
        } else {
            $vendor = Vendor::leftJoin('users as u','u.id','vendor.user_id')
                            ->whereNull('vendor.deleted_at')
                            ->paginate($perPage);
        }

        return view('vendor.index', compact('vendor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('vendor.create');
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
			'name' => 'required',
			'email' => 'required',
			'password' => 'required'
		]);
        $requestData = $request->all();

        $userData['email']  = $requestData['email'];
        $userData['password']  = bcrypt($requestData['password']);
        $userData['first_name']  = $requestData['name'];
        $userData['phone']  = $requestData['phone'];
        $userData['address']  = $requestData['address'];
        $userData['city']  = $requestData['city'];
        $userData['country']  = $requestData['country'];
        $userData['role_id']  = 2;
        $userData['created_at']  = date('Y-m-d H:i:s');
        
        // vendor image
        if(Input::file('vendor_avatar')){
            $avatarDocument = Input::file('vendor_avatar');
            $avatarfile = time() ."." . $avatarDocument->getClientOriginalExtension();
            $nameAvatar = url('images/vendor_avatar').'/'.$avatarfile;
            $pathAvatar = $nameAvatar;
            
            if(Input::file('vendor_avatar')->move('images/vendor_avatar/', $pathAvatar)) {

                $vendor_avatar = $nameAvatar;
                $requestData['vendor_avatar'] = $vendor_avatar;
            }

        }else{
            $vendor_avatar=null;
        }

        User::insert($userData);
        $user = User::where('email',$userData['email'])->first();
    
        $vendorData['user_id']  = $user['id'];
        $vendorData['name']  = $requestData['name'];
        $vendorData['description']  = $requestData['description'];
        $vendorData['phone']  = $requestData['phone'];
        $vendorData['address']  = $requestData['address'];
        $vendorData['city']  = $requestData['city'];
        $vendorData['country']  = $requestData['country'];
        $vendorData['created_at']  = date('Y-m-d H:i:s');
        $vendorData['avatar']  = $vendor_avatar;
        $vendorData['background_image']  = $vendor_avatar;
        Vendor::insert($vendorData);
        $vendor = Vendor::where('user_id',$vendorData['user_id'])->first();
        
        User::where('id', $user['id'])
          ->update(['vendor_id' => $vendor['id'],
                    'avatar'=> $vendor_avatar
                    ]);
        
        return redirect('admin/vendor')->with('flash_message', 'Vendor added!');
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
        $vendor = Vendor::where('vendor.id',$id)->leftJoin('users as u','u.id','vendor.user_id')->first();
        
        return view('vendor.show', compact('vendor'));
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
        $vendor = Vendor::where('vendor.id',$id)->leftJoin('users as u','u.id','vendor.user_id')->first();

        return view('vendor.edit', compact('vendor'));
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
			'name' => 'required',
			'email' => 'required'
		]);
        $requestData = $request->all();
        
        $updatedData['name'] = $requestData['name'];
        $updatedData['description'] = $requestData['description'];
        $updatedData['address'] =    $requestData['address'];
        $updatedData['city'] =    $requestData['city'];
        $updatedData['country'] =    $requestData['country'];
        $updatedData['phone'] =    $requestData['phone'];
        // $updatedData['avatar'] =    $requestData['avatar'];

        $vendor = Vendor::findOrFail($id);

        $vendor->update($updatedData);
        
        $updatedUserData['first_name'] = $requestData['name'];
        $updatedUserData['address'] =    $requestData['address'];
        $updatedUserData['city'] =    $requestData['city'];
        $updatedUserData['country'] =    $requestData['country'];
        $updatedUserData['phone'] =    $requestData['phone'];
        $updatedUserData['email'] = $requestData['email'];

        $user = User::where('vendor_id',$id);
        $user->update($updatedUserData);

        return redirect('admin/vendor')->with('flash_message', 'Vendor updated!');
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
        // Vendor::destroy($id);
        // return redirect('admin/vendor')->with('flash_message', 'Vendor deleted!');

        $id = (int) $id;
        $v = Vendor::find($id);
        $vc = Category::where('vendor_id',$id)->get();
        $vp = Product::where('vendor_id',$id)->get();
        
        
        if(count($vc) > 0){
            return redirect('admin/vendor')->with('warning_message', 'Vendor cannot be deleted, There are some categories associated with this vendor!');
        }
        else if(count($vp) > 0){
            return redirect('admin/vendor')->with('warning_message', 'Vendor cannot be deleted, There are some products associated with this vendor!');
        }
        else{
            $v = $v->destroy($id);
        }


        return redirect('admin/vendor')->with('flash_message', 'Vendor deleted!');
    }
}
