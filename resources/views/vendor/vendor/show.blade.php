@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Vendor {{ $vendor->vendor_id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('/admin/vendor') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/vendor/' . $vendor->vendor_id . '/edit') }}" title="Edit Vendor"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/vendor', $vendor->vendor_id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Vendor',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $vendor->vendor_id }}</td>
                                    </tr>
                                    <tr>
                                        <th> Name </th>
                                        <td> {{ $vendor->name }} </td>
                                    </tr>
                                    <tr>
                                        <th> Email </th>
                                        <td> {{ $vendor->email }} </td>
                                    </tr>
                                    <tr>
                                        <th> Description </th>
                                        <td> {{ $vendor->description }} </td>
                                    </tr>
                                    <tr>
                                        <th> City </th>
                                        <td> {{ $vendor->city }} </td>
                                    </tr>
                                    <tr>
                                        <th> Country </th>
                                        <td> {{ $vendor->country }} </td>
                                    </tr>
                                    <tr>
                                        <th> Phone </th>
                                        <td> {{ $vendor->phone }} </td>
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
