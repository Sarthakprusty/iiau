@extends('layout.outer')


@section('title', 'Login')



@section('content')

    <div class="maincontainer d-flex align-items-center justify-content-center ">
        <div class="row">
            <div class=" sideimage shadow" style="background-image: url('../../storage/rb.jpg');background-size: cover; background-position: center;background-repeat: no-repeat;width: 650px ;">
            </div>
            <div class=" monkeylogin" style="background: linear-gradient(lavender,white)">
                <div class="animcon" id="animcon">
                </div>
                <br>
                <div class="formcon">
                    <form method="post" action="login">
                        @csrf
                        <!--        <input type="email" id="mail" name=""  class="tb" placeholder="Email" autocomplete="off" [(ngModel)]="username"/>-->
                        <input type="text" id="username" name="username"  class="tb" placeholder="Username" autocomplete="off" />
                        <br/>
                        <br/>
                        <!--        <input type="password" id="pwdbar" (click)="closeEye()" name="pwd" class="tb" placeholder="Password" [(ngModel)]="password"/>-->
                        <input type="password" id="pwdbar"  name="password" class="tb" placeholder="Password" />
                        <br/>
                        <br/>
                        <input type="submit" name="" class="sbutton enlarge-on-hover"  value="LOG IN" />
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
