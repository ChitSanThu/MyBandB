@extends('layout.master')
@section('title','all user')
@section('content')
    <div class="container col-md-8 col-md-offset-2">
        <div class="card card-body">
            <table class="table table-bordered">
                <thead>
                <th>Id</th>
                <th>UserName</th>
                <th>Email</th>
                <th>Role</th>
                <th>Detail</th>
                </thead>

                @foreach($users as $user)
                    <tbody>
                    <td>{{$user->id}}</td>
                    <td><a href=""></a>{{ $user->name  }}</td>
                    <td>{{$user->email}}</td>
                    <td><a href="{{url('admin/users/'.$user->id.'/edit')}}" class=""><img
                                    src="{{asset('/image/roles.jpg')}}" alt="" width="20px" height="20px" class="mr-1">Edit</a>
                    </td>
                    <td><a href=""><img src="{{asset('/image/download.png')}}" alt="" width="20px" height="20px"
                                        class="mr-1">Detail</a></td>
                    </tbody>
                @endforeach


            </table>
        </div>
    </div>
@endsection()