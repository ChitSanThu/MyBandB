<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create User</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="row">
<div class="card card-body col-md-6">
    <form method="post">
        {{csrf_field()}}
        <legend class="text-center">Create User</legend>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(session('status'))
            <div class="alert alert-success">{{session('status')}}</div>
            @endif
        <div class="input-group mb-3">
            <input type="text" name="name" class="form-control input_user" value="" placeholder="username">
        </div>
        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control input_user" value="" placeholder="email">
        </div>
        <div class="input-group mb-2">
            <input type="password" name="password" class="form-control input_pass" value="" placeholder="password">
        </div>
        <div class="input-group mb-2">
            <select name="role" id="" class="form-control">
                <option value="">chose user role<role></role></option>
                @foreach($roles as $role)
                    <option value="{{$role->id}}">{{$role->name}}</option>
                @endforeach
            </select>
        </div>
        <div class=" mt-3">
            <input type="submit" name="button" class="btn login_btn btn-info" value="Create">
        </div>
    </form>
</div>
    <div class="card card-body">
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            @foreach($users as $key=>$user)
                <tr>
                <td>{{++$key}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td><a href="{{url('developer/user/'.$user->id.'/edit')}}" class="btn btn-sm btn-outline-secondary">Edit</a></td>
                    <td><a href="{{url('developer/user/'.$user->id.'/delete')}}" class="btn btn-sm btn-outline-secondary">Delete</a></td>
                </tr>
            @endforeach
        </table>
        <div class="mt-3">
        <a href="{{url('user/frontdesk')}}" class="btn btn-secondary">Frontdesk</a>
        <a href="{{url('user/create/rooms')}}" class="btn btn-secondary">Admin</a>
        </div>
    </div>
</div>
</body>
</html>
