@extends('layouts.backend')
@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')


            <style type="text/css">
                .seperate_custom {border-bottom: 1px solid black; padding-bottom: 7% !important;}
            </style>


            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Order {{ $order[0]->order_id }}</div>
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
                            <table class="table table-borderless">
                                <tbody>
                            @foreach($order as $key => $value)
                                <tr>
                                    <th> Product Picture </th>
                                    <td> <img class="img-circle" src="<?php echo $order[$key]->product_pic_1;?>" height="100" width="100"> </td>
                                </tr>
                                <tr>
                                    <th> Product Name </th>
                                    <td> {{ $order[$key]->product_name }} </td>
                                </tr>
                                <tr>
                                    <th> Product Description </th>
                                    <td> {{ $order[$key]->product_description }} </td>
                                </tr>
                                <tr>
                                    <th> Quantity </th>
                                    <td> {{ " x ".$order[$key]->quantity }} </td>
                                </tr>
                                 <tr>
                                    <th> Price </th>
                                    <td> {{ $order[$key]->product_price }} </td>
                                </tr>
                                <tr>
                                    <th class="seperate_custom"> Product Amount </th>
                                    <td class="seperate_custom"> {{ $order[$key]->product_price." x ".$order[$key]->quantity." = ".$order[$key]->total_price ." PKR"}} </td>
                                </tr>
                                
                            @endforeach
                               <tr>
                                    <th> Name </th>
                                    <td> {{ $order[$key]->name }} </td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td>{{ $order[$key]->phone }}</td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <td>{{ $order[$key]->address }}</td>
                                </tr>
                                <tr>
                                    <th>Note</th>
                                    <td>{{ $order[$key]->note }}</td>
                                </tr>
                                <tr>
                                    <th>Order Time</th>
                                    <td>{{ date("M-d-Y H:i:s D" ,strtotime($order[$key]->order_time)) }}</td>
                                </tr>
                                <tr>
                                    <th> Delivery Charges </th>
                                    <td> {{ $order[$key]->delivery_charges." PKR" }} </td>
                                </tr>
                                <tr>
                                    <th class="seperate_custom"> Total Amount </th>
                                    <td class="seperate_custom"> {{ $order[$key]->total_amount." PKR" }} </td>
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

