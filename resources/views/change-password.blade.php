@extends('layout.main')


@section('title', 'change_password')



@section('content')


    <div class="container" >
        <br>

        <div class="row">

            <b><header style="text-decoration: underline" class="text-center"><h3>Change Password</h3></header></b>

        </div>
        <br>

        {{--    <div class="card shadow" xmlns="http://www.w3.org/1999/html">--}}
        {{--        <div class="card-body">--}}
        <form method="POST" action="{{route('user.change_password')}}"  >
            @csrf
            <div>
                <div class="row">
                    <div class="col-md-4" style="text-align: right">
                        <b>   <label class="form-label" for="mobile_no" >Name:</label></b>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group row">
                            {{$user-> name}}
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4" style="text-align: right">
                        <b> <label class="form-label" for="password" >Password:<span style="color: red;">*</span></label></b>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group row">
                            <input type="password" class="form-control" name="password" id="password" placeholder="xxxxxxx" required>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4" style="text-align: right">
                        <b>  <label class="form-label" for="cnf_password" >Confirm Password:<span style="color: red;">*</span></label></b>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group row">
                            <input type="text" class="form-control" name="cnf_password" id="cnf_password" placeholder="abcd" required>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div style="text-align: center" >
                        <button type="submit" class="btn btn-outline-success" name="submit" value="submit" >Submit</button>
                    </div>
                </div>


            </div>
        </form>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                document.querySelector('button[name="submit"]').addEventListener('click', function (event) {
                    var password = document.getElementById('password').value;
                    var confirmPassword = document.getElementById('cnf_password').value;

                    if (password !== confirmPassword) {
                        alert('Passwords do not match');
                        event.preventDefault(); // Prevent form submission
                    }
                });
            });
        </script>

    </div>
    {{--    </div></div>--}}
@endsection
