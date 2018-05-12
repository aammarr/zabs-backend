<?php

namespace App\Http\Controllers\ContactController;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Contact-U;
use Illuminate\Http\Request;

class Contact-UsController extends Controller
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
            $contact-us = Contact-U::where('name', 'LIKE', "%$keyword%")
				->orWhere('email', 'LIKE', "%$keyword%")
				->orWhere('title', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $contact-us = Contact-U::paginate($perPage);
        }

        return view('contact--us.index', compact('contact-us'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('contact--us.create');
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
        
        Contact-U::create($requestData);

        return redirect('admin/contact--us')->with('flash_message', 'Contact-U added!');
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
        $contact-us = Contact-U::findOrFail($id);

        return view('contact--us.show', compact('contact-us'));
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
        $contact-us = Contact-U::findOrFail($id);

        return view('contact--us.edit', compact('contact-us'));
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
        
        $contact-us = Contact-U::findOrFail($id);
        $contact-us->update($requestData);

        return redirect('admin/contact--us')->with('flash_message', 'Contact-U updated!');
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
        Contact-U::destroy($id);

        return redirect('admin/contact--us')->with('flash_message', 'Contact-U deleted!');
    }
}
