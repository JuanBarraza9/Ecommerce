@extends('admin.app-layout')
@section('title')
    All Products
@endsection
@section('subtitle')
    Data Table
@endsection
@section('content')


@section('aditional')
<div class="btn-group">
    <a href="{{route('add.product')}}" class="btn btn-primary">Add Product</a>
</div>
@endsection

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Discount</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $key => $item)
                    <tr>
                        <td>{{$key+1}}</td>
                    
                        <td><img src="{{asset($item->product_thambnail)}}" alt="image-product" style="width: 70px; heigth:70px;"></td>
                        <td>{{$item->product_name}}</td>
                        <td>{{$item->selling_price}}</td>
                        <td>{{$item->quantity}}</td>
                        <td>{{$item->discount_price}}</td>
                        <td>
                            @if($item->status === 1)
                            <div class="badge rounded-pill bg-light-success text-success w-100">available</div>
                        @else
                        <div class="badge rounded-pill bg-light-danger text-danger w-100">not available</div>
                        @endif
                        </td>
                        <td>
                            <a href="{{route('edit.category', $item->id)}}" class="btn btn-info">Edit</a>
                            <a href="{{route('delete.category', $item->id)}}" class="btn btn-danger" id="delete">Delete</a>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
                <tfoot>
                    <tr>
                        <th>Sl</th>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Discount</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>


@endsection