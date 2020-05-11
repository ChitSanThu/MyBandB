@extends('layout.master')
@section('title','edit user')
@section('content')
    <div class="container col-md-8 col-md-offset-2">

        <div class="card card-body">

            <form action="" method="post">

                <legend>Edit Form</legend>
                {{csrf_field()}}

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="name" id="username" value="{{$user->name}}">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" value="{{$user->email}}">
                </div>
                <label for="Select Check Box">Permission</label>

                @foreach($roles as $role)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name='role[]' value="{{$role->name}}" id=""
                               @if(in_array($role->name,$selectedRoles))
                               checked
                                @endif
                        >
                        <label class="form-check-label" for="check"
                               @if(in_array($role->name,$selectedRoles))
                               style="color:blue"
                                @endif
                        >
                            {{$role->name}}
                        </label>
                    </div>
            @endforeach



            <!-- <select class="custom-select" name="role[]" multiple>

                    @foreach($roles as $role)
                <option value="{{$role->name}}"
                                @if(in_array($role->name,$selectedRoles))
                    selected="selected"
@endif
                        >
                            {{$role->name}}</option>
                    @endforeach

                    </select> -->

                <button type="submit" class="btn btn-primary pull-right">Edit</button>
            </form>
        </div>

    </div>

@endsection
