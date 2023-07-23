@extends('admin.app-layout')
@section('title')
    Edit Brand
@endsection
@section('subtitle')
    Edit brand with id: {{$id}}
@endsection
@section('content')



<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>


        <div class="container">
            <div class="main-body">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <form id="myForm" action="{{ route('brand.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $brand->id }}">
		                        <input type="hidden" name="old_image" value="{{ $brand->brand_image }}">
                                <div class="card-body">

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Brand Name</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <input type="text" name="brand_name" class="form-control" value="{{$brand->brand_name}}"/>
                                        </div>
                                    </div> <!-- name -->

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Brand Image</h6>
                                        </div>
                                        <div class=" col-sm-9 text-secondary">
                                            <input type="file" name="brand_image" class="form-control" id="image" />
                                        </div>
                                    </div> <!-- photo -->
                                    
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0"></h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <img id="showImage" src="{{asset($brand->brand_image)}}" alt="brand_image" style="width: 100px; height:100px;">
                                        </div>
                                    </div>  <!-- image -->
    
    
                                    <div class="row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="submit" class="btn btn-primary px-4" value="Save Changes" />
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
            $(document).ready(function (){
                $('#myForm').validate({
                    rules: {
                        brand_name: {
                            required : true,
                        }, 
                    },
                    messages :{
                        brand_name: {
                            required : 'Please Enter Brand Name',
                        },
                    },
                    errorElement : 'span', 
                    errorPlacement: function (error,element) {
                        error.addClass('invalid-feedback');
                        element.closest('.form-group').append(error);
                    },
                    highlight : function(element, errorClass, validClass){
                        $(element).addClass('is-invalid');
                    },
                    unhighlight : function(element, errorClass, validClass){
                        $(element).removeClass('is-invalid');
                    },
                });
            });
            
        </script>
        
    

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