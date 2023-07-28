@extends('admin.app-layout')
@section('title')
    Add SubCategory
@endsection
@section('subtitle')
    Add new subcategory
@endsection
@section('content')



<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>


        <div class="container">
            <div class="main-body">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <form id="myForm" action="{{ route('subcategory.store') }}" method="POST">
                                @csrf
                                <div class="card-body">

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Category Name</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">

                                        <select name="category_id" class="form-select mb-3" aria-label="Default select example">
                                            <option selected="">Open this select menu</option>
                                            @foreach ($categories as $category)
                                              <option value="{{$category->id}}">{{$category->category_name}}</option>
                                            @endforeach
                                            
                                        
                                        </select>
                                        </div>
                                    </div> <!-- name -->
                                    
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">SubCategory Name</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <input type="text" name="subcategory_name" class="form-control" />
                                        </div>
                                    </div> <!-- name -->

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Color</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="color_select">
                                                <label class="form-check-label" for="color_select">Color</label>
                                                <input type="hidden" name="color" id="has_color" value="0"> <!-- Campo oculto -->
                                            </div>
                                        </div>
                                    </div> <!-- color -->

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Size</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="size_select">
                                                <label class="form-check-label" for="flexSwitchCheckDefault">Size</label>
                                                <input type="hidden" name="size" id="has_size" value="0"> <!-- Campo oculto -->
                                            </div>
                                        </div>
                                    </div> <!-- color -->
    
    
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
                        subcategory_name: {
                            required : true,
                        }, 
                    },
                    messages :{
                        subcategory_name: {
                            required : 'Please Enter Subcategory Name',
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

<script>
    $(document).ready(function() {
        $('#color_select').on('change', function() {
            if ($(this).is(':checked')) {
                $('#has_color').val('1'); // Si el checkbox de color está seleccionado, establece el valor en 1
            } else {
                $('#has_color').val('0'); // Si el checkbox de color no está seleccionado, establece el valor en 0
            }
        });

        $('#size_select').on('change', function() {
            if ($(this).is(':checked')) {
                $('#has_size').val('1'); // Si el checkbox de tamaño está seleccionado, establece el valor en 1
            } else {
                $('#has_size').val('0'); // Si el checkbox de tamaño no está seleccionado, establece el valor en 0
            }
        });
    });
</script>

        


@endsection