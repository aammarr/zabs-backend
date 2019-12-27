<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Input as Input;
use Illuminate\Support\Facades\Validator; 

use App\Vendor;

use Config;
use Auth;
use DB;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
    	$response = Vendor::all();
        if($response){
            return $this->sendResponse(Config::get('constants.status.OK'),$response, null);
        }
        else{
            return $this->sendResponse(Config::get('constants.status.OK'),null, null);
        }
    }

    public function getVendorById(Request $request){
        $vendor_id = $request->vendor_id;
        $response = Vendor::findOrFail($vendor_id);
        if($response){
            return $this->sendResponse(Config::get('constants.status.OK'),$response, null);
        }
        else{
            return $this->sendResponse(Config::get('constants.status.OK'),null, null);
        }
    }

    public function prodByVendorNcategoryId(Request $request)
    {   
        $vendor_id      = $request->vendor_id;
        $category_id    = $request->category_id;

        $p = new Product();
        $response = $p->getProductsByVendorAndCategoryId($vendor_id,$category_id);  
        
        if($response){
            return $this->sendResponse(Config::get('constants.status.OK'),$response, null);
        }
        else{
            return $this->sendResponse(Config::get('constants.status.OK'),null, null);
        }
    }

    public function prodByVendorId(Request $request)
    {   
        $vendor_id      = $request->vendor_id;
        $category_id    = $request->category_id;

        $p = new Product();
        $response = $p->getProductsByVendorId($vendor_id);  
        
        if($response){
            return $this->sendResponse(Config::get('constants.status.OK'),$response, null);
        }
        else{
            return $this->sendResponse(Config::get('constants.status.OK'),null, null);
        }
    }

    public function prodByProdId(Request $request)
    {   
        $vendor_id      = $request->vendor_id;
        $product_id      = $request->product_id;
        $p = new Product();
        $response = $p->getProductByProductId($vendor_id,$product_id);  
            
        if($response){
            return $this->sendResponse(Config::get('constants.status.OK'),$response, null);
        }
        else{
            return $this->sendResponse(Config::get('constants.status.OK'),null, null);
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
