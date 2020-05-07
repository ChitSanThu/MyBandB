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
                <legend>အခန်းအမျိုးအစား ထည့်ရန်</legend>

                @if(session('status'))
                    <div class="alert alert-success">{{session('status')}}</div>
                @endif
                <input type="hidden" name="_token" value="{{csrf_token()}}">

                <div class="form-group">
                    <label for="title"> အခန်းအမျိုးအစား</label>
                    <input type="text" class="form-control" name="roomType" id="title" placeholder="အခန်းအမျိုးအစား ထည့်ရန်">
                </div>
                <div class="form-group">
                    <label for="price"> စျေးနှုန်း</label>
                    <input type="number" class="form-control" name="price" id="title" placeholder="စျေးနှုန်း ထည့်ရန်">
                </div>


                <button type="submit" class="btn btn-primary">ထည့်မည်</button>
            </form>
        </div>

@endsection