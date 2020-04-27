@extends('layout.master')
@section('title')
    Create RoomType
@endsection
@section('content')

        <div class="col-md-8 container card card-body">
            <form method="post">
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">{{$error}}</div>
                @endforeach
                <legend>Add A RoomType</legend>

                @if(session('status'))
                    <div class="alert alert-success">{{session('status')}}</div>
                @endif
                <input type="hidden" name="_token" value="{{csrf_token()}}">

                <div class="form-group">
                    <label for="title"> RomeType</label>
                    <input type="text" class="form-control" name="roomType" id="title" placeholder="Room Type">
                </div>
                <div class="form-group">
                    <label for="price"> Price</label>
                    <input type="number" class="form-control" name="price" id="title" placeholder="Enter price">
                </div>


                <button type="submit" class="btn btn-primary">Add RoomType</button>
            </form>
        </div>

@endsection