@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Product {{ $product->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('/admin/products') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/products/' . $product->id . '/edit') }}" title="Edit Product"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/products', $product->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Product',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $product->id }}</td>
                                    </tr>
                                    <tr>
                                        <th> Name </th>
                                        <td> {{ $product->product_name }} </td>
                                    </tr>
                                    <tr>
                                        <th> Description </th>
                                        <td> {{ $product->product_description }} </td>
                                    </tr>
                                    <tr>
                                        <th> Price </th>
                                        <td> {{ "PKR ".$product->product_price }} </td>
                                    </tr>
                                    <tr>
                                        <th> Category </th>
                                        <td> {{ $product->category_name }} </td>
                                    </tr>
                                    <tr>
                                        <th> Picture 1 </th>
                                        <td>  <a class="thumnail" href="{{ $product->product_pic_1 }}" target="_blank">
                                                <img src="{{ $product->product_pic_1 }}" class="img-circle" style="height: 100px;width: 100px;">
                                            </a> </td>
                                    </tr>
                                    <tr>
                                        <th> Picture 1 </th>
                                        <td>  <a class="thumnail" href="{{ $product->product_pic_2 }}" target="_blank">
                                                <img src="{{ $product->product_pic_2 }}" class="img-circle" style="height: 100px;width: 100px;">
                                            </a> </td>
                                    </tr>
                                    <tr>
                                        <th> Picture 1 </th>
                                        <td>  <a class="thumnail" href="{{ $product->product_pic_3 }}" target="_blank">
                                                <img src="{{ $product->product_pic_3 }}" class="img-circle" style="height: 100px;width: 100px;">
                                            </a> </td>
                                    </tr>
                                    <tr>
                                        <th> Picture 1 </th>
                                        <td>  <a class="thumnail" href="{{ $product->product_pic_4 }}" target="_blank">
                                                <img src="{{ $product->product_pic_4 }}" class="img-circle" style="height: 100px;width: 100px;">
                                            </a> </td>
                                    </tr>
                                    <tr>
                                        <th> Picture 1 </th>
                                        <td>  <a class="thumnail" href="{{ $product->product_pic_5 }}" target="_blank">
                                                <img src="{{ $product->product_pic_5 }}" class="img-circle" style="height: 100px;width: 100px;">
                                            </a> </td>
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
