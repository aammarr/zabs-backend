<?php

namespace App\Http\Controllers\OrderController;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Order;
use Auth;
use Config;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
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

            $order = Order::leftJoin('vendor as v','v.id','orders.vendor_id')
            	->where(function($q) use ($keyword){
                    $q->where('name', 'LIKE', "%$keyword%")
                ->orWhere('phone', 'LIKE', "%$keyword%")
                ->orWhere('total_amount', 'LIKE', "%$keyword%");
                })
                ->select('orders.*','v.name as vendor_name')
                ->orderBy('created_at','desc')
                ->paginate($perPage);
        } else {
            $order = Order::leftJoin('vendor as v','v.id','orders.vendor_id')
            		->select('orders.*','v.name as vendor_name')
            		->paginate($perPage);
        }

        return view('admin_order.index', compact('order'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('order.create');
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
        
        Order::create($requestData);

        return redirect('admin/order')->with('flash_message', 'Order added!');
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
        // $order = Order::find($id);
        // dd($order);
        $o      = new Order();
        $order  = $o->getOrderDetailsById($id);
        
        return view('admin_order.show', compact('order'));
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
        $order = Order::findOrFail($id);

        return view('order.edit', compact('order'));
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
        
        $order = Order::findOrFail($id);
        $order->update($requestData);

        return redirect('admin/order')->with('flash_message', 'Order updated!');
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
        Order::destroy($id);

        return redirect('admin/order')->with('flash_message', 'Order deleted!');
    }
}
