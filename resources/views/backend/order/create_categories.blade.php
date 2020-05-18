
@extends('layout.master')
@section('title')
    Create RoomType
@endsection
@section('content')

    <div class="row col-md-12" style="margin: auto">
        <div class="col-md-6 card card-body">
        <form method="post">
            <legend>ကုန်အုပ်စုများထည့်သွင်းရန်</legend>
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
            <input type="hidden" name="_token" value="{{csrf_token()}}">

            <div class="form-group">
                <label for="title">ကုန်အုပ်စု အမျိုးအစား </label>
                <input type="text" class="form-control" name="categories" id="title" placeholder="ကုန်အုပ်စု ထည့်ရန်">
            </div>
            <button type="submit" class="btn btn-primary">ထည့်မည်</button>
        </form>
        </div>
        @php($c=0)
        <div class="col-md-6 card card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>စဉ်</th>
                        <th>ကုန်အုပ်စု အမည်</th>
                        <th>ဖျက်ရန်</th>
                    </tr>
                    @foreach($cats as $cat)
                    <tr>
                        <td>{{++$c}}</td>
                        <td>{{$cat->cat_name}}</td>
                        <td><a class="btn btn-sm btn-outline-danger" href="{{url('admin/delete/cat/'.$cat->id)}}">ဖျက်ရန်</a></td>
                    </tr>
                    @endforeach
                </table>
        </div>
    </div>

@endsection