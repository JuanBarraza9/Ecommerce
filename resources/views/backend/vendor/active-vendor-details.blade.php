@extends('admin.app-layout')
@section('title')
    Vendor Profile
@endsection
@section('subtitle')
    Vendor Details
@endsection
@section('content')

<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>


        <div class="container">
            <div class="main-body">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <form action="{{ route('inactive.vendor.approve') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{$activeVendorDetails->id}}">
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">User Name</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="username" class="form-control" value="{{$activeVendorDetails->username}}"/>
                                        </div>
                                    </div> <!-- username -->
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Full Name</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="name" class="form-control" value="{{$activeVendorDetails->name}}"  />
                                        </div>
                                    </div> <!-- name -->
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Email</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="email" class="form-control" value="{{$activeVendorDetails->email}}" />
                                        </div>
                                    </div> <!-- email -->
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Phone</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="phone" class="form-control" value="{{$activeVendorDetails->phone}}" />
                                        </div>
                                    </div> <!-- phone -->
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Address</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="address" class="form-control" value="{{$activeVendorDetails->address}}" />
                                        </div>
                                    </div> <!-- address -->

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Vendor Join</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" class="form-control" value="{{\Carbon\Carbon::parse($activeVendorDetails->created_at)->format('Y-m-d')}}" disabled/>
                                        </div>
                                    </div> <!-- vendor join -->

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Vendor Info</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <textarea name="vendor_short_info" class="form-control" id="inputAddress2" placeholder="Vendor Info " rows="3">
                                            {{ $activeVendorDetails->vendor_short_info }}
                                        </textarea>
                                        </div>
                                    </div> <!-- vendor info -->

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Photo</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="file" name="photo" class="form-control" id="image" />
                                        </div>
                                    </div> <!-- photo -->
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0"></h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <img id="showImage" src="{{(!empty($activeVendorDetails->photo)) ? url('upload/vendor_images/'.$activeVendorDetails->photo) : url('upload/no_image.jpg')}}" alt="image vendor" style="width: 100px; height:100px;">
                                        </div>
                                    </div>  <!-- image -->
    
    
                                    <div class="row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="submit" class="btn btn-danger px-4" value="InActive Vendor" />
                                        </div>
                                    </div> <!-- button -->
                            </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    

    <script type="text/javascript"> 
        $(document).ready(function(){
            $('#image').change(function(e){
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#showImage').attr('src', e.target.result);
                };
                reader.readAsDataURL(e.target.files['0']);
            })
        });
    </script>

@endsection