<!doctype html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        .guest_name {
            font-size: 11px;
        }

        /* for guest state color */
        .reserv {
            background-color: #17a2b8;
        }

        .checkout {
            background-color: #ffc107;
        }

        .checkin {
            background-color:#007bff;
        }

        .dept {
            background-color: #dc3545;
        }

        .payment_stay_guest {
            background-color: #155724;
        }

        .guest_cell {
            color: white;
        }

        #roomNum {
            font-family: "Californian FB";
            /*font-size: 18px;*/
            font-weight: bold;
            color: whitesmoke;
        }

        .room_type {
            font-size: 16px;
            text-align: center;
            font-weight: bold;
        }

        .past-day {
            background-color: rgba(139, 166, 171, 0.15);
        }

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
    </style>

</head>

<body>

    @foreach ($roomtypes as $type)

    <tr>
        <td class="room_type">{{$type->roomtype}}</td>
        <td class="room_type" colspan="{{$num_of_day}}">{{$type->roomtype}}</td>
    </tr>
    @foreach ($rooms as $room)

    @if($room->roomtype==preg_replace("/(\s+)/","",$type->roomtype))
    <tr class="roomNumberRow">
        @if($room->room_state==0)
        <td scope="row" class="idel" id="roomNum" title=" အခန်းလွတ်">
            <p class="text-white ml-2 mb-0">{{$room->roomumber}}</p>
        </td>
        @endif()
        @if($room->room_state==1)
        <td scope="row" class="room-checkin" id="roomNum" title=" ဧည့်ရှိ">
            <p class="text-white ml-2 mb-0">{{$room->roomumber}}</p>
        </td>
        @endif()
        @if($room->room_state==2)
        <td scope="row" class="room-checkout" id="roomNum" title="ဧည့်ထွက်">
            <p class="text-white ml-2 mb-0">{{$room->roomumber}}</p>
        </td>
        @endif()
        @if($room->room_state==3)
        <td scope="row" class="housekeeping" id="roomNum" title=" သန့်ရှင်းရေး၀င်နေ">
            <p class="text-dark ml-2 mb-0 mr-0">{{$room->roomumber}}</p>
        </td>
        @endif()
        @if($room->room_state==4)
        <td scope="row" class="out-of-service" id="roomNum" title=" ၀င်ဆောင်မှုမရသေး">
            <p class="text-white ml-2 mb-0 mr-0">{{$room->roomumber}}</p>
        </td>
        @endif()
        @if($room->room_state==5)
        <td scope="row" class="room-reserv" id="roomNum" title="{{$room->roomumber}} Reservation">
            <p class="text-white ml-2 mb-0 mr-0">{{$room->roomumber}}</p>
        </td>
        @endif()

        @for ($i = $startDay; $i < $startDay+$num_of_day; $i++) @foreach($guests as $guest) @if($guest->month==$mon && $guest->year==$year)
            @if($guest->room_number==$room->roomumber)

            @if($guest->start_day==$i)
            @php
            $inday=range($guest->start_day,$guest->end_day);

            if($initial_day=array_search($startDay,$inday)){
            $col_span=$guest->end_day-$inday[$initial_day]+1;
            echo $col_span;
            }
            @endphp
            @php($i+=$guest->end_day-$guest->start_day+1)

            @if($guest->guest_status==5)

            <td title="အကြွေးချန်" id="" class="guest_cell dept" colspan="{{$guest->end_day-$guest->start_day+1}}">
                <p class="my-0 guest_name"><span class="text-hide">{{$guest->id}}</span>&nbsp;{{$guest->name}}
                    <span class="text-hide">{{$guest->phone}}&nbsp;{{$guest->start_day}}&nbsp;{{$guest->end_day}}</span>
                </p>

            </td>

            @endif

            @if($guest->guest_status==4)

            <td title="ငွေရှင်းပြီးဧည့်သည်" id="" class="guest_cell payment_stay_guest" colspan="{{$guest->end_day-$guest->start_day+1}}">
                <p class="my-0 guest_name"><span class="text-hide">{{$guest->id}}</span>&nbsp;{{$guest->name}}

                </p>

            </td>

            @endif

            @if($guest->guest_status==3)

            <td title="{{$guest->id }}{{ $guest->name}} Reserv" id="reserv" class=" reserv" colspan="{{$guest->end_day-$guest->start_day+1}}">
                <p class="my-0 guest_name text-white"><span class="text-hide">{{$guest->id}}</span>&nbsp;{{$guest->name}}
                    <span class="text-hide">{{$guest->phone}}&nbsp;{{$guest->start_day}}&nbsp;{{$guest->end_day}}</span>
                </p>

            </td>

            @endif

            @if($guest->guest_status==2)
            <td title="ဧည့်ထွက်" class="guest_cell checkout" colspan="{{$guest->end_day-$guest->start_day+1}}">
                {{--<a href="{{url('/5'.$guest->id)}}"></a>--}}
                <p class="my-0 guest_name"><span class="text-hide">{{$guest->id}}</span>&nbsp;{{$guest->name}}
                    <span class="text-hide ">
                        {{$guest->phone}}&nbsp;{{$guest->start_day}}&nbsp;{{$guest->end_day}}
                        &nbsp;{{$type->price}}&nbsp;{{$room->roomtype}}
                    </span>
                </p>
            </td>
            @endif

            @if($guest->guest_status==1)

            <td title="ဧည့်ရှိ" class="guest_cell checkin" colspan="{{$guest->end_day-$guest->start_day+1}}">
                <p class="my-0 guest_name"><span class="text-hide">{{$guest->id}}</span>&nbsp;{{$guest->name}}
                    <span class="text-hide ">
                        {{$guest->phone}}&nbsp;{{$guest->start_day}}&nbsp;{{$guest->end_day}}
                        &nbsp;{{$type->price}}&nbsp;{{$room->roomtype}}
                    </span>
                </p>
            </td>

            @endif


            @endif
            @endif
            @endif
            @endforeach
	@if(isset($record))	
            @if($i < date('d') && $record->month == date('m') && $record->year == date("Y"))
                <td class="past-day">
                    <p class="mb-0 text-hide">{{$i}}</p>
                </td>
                @elseif($record->month < date('m') || $record->year < date("Y"))
			 <td class="past-day">
                        <p class="mb-0 text-hide">{{$i}}</p>
                        </td>
		@endif

         @else
                        <td class="roomCell">
                            <p class="mb-0 text-hide">{{$i}}</p>
                        </td>
            @endif
		
            @if($i>=$days_of_month)
                @break
            @endif
                        @endfor
    </tr>
    @endif

    @endforeach
    @endforeach
    <script>

    </script>
</body>

</html>
