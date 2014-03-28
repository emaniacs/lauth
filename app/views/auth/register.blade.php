@extends('auth.layout')

@section('contents')
    @if (isset ($register))
        <p>Register success, please login in this <a href="/auth/login">page</a></p>
    @else
        @if (isset($message))
            <p class="auth-error">{{$message}}</p>
        @endif
        <p>Have an account? Login <a href="/auth/login">here</a></p>
        
        <table>
            <form method="post">
                <tr>
                    <td>Fullname</td>
                    <td><input class="required" type="text" name="username" value="{{Input::get('username')}}"></td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td><input class="required" type="text" name="fullname" value="{{Input::get('fullname')}}"></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input class="required" type="text" name="email" value="{{Input::get('email')}}"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input class="required" type="password" name="password"></td>
                </tr>
                <tr>
                    <td>Password confirmation</td>
                    <td><input class="required" type="password" name="password1"></td>
                </tr>
                <tr>
                    <td><button type="submit">Register</button></td>
                </tr>
            </form>
        </table>
    @endif
@stop
