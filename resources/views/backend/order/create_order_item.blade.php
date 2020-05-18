@extends('layout.master')
@section('title','Create Room')
@section('content')


    <div class="container col-md-8 card card-body">
        <form method="post">


            {{ csrf_field() }}
            <legend>ကုန်ပစ္စည်း ထည့်ရန်</legend>
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
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session('status')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="form-group">
                <label for="roomNumber">ကုန်ပစ္စည်း အမည်</label>
                <input type="text" class="form-control" id="order" value="{{old('item')}}" name="item"
                       placeholder="ကုန်ပစ္စည်း ရိုက်ရန်">
            </div>
            <div class="form-group">
                <label for="roomNumber">စျေးနှုန်း</label>
                <input type="text" class="form-control" value="{{old('price')}}"  id="order" name="price"
                       placeholder="စျေးနှုန်း ရိုက်ရန်">
            </div>
            <div class="form-group">
                <label for="inputState">ကုန်အုပ်စု အမျိုးအစား</label>
                <select id="inputState" name="categories" class="form-control">
                    <option value="">ကုန်အုပ်စု အမျိုးအစား ရွေးရန်</option>
                    @foreach ($cats as $cat)
                        <option value="{{$cat->id}}">{{$cat->cat_name}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">ထည့်မည်</button>
        </form>
    </div>


@endsection