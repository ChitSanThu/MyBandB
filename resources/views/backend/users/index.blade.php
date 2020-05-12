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
                </thead>

                @foreach($users as $user)
                    <tbody>
                    <td>{{$user->id}}</td>
                    <td><a href=""></a>{{ $user->name  }}</td>
                    <td>{{$user->email}}</td>

                    </tbody>
                @endforeach


            </table>
        </div>
    </div>
@endsection()