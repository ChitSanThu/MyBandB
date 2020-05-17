
@extends('layout.master')
@section('title')
    Create RoomType
@endsection
@section('content')

    <div class="row col-md-12" style="margin: auto">
        <div class="col-md-6 card card-body">
        <form method="post">
            <legend>Order Type</legend>
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
            <input type="hidden" name="_token" value="{{csrf_token()}}">

            <div class="form-group">
                <label for="title"> Categories type</label>
                <input type="text" class="form-control" name="categories" id="title" placeholder="categories ထည့်ရန်">
            </div>
            <button type="submit" class="btn btn-primary">ထည့်မည်</button>
        </form>
        </div>
        <div class="col-md-6 card card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>id</th>
                        <th>categories name</th>
                        <th>delete</th>
                    </tr>
                    @foreach($cats as $cat)
                    <tr>
                        <td>{{$cat->id}}</td>
                        <td>{{$cat->cat_name}}</td>
                        <td><a href="{{url('admin/delete/cat/'.$cat->id)}}">delete</a></td>
                    </tr>
                    @endforeach
                </table>
        </div>
    </div>

@endsection