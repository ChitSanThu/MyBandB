@extends('layout.master')
@section('title','Create Room')
@section('content')


        <div class="container col-md-8 card card-body">
            <form method="post">

                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">{{$error}}</div>
                @endforeach
                    {{ csrf_field() }}
                <legend>အခန်း ထည့်ရန်</legend>
                @if(session('status'))
                    <div class="alert alert-success">{{session('status')}}</div>
                @endif
                <div class="form-group">
                    <label for="roomNumber">အခန်း နံပါတ်</label>
                    <input type="text" class="form-control" id="roomNumber" name="roomNumber"
                           placeholder="အခန်းနံပါတ် ရိုက်ရန်">
                </div>
                <div class="form-group">
                    <label for="inputState">အခန်းအမျိုးအစား</label>
                    <select id="inputState" name="roomType" class="form-control">
                        <option value="">အခန်းအမျိုးအစား ရွေးရန်</option>
                        @foreach ($types as $room)
                            <option value="{{$room->roomtype}}">{{$room->roomtype}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">ထည့်မည်</button>
            </form>
        </div>


@endsection