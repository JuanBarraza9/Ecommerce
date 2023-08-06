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

                        <td>
                            @if($item->discount_price == NULL)
                              <div class="badge rounded-pill bg-success">No Discount</div>
                            @else
                              @php
                                $amount = $item->selling_price - $item->discount_price;
                                $discount = ($amount/$item->selling_price) * 100;   
                              @endphp
                              <div class="badge rounded-pill bg-danger">{{ round($discount) }}%</div>
                            @endif
                        </td>
                        
                        <td>
                            @if($item->status === 1)
                              <div class="badge rounded-pill bg-success">Active</div>
                            @else
                              <div class="badge rounded-pill bg-danger">InActive</div>
                            @endif
                        </td>
                        <td>
                            <a href="{{route('edit.category', $item->id)}}" class="btn btn-info text-white" title="Edit Data"><i class="fa fa-pencil"></i></a>
                            <a href="{{route('edit.category', $item->id)}}" class="btn btn-warning text-white" title="Details Page Data"><i class="fa fa-eye"></i></a>
                            @if($item->status === 1)
                            <a href="{{route('edit.category', $item->id)}}" class="btn btn-primary" title="Inactive"><i class="fa-solid fa-thumbs-down"></i></a>
                            @else
                            <a href="{{route('edit.category', $item->id)}}" class="btn btn-primary" title="Active"><i class="fa-solid fa-thumbs-up"></i></a>
                            @endif
                            <a href="{{route('delete.category', $item->id)}}" class="btn btn-danger" id="delete" title="Delete Data"><i class="fa fa-trash"></i></a>
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