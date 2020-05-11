@extends('layout.master')
@section('title','All role')
@section('content')
    <div class="container col-md-8 col-md-offset-2">
        <div class="card card-body">
            <table class="table table-bordered">
                <thead>
                    <th>Id</th>
                <th>Name</th>
                </thead>
                <tbody>
                @foreach($roles as $role)
                    <tr>
                    <td>{{$role->id}}</td>
                    <td><a href="{{ url('admin/create/roles')}}">{{  $role->name    }}</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endsection
