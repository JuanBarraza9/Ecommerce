@extends('vendor.app-layout')
@section('title')
   Change password
@endsection
@section('subtitle')
    Edit password
@endsection
@section('content')

@section('content')
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

            <div class="container">
                <div class="main-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card p-4">
                                <form action="{{ route('vendor.update.password') }}" method="POST">
                                    @csrf

                                    @if (session('status'))
                                        
                                        <div class="alert alert-success" role="alert">
                                            {{session('status')}}
                                        </div>

                                    @elseif (session('error'))

                                        <div class="alert alert-danger" role="alert">
                                            {{session('error')}}
                                        </div>
                                    
                                        @endif

                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Old Password</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="password" name="old_password" 
                                                class="form-control
                                                @error('old_password')
                                                    is-invalid
                                                @enderror"
                                                id="current_password"
                                                placeholder="Old Password" />

                                                @error('old_password')
                                                    <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div> <!-- password -->

                                        
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">New Password</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="password" name="new_password" 
                                                class="form-control
                                                @error('new_password')
                                                    is-invalid
                                                @enderror"
                                                id="new_password"
                                                placeholder="New Password" />

                                                @error('new_password')
                                                    <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div> <!-- password -->


                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Confirm New Password</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="password" name="new_password_confirmation" 
                                                class="form-control"
                                                id="new_password_confirmation"
                                                placeholder="Confirm New Password" />
                                            </div>
                                        </div> <!-- password -->

        
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