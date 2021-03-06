@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Products</div>
                    <div class="panel-body">
                        <a href="{{ url('/vendor/products/create') }}" class="btn btn-success btn-sm" title="Add New Product">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        {!! Form::open(['method' => 'GET', 'url' => '/vendor/products', 'class' => 'navbar-form navbar-right', 'role' => 'search'])  !!}
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
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>Avatar</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $item)
                                    <tr>
                                        <td>
                                            <a class="thumnail" href="{{ $item->product_pic_1 }}" target="_blank">
                                                <img src="{{ $item->product_pic_1 }}" class="img-circle" style="height: 100px;width: 100px;">
                                            </a>
                                        </td>
                                        <td>{{ $item->product_name }}</td>
                                        <td>{{ $item->product_description }}</td>
                                        <td>{{ $item->category_name }}</td>
                                        <td>{{ "AED ".$item->product_price }}</td>
                                        <td>
                                            <a href="{{ url('/vendor/products/' . $item->id) }}" title="View Product"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/vendor/products/' . $item->id . '/edit') }}" title="Edit Product"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/vendor/products', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete Product',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                            <?php 
                                            if($item->stock=='1'){
                                            ?>
                                                <a href="{{ url('/vendor/products/outStock/' . $item->id) }}" title="View Product"><button class="btn btn-warning btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> Out Of Stock</button></a>
                                            <?php
                                            }
                                            else{
                                            ?>
                                              <a href="{{ url('/vendor/products/inStock/' . $item->id) }}" title="View Product"><button class="btn btn-success btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> In Stock</button></a>  
                                            <?php }
                                            ?>
                                            
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $products->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
