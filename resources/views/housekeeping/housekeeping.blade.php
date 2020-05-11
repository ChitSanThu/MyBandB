<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        setInterval(function() {
            $(".refresh").load("{{url('/housekeeping/index')}}" + " .refresh>*", "");
        }, 3000);
    </script>
    <style>
        /* for room state color */
        .room-checkin {
            background-color: #007bff;
        }

        .room-checkout {
            background-color: #ffc107;
        }

        .room-reserv {
            background-color: #17a2b8;
        }

        .housekeeping {
            background-color: #28a745;
        }

        .out-of-service {
            background-color: #dc3545;
        }

        .idel {
            background-color: #6c757d;
        }

        .comment-form {
            z-index: 1;
            /* Sit on top */
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            position: fixed;
            overflow: auto;
            /* Enable scroll if needed */
            background-color: #99dfff;
            /* Fallback color */
            background-color: rgba(255, 255, 255, 0.7);
            /* Black w/ opacity */
            padding-top: 60px;
            padding-bottom: 60px;
            display: none;
        }

        .close-point {
            float: right;
            color: rgba(200, 0, 0, 0.7);
            cursor: pointer;
        }
    </style>
</head>

<body>

    <!-- start nav bar -->
    <nav class="navbar navbar-expand-lg navbar-light " style="background-color:#545b62">
        <a class="navbar-brand text-white" href="">MyB&B</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item active ">
                    <a class="nav-link text-white" href="">Housekeeping <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown ">
                    <a class="nav-link dropdown-toggle text-white " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{Auth::user()->name}}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{url('/staff/logout')}}">Logout</a>
                        <!-- <a class="dropdown-item" href="#">Another action</a> -->
                        <!-- <div class="dropdown-divider"></div> -->
                        <!-- <a class="dropdown-item" href="#">Something else here</a> -->
                    </div>
                </li>

            </ul>

        </div>
    </nav>
    <!-- end nav bar -->

    <div class="refresh">
        <!-- @if(!empty($notis)) -->
        @php($front_id=0)
        @foreach($notis as $notia)
        <audio autoplay>
            <source src="{{asset('/notiTone/eventually.ogg')}}" type="audio/ogg">
            <source src="{{asset('/notiTone/eventually.mp3')}}" type="audio/mpeg">
            Your browser does not support the notification song.
        </audio>
        <p class="alert alert-success col-md-12 text-center">
            အခန်း နံပါတ် {{$notia->data['room']}} အားသန့်ရှင်းရန်
            <a href="{{url('/housekeeping/index/sent/'.$notia->data['auth_id'])}}" class="btn btn-sm btn-success ml-3"> Yes</a>
        </p>
        {{session(["auth_id"=>$notia->data['auth_id']])}}
        @endforeach

        <!-- @endif -->

    </div>
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{session('success')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    @php($btn_color)
    @php($room_state)

    <div class="row">
        @foreach($rooms as $room)
        <!-- <div class="row"> -->
        @if($room->room_state==3)
        <div class="col-md-4 col-sm-6 ">
            <div class="btn-group dropright mt-3 ml-4 ">
                <button type="button" class="btn dropdown-toggle housekeeping text-white " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{$room->roomumber}}
                </button>
                <div class="dropdown-menu">
                    <li class="dropdown-item">{{$room->roomtype}}</li>
                    @if(session('auth_id'))
                    <a class="dropdown-item" onclick="$('#comment-form').show()">Comment</a>
                    @endif
                    <a class="dropdown-item" href="{{url('/housekeeping/index/room/'.$room->roomumber)}}">ရှင်းပြီး</a>
                </div>
            </div>
            <!-- </div> -->
        </div>
        @endif
        @endforeach
        @foreach($rooms as $room)
        @if($room->room_state !=3)
        @php
        switch($room->room_state){
        case 0 :{
        $btn_color="idel";
        $room_state="အခန်းလွတ်";
        }
        break;
        case 1 :{
        $btn_color="room-checkin";
        $room_state="Check In";
        }
        break;
        case 2 :{
        $btn_color="room-checkout";
        $room_state="Check Out";
        }
        break;
        case 4 :{
        $btn_color="out-of-service";
        $room_state="Service မရသေးပါ";
        }
        break;
        case 5 :{
        $btn_color="btn-danger";
        $room_state="";
        }
        break;
        }
        @endphp
        <!-- <div class="row"> -->

        <div class="col-md-4 col-sm-6 ">
            <div class="btn-group dropright mt-3 ml-4 ">
                <button type="button" onclick="roomNum($(this).text())" class="btn dropdown-toggle text-white {{$btn_color}} " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{$room->roomumber}}
                </button>
                <div class="dropdown-menu">
                    <li class="dropdown-item">{{$room->roomtype}}</li>
                    <a class="dropdown-item" href="">{{$room_state}}</a>
                @if(session('auth_id'))
                    <a class="dropdown-item" onclick="$('#comment-form').show()">Comment</a>
                @endif
                    <!-- <a class="dropdown-item" href="#">bbc</a> -->
                </div>
            </div>
            <!-- </div> -->
        </div>
        @endif
        @endforeach

    </div>
    <div class="comment-form" id="comment-form">
        <div class="card card-body col-md-8 col-sm-10 " style="margin:auto">
            <form method="post">
                {{csrf_field()}}
                <legend>Comment Form <span class="close-point" onclick="$('#comment-form').hide()">X</span> </legend>
                
                <div class="form-group">
                    <input type="hidden" id="hidden_room" name="number" value="">

                    <input type="text" class="form-control" id="" name="housekeeper-comment">

                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    <script>
        function roomNum(room){

            var rom=$('#hidden_room').val(room);
            // alert(rom);
        }
    </script>
</body>

</html>