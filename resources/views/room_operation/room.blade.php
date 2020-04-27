@extends('layout.master')
@section('title','Create Room')
@section('content')


        <div class="container col-md-8 card card-body">
            <form method="post">
                {{ csrf_field() }}
                @foreach ($errors->all as $error)
                    <p class="alert alert-danger">{{$error}}</p>
                @endforeach

                <legend>Add A Room</legend>
                @if(session('status'))
                    <div class="alert alert-success">{{session('status')}}</div>
                @endif
                <div class="form-group">
                    <label for="roomNumber">Room Numer</label>
                    <input type="text" class="form-control" id="roomNumber" name="roomNumber"
                           placeholder="Enter Room Number">
                </div>
                <div class="form-group">
                    <label for="inputState">Room Type</label>
                    <select id="inputState" name="roomType" class="form-control">
                        @foreach ($types as $room)
                            <option value="{{$room->roomtype}}">{{$room->roomtype}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Add Room</button>
            </form>
        </div>


@endsection