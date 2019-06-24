<!DOCTYPE html>
<html>

<head>
    <title>Student</title>
    @include('links')

</head>

<body>
    @include('Jerry.navbar')

    <div class="container">

        <div class="row centered-form">
            <div class="col-sm-3 col-md-3"></div>
            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="card mt-3">
                    <div class="card-heading">
                        <h3 class="card-title mt-2" align="center" style="font-size: 20px;">Registration Form</h3>
                    </div>

                    <div class="card-body">
                        
                        @if(Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success')}}
                            @php
                            Session::forget('success');
                            @endphp
                        </div>
                        @endif

                        <form role="form" method="post" accept="/studentcreate">
                            {{ csrf_field() }}
                            <br>
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input style="font-size: 16px;" type="text" name="first_name" id="first_name"
                                            class="form-control input-sm" placeholder="First Name">
                                        @if ($errors->has('first_name'))<span
                                            class="text-danger">{{ $errors->first('first_name')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input style="font-size: 16px;" type="text" name="last_name" id="last_name"
                                            class="form-control input-sm" placeholder="Last Name">
                                        @if ($errors->has('last_name'))<span
                                            class="text-danger">{{ $errors->first('last_name')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <br>
                            <div class="form-group">
                                <input style="font-size: 16px;" type="text" name="student_no" id="student_no"
                                    class="form-control input-sm" placeholder="Student Number">
                                @if ($errors->has('student_no'))<span
                                    class="text-danger">{{ $errors->first('student_no')}}</span>
                                @endif
                            </div>

                            <br>
                            <div class="form-group">
                                <label>Date of Birth</label>
                                <input style="font-size: 16px;" type="Date" name="date_of_birth" id="date_of_birth"
                                    class="form-control input-sm" placeholder="Date of Birth">
                                @if ($errors->has('date_of_birth'))<span
                                    class="text-danger">{{ $errors->first('date_of_birth')}}</span>
                                @endif
                            </div>

                            <br>
                            <div class="form-group">
                                <input style="font-size: 16px;" type="text" name="address" id="address"
                                    class="form-control input-sm" placeholder="Your Address">
                                @if ($errors->has('address'))<span
                                    class="text-danger">{{ $errors->first('address')}}</span>
                                @endif
                            </div>

                            <br><input type="submit" style="font-size: 18px;" value="Register"
                                class="btn btn-outline-primary btn-block">

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>