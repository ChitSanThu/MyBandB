<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Frontdesk</title>
    <style>
        .navcolor {
            color: #66cfff;
        }

        /* .body{
            background-color: #66cfff;
        } */
        .row-day-name, .row-day {
            background-color: #99dfff;

        }

        .daytable {
            width: 100%;
            text-align: center;
        }

        .roomNumSize {
            width: 15%;
        }

        .logoPannel {
            height: 2cm;
        }

        .caladar {

        }

        /* td.roomCell:hover{
            cursor: pointer;
            color: burlywood;
            background-color: brown;

        } */
        .highlight {
            background-color: #ccc !important;
        }

        .highlight1 {
            background-color: #99dfff !important;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    {{--<link rel="stylesheet"--}}
          {{--href="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.7.1/jquery.contextMenu.min.css">--}}

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.7.1/jquery.contextMenu.min.js"></script>--}}
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.7.1/jquery.ui.position.js"></script>--}}

    <script src="js/multi.js"></script>

</head>
<body>
@include('/jsblade/multipleSelect')
@include('../sharedata/nav')
<div class="row ml-0 mr-0 body">
    <div class="col-md-2 ml-0 mr-0">
        <div class="calandar">
            <div class="caladar">
                @include('../sharedata/calander')
            </div>
            <br>

            @include('../sharedata/sidebar')
        </div>
    </div>
    <div class="col-md-10">

        <ul class="nav nav-tabs mt-1" id="myTab" role="tablist" style="background-color:#e6faff">

            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#homed" role="tab" aria-controls="home"
                   aria-selected="true">FrontDesk</a>
            </li>
            {{--@if (Route::currentRouteAction()!="App\Http\Controllers\DateBarController@createDate")--}}
            {{--@if ($tabNum==1)--}}
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                   aria-controls="profile"
                   aria-selected="false">Housekeeping</a>
            </li>
            {{--@endif--}}
            {{--@if ($tabNum[0]==2)--}}
            <li class="nav-item">
                <a class="nav-link" id="messages-tab" data-toggle="tab" href="#messages" role="tab"
                   aria-controls="messages"
                   aria-selected="false">Report</a>
            </li>
            {{--@endif--}}
            {{--@if ($tabNum==3)--}}
            <li class="nav-item">
                <a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings" role="tab"
                   aria-controls="settings"
                   aria-selected="false">Member</a>
            </li>
            {{--@endif--}}
            {{--@php(print_r($tabNum))--}}
            {{--@endif--}}
            <li class="nav-item  ml-auto">
                <a class="btn btn-sm btn-outline-info" href="{{url('/7')}}">Week</a>
            </li>
            <li class="nav-item ml-2 mr-2">
                <a class="btn btn-sm btn-outline-info" href="{{url('/15')}}">15 Days</a>
            </li>


            <li class="nav-item navbar-right">
                <a class="btn btn-sm btn-outline-info" href="{{url('/')}}">Month</a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="homed" role="tabpanel" aria-labelledby="home-tab">

                <table class="daytable table-bordered">

                    {{-- Start For Day Name Row --}}
                    <tr class="row-day-name">
                        <td class="roomNumSize"></td>

                        @php($i=1)
                        @foreach ($dayName as $key=>$each)

                            @if($firstDay!=$each)
                                @continue

                            @endif
                            @for ($count = $key; $count <=7; $count++)
                                <td>
                                    {{$dayName[$count]}}
                                    @php($i++)
                                </td>
                            @endfor

                        @endforeach

                        @while($i<=$num_of_day)
                            @foreach($dayName as $key=> $name)
                                <td>
                                    {{$name}}
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
                        @for ($count=$startDay;$count<$num_of_day+$startDay;$count++)
                            @if($count<10 && $count!=$startDay)
                                <td class="day">{{"0".$count}}</td>
                            @else
                                {{--<td class="day">{{$count}}</td>--}}
                                @if($count<=31)
                                    <td class="day">{{$count}}</td>
                                @else

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
            <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">

            </div>
            <div class="tab-pane" id="messages" role="tabpanel" aria-labelledby="messages-tab">
                <ul class="list-group col-md-2">
                    <li class="list-group-item">Dapibus ac facilisis in</li>


                    <li class="list-group-item list-group-item-primary text-center">primary</li>
                    <li class="list-group-item list-group-item-secondary text-center">secondary</li>
                    <li class="list-group-item list-group-item-success text-center">success</li>
                    <li class="list-group-item list-group-item-danger text-center">danger</li>
                    <li class="list-group-item list-group-item-warning text-center">warning</li>
                    <li class="list-group-item list-group-item-info text-center">info </li>
                    <li class="list-group-item list-group-item-light text-center">light</li>
                    <li class="list-group-item list-group-item-dark text-center">dark</li>
                </ul>
            </div>
            <div class="tab-pane" id="settings" role="tabpanel" aria-labelledby="settings-tab">settings...</div>
        </div>
    </div>
</div>
@include('frontdesk.coustomMenu')
{{--<a class="btn btn-inverse btn-large hidden-print" onClick="javascript:window.print();">Printt</a>--}}
</body>

</html>

