@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Order</div>
                    <div class="panel-body">
                        <!-- <a href="{{ url('/vendor/order/create') }}" class="btn btn-success btn-sm" title="Add New Order">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a> -->

                        {!! Form::open(['method' => 'GET', 'url' => '/vendor/order', 'class' => 'navbar-form navbar-right', 'role' => 'search'])  !!}
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search..." value="{{request('search')}}">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                        {!! Form::close() !!}

                        <br/>
                        <br/>
                        <div class="">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Amount</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($order as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>{{ "AED ".$item->total_amount }}</td>
                                        <td>
                                            <a href="{{ url('/vendor/order/' . $item->id) }}" title="View Order">
                                                <button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> View
                                                </button>
                                            </a>
                                            @if($item->status == 'pending')
                                            
                                                <a href="{{ url('/vendor/order/' . $item->id . '/accept') }}" title="Accept Order">
                                                    <button class="btn btn-success btn-xs"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Accept
                                                    </button>
                                                </a>
                                                <a href="{{ url('/vendor/order/' . $item->id . '/reject') }}" title="Reject Order">
                                                    <button class="btn btn-danger btn-xs"><i class="fa fa-minus-square-o" aria-hidden="true"></i> Reject
                                                    </button>
                                                </a>
                                            @endif
                                            <!--{!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/vendor/order', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete Order',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!} -->
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $order->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
