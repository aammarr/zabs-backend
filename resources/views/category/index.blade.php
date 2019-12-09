@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Category</div>
                    <div class="panel-body">
                        <a href="{{ url('/vendor/category/create') }}" class="btn btn-success btn-sm" title="Add New Category">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        {!! Form::open(['method' => 'GET', 'url' => '/vendor/category', 'class' => 'navbar-form navbar-right', 'role' => 'search'])  !!}
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
                                        <!-- <th>ID</th> -->
                                        <th>Avatar</th>
                                        <th>Name</th>
                                        <th>Vendor</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($category as $item)
                                    <tr>

                                        <!-- <td>{{ $item->id }}</td> -->
                                        <td>
                                            <a class="thumnail" href="{{ $item->category_avatar }}" target="_blank">
                                                <img src="{{ $item->category_avatar }}" class="img-circle" style="height: 100px;width: 100px;">
                                            </a>
                                        </td>
<!--                                         <td>
                                            <a class="thumbnail" href="{{ $item->category_avatar }}">
                                                <img src="{{ $item->category_avatar }}" width="100px" height="66px" border="0" />
                                                <span>
                                                    <img src="{{ $item->category_avatar }}" />
                                                </span>
                                            </a>
                                        </td> -->
                                        <td>{{ $item->category_name }}</td>
                                        <td>{{ $item->vendor_name }}</td>
                                        <td>
                                            <a href="{{ url('/vendor/category/' . $item->id) }}" title="View Category"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/vendor/category/' . $item->id . '/edit') }}" title="Edit Category"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/vendor/category', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete Category',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $category->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
