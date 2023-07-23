@extends('admin.app-layout')
@section('title')
    All Inactive Vendor
@endsection
@section('subtitle')
    Data Table
@endsection
@section('content')


@section('aditional')

@endsection

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Shop Name</th>
                        <th>Vendor Username</th>
                        <th>Join Date</th>
                        <th>Vendor Email</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($activeVendor as $key => $item)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->username}}</td>
                        <td>{{ \Carbon\Carbon::parse($item->created_at)->format('Y-m-d') }}</td>
                        <td>{{$item->email}}</td>
                        <td><span class="badge rounded-pill bg-light-success text-success w-100">{{$item->status}}</span></td>
                        <td>
                            <a href="{{route('active.vendor.details', $item->id)}}" class=""><i class="bx bx-cog"></i> Details</a>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
                <tfoot>
                    <tr>
                        <th>Sl</th>
                        <th>Shop Name</th>
                        <th>Vendor Username</th>
                        <th>Join Date</th>
                        <th>Vendor Email</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>


@endsection