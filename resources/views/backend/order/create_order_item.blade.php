@extends('layout.master')
@section('title','Create Room')
@section('content')


    <div class="container col-md-8 card card-body">
        <form method="post">


            {{ csrf_field() }}
            <legend>order item ထည့်ရန်</legend>
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
            <div class="form-group">
                <label for="roomNumber">item name</label>
                <input type="text" class="form-control" id="order" name="item"
                       placeholder="အခန်းနံပါတ် ရိုက်ရန်">
            </div>
            <div class="form-group">
                <label for="roomNumber">price</label>
                <input type="text" class="form-control" id="order" name="price"
                       placeholder="အခန်းနံပါတ် ရိုက်ရန်">
            </div>
            <div class="form-group">
                <label for="inputState">order အမျိုးအစား</label>
                <select id="inputState" name="categories" class="form-control">
                    <option value="">order အမျိုးအစား ရွေးရန်</option>
                    @foreach ($cats as $cat)
                        <option value="{{$cat->cat_name}}">{{$cat->cat_name}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">ထည့်မည်</button>
        </form>
    </div>


@endsection