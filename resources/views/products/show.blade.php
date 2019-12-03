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
               <table class="table table-hover table-responsive">
                  <thead>
                     <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Price</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->product_name }}</td>
                        <td>{{ $product->product_description }}</td>
                        <td>{{ $product->category_name }}</td>
                        <td>{{ "AED ".$product->product_price }}</td>
                     </tr>
                  </tbody>
               </table>
            </div>
            <div class="panel-body">
                @if ( $product->product_pic_1 != '' )
                    <img src="{{ $product->product_pic_1 }}" class="img-thumbnail"  width="15%" height="10%">
                @endif


                @if ( $product->product_pic_2 != '' )
                    <img src="{{ $product->product_pic_2 }}" class="img-thumbnail"  width="15%" height="10%">
                @endif


                @if ( $product->product_pic_3 != '' )
                    <img src="{{ $product->product_pic_3 }}" class="img-thumbnail"  width="15%" height="10%">
                @endif


                @if ( $product->product_pic_4 != '' )
                    <img src="{{ $product->product_pic_4 }}" class="img-thumbnail"  width="15%" height="10%">
                @endif

                @if ( $product->product_pic_5 != '' )
                    <img src="{{ $product->product_pic_5 }}" class="img-thumbnail" width="15%" height="10%">
                @endif
            </div>
         </div>
      </div>
      
   </div>
</div>
@endsection