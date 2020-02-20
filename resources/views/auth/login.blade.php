@extends('layouts.login-register')

@section('content')
<div class="container" id="login-block">
            <i class="user-img icons-faces-users-03"></i>
            <div class="account-info bg-dark" style="width:500px;">
               <a class="logo"></a>
                <h3><strong>Hotel Emilia</strong><br/>Management System</h3>
                <hr/>
               
            </div>
            <div class="account-form">
                <form class="form-signin"  method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}
                    <h3><strong>Sign in</strong> to your account</h3>
                    <div class="append-icon">
                        <input type="text" name="username" id="username" class="form-control form-white username" placeholder="Username" required>
                        <i class="icon-user"></i>
                    </div>
                    <div class="append-icon m-b-20">
                        <input type="password" name="password" class="form-control form-white password" placeholder="Password" required>
                        <i class="icon-lock"></i>
                    </div>
                    <button type="submit" class="btn btn-lg btn-dark btn-rounded ladda-button" >Sign In</button>
                  
                </form>
             
            </div>
            
        </div>
@endsection
