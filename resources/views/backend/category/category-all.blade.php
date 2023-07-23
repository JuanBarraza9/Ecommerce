@extends('admin.app-layout')
@section('title')
    All Categories
@endsection
@section('subtitle')
    Data Table
@endsection
@section('content')


@section('aditional')
<div class="btn-group">
    <a href="{{route('add.category')}}" class="btn btn-primary">Add Category</a>
</div>
@endsection

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Category Name</th>
                        <th>Category Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $key => $category)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$category->category_name}}</td>
                        <td><img src="{{asset($category->category_image)}}" alt="image-category" style="width: 70px; heigth:70px;"></td>
                        <td>
                            <a href="{{route('edit.category', $category->id)}}" class="btn btn-info">Edit</a>
                            <a href="{{route('delete.category', $category->id)}}" class="btn btn-danger" id="delete">Delete</a>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
                <tfoot>
                    <tr>
                        <th>Sl</th>
                        <th>Category Name</th>
                        <th>Category Image</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>


@endsection