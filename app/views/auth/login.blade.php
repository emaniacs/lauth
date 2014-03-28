@extends('auth.layout')

@section('contents')
    @if (isset($message))
        <p class="auth-error">{{$message}}</p>
    @endif
    <p>Dont have an account? Register <a href="/auth/register">here</a></p>

    <table>
        <form method="post">
            <tr>
                <td>Username</td>
                <td><input class="required" type="text" name="username" value="{{Input::get('username')}}"></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input class="required" type="password" name="password"></td>
            </tr>
            <tr>
                <td><button type="submit">Register</button></td>
            </tr>
        </form>
    </table>
@stop
