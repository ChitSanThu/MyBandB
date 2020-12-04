<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="_token" content="{{ csrf_token() }}">

    <title>Frontdesk</title>
    <style>
        .navcolor {
            color: #545b62;
        }

        .noti {
            display: inline-block;
        }

        .row-day-name,
        .row-day {
            background-color: #6c757d;
        }

        .close_tab {
            float: right;
            /*border-radius: 50%;*/
        }

        .close_tab:hover {
            /*background-color: red;*/
            color: red;
            cursor: pointer;
        }

        .payment_state {
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
            background-color: rgba(25, 125, 225, 0.2);
            /* Black w/ opacity */
            /*padding-top: 60px;*/
            /*padding-bottom: 60px;*/
        }

        .daytable {
            width: 100%;
        }

        .roomNumSize {
            width: 15%;
        }

        .logoPannel {
            height: 2cm;
        }

        .roomCell {
            cursor: pointer;
        }

        .checkInstatus {
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
            background-color: rgba(25, 125, 225, 0.2);
            /* Black w/ opacity */
            padding-top: 60px;
            padding-bottom: 60px;
        }

        .current {
            background-color: #66cfff;
        }

        .highlight1 {
            background-color: #99dfff !important;
        }

        .payment_radio {
            width: 18px;
            height: 18px;
        }

        .check-active {
            color: white;
        }

        .check-active:hover {
            color: white;
        }

        .check-active:active {
            color: black;
        }

        * {
            font-family: 'Nunito', sans-serif;
            user-select: none;
        }

        /* for loader style */
        .loader-wrapper {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            background-color: #242f3f;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .loader {
            display: inline-block;
            width: 30px;
            height: 30px;
            position: relative;
            border: 4px solid #Fff;
            animation: loader 2s infinite ease;
        }

        .loader-inner {
            vertical-align: top;
            display: inline-block;
            width: 100%;
            background-color: #fff;
            animation: loader-inner 2s infinite ease-in;
        }

        @keyframes loader {
            0% {
                transform: rotate(0deg);
            }

            25% {
                transform: rotate(180deg);
            }

            50% {
                transform: rotate(180deg);
            }

            75% {
                transform: rotate(360deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes loader-inner {
            0% {
                height: 0%;
            }

            25% {
                height: 0%;
            }

            50% {
                height: 100%;
            }

            75% {
                height: 100%;
            }

            100% {
                height: 0%;
            }
        }

        .clock {
            position: absolute;
            top: 3.5%;
            /* left: 90%;
             */
            right: 0%;
            transform: translateX(-50%) translateY(-50%);
            color: #fff;
            font-size: 16px;
            font-family: Orbitron;
            letter-spacing: 2px;

        }

        .sidebar-size {
            font-size: 30px;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="{{asset('/js/multi.js')}}"></script>
    <script src="{{asset('js/jquery.PrintArea.js')}}"></script>
    <script>
        setInterval(function() {
            $("#refresh").load("{{url('/user/frontdesk')}}" + " #refresh>*", "");
        }, 3000);
        setInterval(function() {
            $("#refresher").load("{{url('/user/frontdesk')}}" + " #refresher>*", "");
        }, 3000);
    </script>

    <script>
        function findGuest(str) {
            if (str.length == 0) {
                document.getElementById("guestresult").innerHTML = "";
            } else {
                var xmlhttp1 = new XMLHttpRequest();
                xmlhttp1.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("guestresult").innerHTML = this.responseText;
                    }
                };
                xmlhttp1.open("GET", "{{url('user/frontdesk/findguest?q=')}}" + str, true);
                xmlhttp1.send();
            }
        }
    </script>


    <script>
        function showHint(str) {
            if (str.length == 0) {
                document.getElementById("txtHint").innerHTML = "";
                $('#txtHintHide').removeClass('hide');
            } else {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("txtHint").innerHTML = this.responseText;
                        $('#txtHintHide').addClass('hide');
                    }
                };
                xmlhttp.open("GET", "{{url('user/frontdesk/search?q=')}}" + str, true);
                xmlhttp.send();
            }
        }
    </script>
</head>

<body>

    {{--@include('/jsblade/multipleSelect')--}}
    @include('../sharedata/nav')

    <div class="row ml-0 mr-0 body">
        <div class="col-md-2">
            <div class="calandar">
                <div class="caladar">
                    @include('../sharedata/calander')
                </div>
                <br>
                @include('../sharedata/sidebar')
            </div>
        </div>
        <div class="col-md-10  ml-0 mr-0 p-0">

            <ul class="nav nav-tabs mt-1" id="myTab" role="tablist" style="background-color:#6c757d">

                <li class="nav-item">
                    <a class="nav-link active check-active" id="home-tab" data-toggle="tab" href="#homed">ဧည့်ဇယား</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link  check-active " id="profile-tab" data-toggle="tab" href="#profile">အကြွေးစာရင်း</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link check-active" id="settings-tab" data-toggle="tab" href="#settings">နေ့စဉ်ဧည့်စာရင်း</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link check-active " id="settings-tab" data-toggle="tab" href="#housekeeper">သန့်ရှင်းရေးမှတ်တမ်း</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link check-active " id="settings-tab" data-toggle="tab" href="#findguest">ဧည့်ရှာရန်</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link check-active" id="report-tab" data-toggle="tab" href="#report">
                        အချက်ပေးသံ
                        @php($count_noti=0)
                        <div id="refresh" class="noti">
                            @foreach(Auth::user()->unreadNotifications as $noti)
                            @php($count_noti++)
                            @endforeach
                            <span class="ml-1 badge badge-pill badge-primary">{{$count_noti}}</span>
                        </div>
                    </a>
                </li>

            </ul>

            <div id="MyClockDisplay" class="clock" onload="showTime()"></div>

            <div class="tab-content">
                <div class="tab-pane active" id="homed">

                    <table class="daytable table-bordered">

                        {{-- Start For Day Name Row --}}
                        <tr class="row-day-name">
                            <td class="roomNumSize"></td>

                            @php($i=1)
                            @foreach ($dayName as $key=>$each)

                            @if($firstDay!=$each)
                            @continue
                            @endif
                            @for ($count = $key; $count <=7; $count++) <td>
                                <p class="mb-0 text-center text-white">{{$dayName[$count]}}</p>
                                @php($i++)
                                </td>
                                @endfor
                                @endforeach

                                @while($i<=$num_of_day) @foreach($dayName as $key=> $name)
                                    <td>
                                        <p class="mb-0 text-center text-white">{{$name}}</p>
                                    </td>
                                    @php($i++)
                                    @if($i>$num_of_day)
                                    @break
                                    @endif
                                    @endforeach

                                    @endwhile

                        </tr>
                        {{-- End For Day Name Row --}}

                        {{-- Start for Day Row --}}
                        <tr class="row-day">
                            <td class=""></td>
                            @for ($count=$startDay;$count<$num_of_day+$startDay;$count++) @if($count==date("d") && $mon==date("m") && $year==date("Y")) @if($count<10 && $count!=$startDay) <td class="day">
                                <p class="current mb-0 text-center text-white">{{"0".$count}}</p>
                                </td>
                                @else
                                {{--<td class="day">{{$count}}</td>--}}
                                @if($count<=$days_of_month) <td class="day">
                                    <p class="current mb-0 text-center text-white">{{$count}}</p>
                                    </td>
                                    @else

                                    @endif
                                    @endif
                                    @else
                                    @if($count<10 && $count!=$startDay) <td class="day">
                                        <p class="mb-0 text-center text-white">{{"0".$count}}</p>
                                        </td>
                                        @else
                                        {{--<td class="day">{{$count}}</td>--}}
                                        @if($count<=$days_of_month) <td class="day">
                                            <p class="mb-0 text-center text-white">{{$count}}</p>
                                            </td>
                                            @else

                                            @endif
                                            @endif
                                            @endif
                                            @endfor

                        </tr>
                        {{-- End for Day Row --}}

                        {{--Start For Room Thpe and  Rome Number --}}
                        @include('frontdesk.room')
                        {{--End For Room Thpe and  Rome Number --}}
                    </table>
                </div>

                <div class="tab-pane{{old('tab') == 'profile' ? ' active' : null}}" id="profile">
                    @include('frontdesk.dept_guest')
                </div>

                <div class="tab-pane{{old('tab') == 'settings' ? ' active' : null}}" id="settings">
                    @include('guest.checkinlist')
                </div>

                <div class="tab-pane{{old('tab') == 'housekeeper' ? ' active' : null}}" id="housekeeper">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">စဉ်</th>
                                <th scope="col">အကြောင်းအရာ</th>
                                <th scope="col">အခန်းနံပါတ်</th>
                                <th scope="col">အခန်း၀င်သူ</th>
                                <th scope="col">ရက်စွဲ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($count_comment=0)
                            @foreach(Auth::user()->notifications as $noti)
                            @if($noti->type=="App\Notifications\HousekeeperCommentNoti" && $noti->data['comment'][0]!="clean")
                            <tr>
                                <th scope="row">{{++$count_comment}}</th>
                                <td>{{$noti->data['comment'][0]}}</td>
                                <td>{{$noti->data['comment'][1]}}</td>

                                <td>{{$noti->data['housekeeper']['name']}}</td>
                                <td>{{date('d/m/Y h:i:s a',strtotime($noti->read_at))}}</td>
                                <td><a href="{{url('user/guest_comment/'.$noti->created_at)}}" class="btn btn-sm btn-danger">Delete</a></td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="tab-pane{{old('tab') == 'profile' ? ' active' : null}}" id="findguest">
                    @include('frontdesk.findguest')
                </div>


                <div class="tab-pane{{old('tab') == 'report' ? ' active' : null}}" id="report">
                    <div id="refresher">
                        @foreach(Auth::user()->unreadNotifications as $noti)
                        @if($noti->type=="App\Notifications\HousekeeperCommentNoti")
                        @if($noti->data['comment'][0]!="clean")
                        <p class="alert alert-success">{{$noti->data['comment'][0]}} အခန်း
                            နံပါတ် {{$noti->data['comment'][1]}}
                            ပေးပို့သူ {{$noti->data['housekeeper']['name']}}
                            <a href="{{url('user/noti/'.$noti->data['housekeeper']['id'])}}" class="btn btn-sm btn-success text-white">Read</a>
                        </p>
                        @else
                        <p class="alert alert-success"> အခန်း နံပါတ် {{$noti->data['comment'][1]}} အား
                            ရှင်းပြီးပါပြီ ပေးပို့သူ {{$noti->data['housekeeper']['name']}}
                            <a href="{{url('user/noti/'.$noti->data['housekeeper']['id'])}}" class="btn btn-sm btn-success text-white">Read</a>
                        </p>
                        @endif
                        @else
                        <p class="alert alert-success">အခန်း၀င်နေပါပြီ
                            ပေးပို့သူ {{$noti->data['housekeeper']['name']}}
                            <a href="{{url('user/noti/'.$noti->data['housekeeper']['id'])}}" class="btn btn-sm btn-success text-white">Read</a>
                        </p>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('frontdesk.payment')
    @include('guest.guestInfo')
    @include('frontdesk.order')
    <div class="loader-wrapper">
        <span class="loader"><span class="loader-inner"></span></span>
    </div>
    <script>
        $('#checkInForm').hide();
        $('#payment_form').hide();
        $('#order_form').hide();
        $('td.roomCell').dblclick(function() {
            $(this).toggleClass('highlight1');
        });
        $(document).ready(function() {
            $('#report-tab').click(function() {
                window.href = "{{url('/user/5?makeasnoti=yes')}}";
                // return "{{url('/user/5?makeasnoti=yes')}}";
            });
        });
        $(window).on("load", function() {
            $(".loader-wrapper").fadeOut("slow");
        });
    </script>
    @include('frontdesk.coustomMenu')
    <script>
        function showTime() {
            var date = new Date();
            var h = date.getHours(); // 0 - 23
            var m = date.getMinutes(); // 0 - 59
            var s = date.getSeconds(); // 0 - 59
            var session = "AM";

            if (h == 0) {
                h = 12;
            }

            if (h > 12) {
                h = h - 12;
                session = "PM";
            }

            h = (h < 10) ? "0" + h : h;
            m = (m < 10) ? "0" + m : m;
            s = (s < 10) ? "0" + s : s;

            var time = h + ":" + m + ":" + s + " " + session;
            document.getElementById("MyClockDisplay").innerText = time + " " + " {{date('M')}}";
            document.getElementById("MyClockDisplay").textContent = time + " " + " {{date('M')}}";
            // console.log(time);
            setTimeout(showTime, 1000);

        }

        showTime();
    </script>
</body>

</html>