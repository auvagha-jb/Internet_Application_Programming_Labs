<!DOCTYPE html>
<html>

<head>
    <title>Fee</title>
    @include('links')
</head>

<body>
    @include('Jerry.navbar')
    <div class="container">
        <div class="row mt-3">
            <div class="col-sm-3 col-md-3"></div>
            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="card">
                    <div class="card-heading">
                        <h3 class="card-title mt-2" align="center" style="font-size: 20px;">Fees Deposit Form</h3>
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
                        <form role="form" method="post" accept="/feedeposit">
                            {{ csrf_field() }}

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
                                <input style="font-size: 16px;" type="text" name="amount" id="address"
                                    class="form-control input-sm" placeholder="Payment Amount">
                                @if ($errors->has('amount'))<span
                                    class="text-danger">{{ $errors->first('amount')}}</span>
                                @endif
                            </div>


                            <br>
                            <div class="form-group">
                                <label>Date of Payment</label>
                                <input style="font-size: 16px;" type="Date" name="paid_at" id="paid_at"
                                    class="form-control input-sm" placeholder="Date of Birth">
                                @if ($errors->has('paid_at'))<span
                                    class="text-danger">{{ $errors->first('paid_at')}}</span>
                                @endif
                            </div>

                            <br><input type="submit" style="font-size: 18px;" value="Deposit"
                                class="btn btn-outline-primary btn-block">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>