@extends("layout.master")
@section('title','Delete Room')
@section('content')
    <div class="container col-md-8 col-md-offset-2">
        <div class="card card-body">
            <legend>အခန်းများ ဖျက်ရန် နေရာ</legend>
            @if(session('room'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session('room')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
            @if(session('room_em'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{session('room_em')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <form action="" method="post">
                {{csrf_field()}}
            <table class="table table-sm table-bordered">
                <thead>
                <th ><input type="checkbox"  name="" id="check_all" class="check form-control form-control-sm"></th>
                <th>အခန်းနံပါတ်</th>
                <th>အခန်းအမျိုးအစား</th>
                <th style="width: 20%" class="text-center"><input type='submit' value="အခန်းများဖျက်" class="btn btn-sm btn-outline-secondary"></th>

                </thead>
                <tbody>
                @foreach($rooms as $room)
                    <tr>
                        <td><input type="checkbox" name="delete_rooms[]" value="{{$room->id}}" class="checkboxes form-control form-control-sm"></td>
                        <td>{{$room->roomumber}}</td>
                        <td>{{$room->roomtype}}</td>
                        <td class="text-center"><a href="{{url('user/delete/room/'.$room->id)}}" class="btn btn-sm btn-outline-secondary">ဖျက်မည်</a></td>

                    </tr>
                @endforeach
                </tbody>
            </table>
            </form>
            {{$rooms->links()}}
        </div>
    </div>
    <script>
        $(function () {
            $('#check_all').click(function () {
                if(this.checked==true)
                    $('.checkboxes').each(function () {
                        this.checked=true;
                    })
                else
                    $('.checkboxes').each(function () {
                        this.checked=false;
                    })
            })
        })
    </script>
@endsection()