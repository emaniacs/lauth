@extends('auth.layout')

@section('contents')
    @if ($user)
        <form method="post" action="" class="manage-edit">
            <table>
                <tr>
                    <td>Username</td>
                    <td>{{$user->fullname}}</td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="text" name="password" value=""></td>
                </tr>
                <tr>
                    <td>Fullname</td>
                    <td><input type="text" name="fullname" value="{{$user->fullname}}"></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input type="text" name="email" value="{{$user->email}}"></td>
                </tr>
                @if ($user->id != 1)
                <tr>
                    <td>Role</td>
                    <td>
                        <select name="role" value="{{$user->getRole()}}">
                        @foreach (User::getAllRole() as $role => $roleId)
                            <option value="{{$role}}" {{$user->role==$roleId?'selected':''}}>{{$role}}</option>
                        @endforeach
                        </select>
                    </tr>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status" value="{{$user->getStatus()}}">
                        @foreach (User::getAllStatus() as $status => $statusId)
                        <option value="{{$status}}" {{$user->status==$statusId?'selected':''}}>{{$status}}</option>
                    @endforeach
                        </select>
                    </tr>
                </tr>
                @endif
                
                <tr>
                    <td><input type="button" onclick="javascript:history.go(-1)" value="Cancel"></td>
                    <td><input type="submit" value="Save"></td>
                </tr>
            </table>
        </form>
    @else
        <p>User not found</p>
    @endif
@stop

@section('script')
    <script type="text/javascript">
        $(function() {
            $('form.manage-edit').on('submit', function() {
                var self = $(this), url = self.attr('action');
                sendRequest(url, self.serialize())
                    .done(function(data) {
                        if(data.status) {
                            document.location = '/auth/manage';
                        }
                        else {
                            alert(data.message);
                        }
                    })
                return false;
            });
        });
    </script>
@stop

