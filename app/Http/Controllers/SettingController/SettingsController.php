<?php

namespace App\Http\Controllers\SettingController;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use Config;
use App\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
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
            $settings = Setting::leftJoin('vendor as v','v.id','settings.vendor_id')
                        ->leftJoin('users as u','u.id','v.user_id')
                        ->select('u.email','v.name','settings.*')
                        ->where('delivery_fee', 'LIKE', "%$keyword%")
                        ->paginate($perPage);
        } else {
            $settings = Setting::leftJoin('vendor as v','v.id','settings.vendor_id')
                        ->leftJoin('users as u','u.id','v.user_id')
                        ->select('u.email','v.name','settings.*')
                        ->paginate($perPage);
        }

        // if(Auth::user()->role_id == 1){
            
        // }
        // else if(Auth::user()->role_id == 2){
        //     dd("2");

        // }else{
        //     //logout
        //     dd('logout');
        // }


        

        return view('settings.index', compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('settings.create');
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
        
        Setting::create($requestData);

        return redirect('vendor/settings')->with('flash_message', 'Setting added!');
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
        $setting = Setting::leftJoin('vendor as v','v.id','settings.vendor_id')
                        ->leftJoin('users as u','u.id','v.user_id')
                        ->select('u.email','v.name','settings.*')
                        ->where('settings.id',$id)
                        ->first();

        return view('settings.show', compact('setting'));
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
        $setting = Setting::findOrFail($id);

        return view('settings.edit', compact('setting'));
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

        $fee = $requestData['delivery_fee'];
        $tnc = $requestData['t_n_c'];
        
        $setting = Setting::findOrFail($id);
        $setting->delivery_fee =$fee;
        $setting->t_n_c =$tnc;
        $setting->save();

        return redirect('vendor/settings')->with('flash_message', 'Setting updated!');
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
        Setting::destroy($id);

        return redirect('vendor/settings')->with('flash_message', 'Setting deleted!');
    }
}
