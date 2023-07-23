@extends('admin.app-layout')
@section('title')
    All SubCategories
@endsection
@section('subtitle')
    Data Table
@endsection
@section('content')


@section('aditional')
<div class="btn-group">
    <a href="{{route('add.subcategory')}}" class="btn btn-primary">Add SubCategory</a>
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
                        <th>SubCategory Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subcategories as $key => $item)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$item['category']['category_name']}}</td>
                        <td>{{$item->subcategory_name}}</td>
                       
                        <td>
                            <a href="{{route('edit.subcategory', $item->id)}}" class="btn btn-info">Edit</a>
                            <a href="{{route('delete.subcategory', $item->id)}}" class="btn btn-danger" id="delete">Delete</a>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
                <tfoot>
                    <tr>
                        <th>Sl</th>
                        <th>Category Name</th>
                        <th>SubCategory Name</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>


@endsection