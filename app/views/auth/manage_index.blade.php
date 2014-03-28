@extends('auth.layout')

@section('contents')
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Username</th>
                <th>Email</th>
                <th>Fullname</th>
                <th>Status</th>
                <th>Roles</th>
                <th>Register date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $u)
            <tr>
                <td>{{$u->id}}</td>
                <td>{{$u->username}}</td>
                <td>{{$u->email}}</td>
                <td>{{$u->fullname}}</td>
                <td>{{$u->getStatus()}}</td>
                <td>{{$u->getRole()}}</td>
                <td>{{$u->created_at}}</td>
                <td>
                    <a href="/auth/manage/edit/{{$u->id}}">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@stop
