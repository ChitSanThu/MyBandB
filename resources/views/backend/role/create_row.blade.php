@extends('layout.master')
@section('title','Role Create')
@section('content')
    <div class="container col-md-8 col-md-offset-2">
        <form action="" method="post">
            {{csrf_field()}}
            <legend>Insert A Role</legend>

            <div class="form-group">
                @foreach($errors->all() as $error)
                    <p class="alert alert-danger">{{$error}}</p>
                    @endforeach
                @if(session('status'))
                    <p class="alert alert-success">{{session('status')}}</p>
                    @endif
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="username" placeholder="role name">
            </div>
            <button type="submit" class="btn btn-primary">Create Role</button>
        </form>
    </div>
    @endsection
