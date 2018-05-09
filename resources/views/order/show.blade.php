@extends('layouts.backend')
@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Order Details {{-- {{ $order[0]->order_id }} --}}</div>
                    <div class="panel-body">

                        <a href="{{ url('/admin/order') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <!-- <a href="{{ url('/admin/order/' . $order[0]->order_id . '/edit') }}" title="Edit Order"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/order', $order[0]->order_id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Order',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!} -->
                        <br/>
                        <br/>

                        

                        <div class="table-responsive">

                        <table class="table table-hover table-responsive table-bordered">
                          <thead>
                             <tr>
                                <th>Picture</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total Amount</th>
                             </tr>
                          </thead>

                          @foreach($order as $key => $value)

                            <tr>
                                <td> <img class="img-circle" src="<?php echo $order[$key]->product_pic_1;?>" height="50" width="50  "> </td>

                                <td> {{ $order[$key]->product_name }} </td>

                                <td> {{ $order[$key]->product_description }} </td>

                                <td>{{ $order[$key]->quantity }} </td>

                                <td> {{ number_format($order[$key]->product_price,2,",",".")  }}/=  </td>

                                <td> {{ number_format($order[$key]->product_price* $order[$key]->quantity,2,",",".") }}/= </td>
                                

                            </tr>
                          @endforeach

                            <tr>
                                <th colspan="4"><span class="pull-left"></span></th>
                                <th>Delivery Charges</th>
                                <th>PKR {{ number_format($order[$key]->delivery_charges,2,",",".") }}/= </td></th>
                            </tr>

                            <tr>
                                <th colspan="4"><span class="pull-left"></span></th>
                                <th>Amount</th>
                                <th>PKR {{ number_format($order[$key]->total_amount,2,",",".") }}/= </td></th>
                            </tr>

                        </table>
                        </div>

                        

                        <div class="table-responsive">

                            <h2>Customer Information</h2>

                            <table class="table table-hover table-responsive table-bordered">
                                <tbody>
                            
                               <tr>
                                    <th>Customer Name</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Note</th>
                                    <th>Order Time</th>
                                    
                                </tr>
                                <tr>
                                    <td> {{ $order[$key]->name }} </td>
                                    <td>{{ $order[$key]->phone }}</td>
                                    <td>{{ $order[$key]->address }}</td>
                                    <td>{{ $order[$key]->note }}</td>
                                    <td>{{ date("M-d-Y H:i:s D" ,strtotime($order[$key]->order_time)) }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

