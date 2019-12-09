<?php

namespace App\Http\Controllers\BannerController;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Banner;
use Illuminate\Http\Request;
use Input;
use Auth;


class BannerController extends Controller
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
            $banner = Banner::where('banner', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $banner = Banner::where('vendor_id',$vendor_id)->paginate($perPage);
        }
        
        return view('banner.index', compact('banner'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $vendor_id = Auth::user()->vendor_id;
        $banner = Banner::where('vendor_id',$vendor_id)->get();

        if(count($banner)==5){
            return redirect('vendor/banner')->with('warning_message', 'Only 5 Banner can be added at a time!');

        }
        else{

            return view('banner.create');
        }
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
            'banner' => 'required'
        ]);
        
        $requestData = $request->all();
        // Banner::create($requestData);

        $banner = $request->banner;

        // banner image
        if(Input::file('banner')){
            $avatarDocument = Input::file('banner');
            $avatarfile = time() ."." . $avatarDocument->getClientOriginalExtension();
            $nameAvatar = url('images/banner').'/'.$avatarfile;
            $pathAvatar = $nameAvatar;
            
            if(Input::file('banner')->move('images/banner/', $pathAvatar)) {

                $banner = $nameAvatar;
            }

        }else{
            $banner=null;
        }
        
        $b = new Banner();
        $b->vendor_id = Auth::User()->vendor_id;
        $b->banner = $banner;
        $b->save(); 

        return redirect('vendor/banner')->with('flash_message', 'Banner added!');
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
        $banner = Banner::findOrFail($id);

        return view('banner.show', compact('banner'));
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
        $banner = Banner::findOrFail($id);

        return view('banner.edit', compact('banner'));
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
       

         if(Input::file('banner')){
            $avatarDocument = Input::file('banner');
            $avatarfile = time() ."." . $avatarDocument->getClientOriginalExtension();
            $nameAvatar = url('images/banner').'/'.$avatarfile;
            $pathAvatar = $nameAvatar;
            
            if(Input::file('banner')->move('images/banner/', $pathAvatar)) {

                $banner = $nameAvatar;
            }
        }

        $bannerObj = Banner::findOrFail($id);

        // $bannerObj->update($requestData);
        $bannerObj->where('id',$id)
                ->update(['banner' => $banner]);

        return redirect('vendor/banner')->with('flash_message', 'Banner updated!');
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
        Banner::destroy($id);

        return redirect('vendor/banner')->with('flash_message', 'Banner deleted!');
    }
}
