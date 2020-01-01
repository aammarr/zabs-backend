<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input as Input;
use Illuminate\Support\Facades\Validator; 

use App\Banner;

use Config;
use Auth;
use DB;


class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $vendor_id = $request->vendor_id;

        $banners = Banner::all();
        // $banners = $b->geBannersbyVendor_id($vendor_id);
        
        if($banners){
            return $this->sendResponse(Config::get('constants.status.OK'),$banners, null);
        }
        else{
            return $this->sendResponse(Config::get('constants.status.OK'),$banners, null);
        }


    }

    public function getBannersByVendorId(Request $request){
        $vendor_id = $request->vendor_id;

        $b = new Banner();
        $banners = $b->geBannersbyVendor_id($vendor_id);
        
        if($banners){
            return $this->sendResponse(Config::get('constants.status.OK'),$banners, null);
        }
        else{
            return $this->sendResponse(Config::get('constants.status.OK'),$banners, null);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
