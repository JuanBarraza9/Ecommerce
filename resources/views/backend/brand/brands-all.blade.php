@extends('admin.app-layout')
@section('title')
    All Brand
@endsection
@section('subtitle')
    Data Table
@endsection
@section('content')


@section('aditional')
<div class="btn-group">
    <a href="{{route('add.brand')}}" class="btn btn-primary">Add Brand</a>
</div>
@endsection

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Brand Name</th>
                        <th>Brand Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($brands as $key => $brand)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$brand->brand_name}}</td>
                        <td><img src="{{asset($brand->brand_image)}}" alt="image-brand" style="width: 70px; heigth:40px;"></td>
                        <td>
                            <a href="#" class="btn btn-info">Edit</a>
                            <a href="#" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
                <tfoot>
                    <tr>
                        <th>Sl</th>
                        <th>Brand Name</th>
                        <th>Brand Image</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>


@endsection