<?php

namespace App\Http\Controllers\ContactController;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use Config;
use App\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
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
            $contactus = ContactUs::where('name', 'LIKE', "%$keyword%")
				->orWhere('email', 'LIKE', "%$keyword%")
				->orWhere('mobile', 'LIKE', "%$keyword%")
				->orWhere('title', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $contactus = ContactUs::where('vendor_id',$vendor_id)->paginate($perPage);
        }

        return view('contact-us.index', compact('contactus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('contact-us.create');
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
        
        ContactUs::create($requestData);

        return redirect('admin/contact-us')->with('flash_message', 'ContactUs added!');
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
        $contactus = ContactUs::findOrFail($id);

        return view('contact-us.show', compact('contactus'));
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
        $contactus = ContactUs::findOrFail($id);

        return view('contact-us.edit', compact('contactus'));
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
        
        $contactus = ContactUs::findOrFail($id);
        $contactus->update($requestData);

        return redirect('admin/contact-us')->with('flash_message', 'ContactUs updated!');
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
        ContactUs::destroy($id);

        return redirect('admin/contact-us')->with('flash_message', 'ContactUs deleted!');
    }
}
