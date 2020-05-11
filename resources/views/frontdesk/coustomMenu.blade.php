<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="_token" content="{{csrf_token()}}"/>
    <title>Document</title>
    <style>
        .showcontext {
            position: absolute;
        }
        .hide {
            display: none;
        }
        /* Create a custom circle  */
        .checkmark {
            position: absolute;
            height: 25px;
            width: 25px;
            border-radius: 50%;
        }
        .pointer:hover {
            cursor: pointer;
        }
        .reservation_class {
            z-index: 1;
            /* Sit on top */
            left: 0;
            top: 0;
            width: 100%;
            height: auto;
            position: fixed;
            /*overflow: auto; !* Enable scroll if needed *!*/
            /*background-color: #99dfff; !* Fallback color *!*/
            background-color: rgba(255, 255, 255, 0.7);
            /* Black w/ opacity */
            padding-top: 60px;
            padding-bottom: 100%;
        }
    </style>
    <script>
        $(document).bind("click", function (event) {
            document.getElementById("number").className = "hide";
        });

        $(document).bind("click", function (event) {
            document.getElementById("rmenu").className = "hide";

        });

        $(document).bind("click", function (event) {
            document.getElementById("guest").className = "hide";
        });

        function mouseX(evt) {
            if (evt.pageX) {
                return evt.pageX;
            } else if (evt.clientX) {
                return evt.clientX + (document.documentElement.scrollLeft ?
                    document.documentElement.scrollLeft :
                    document.body.scrollLeft);
            } else {
                return null;
            }
        }

        function mouseY(evt) {
            if (evt.pageY) {
                return evt.pageY;
            } else if (evt.clientY) {
                return evt.clientY + (document.documentElement.scrollTop ?
                    document.documentElement.scrollTop :
                    document.body.scrollTop);
            } else {
                return null;
            }
        }

        $(document).ready(function () {

            if ($("#test").addEventListener) {
                $("#test").addEventListener('contextmenu', function (e) {
                    alert("You've tried to open context menu"); //here you draw your own menu
                    e.preventDefault();
                }, false);
            } else {
                $('body').on('contextmenu', '.highlight1', function () {
                    var checkIn = $('.highlight1').first().text();
                    var checkOut = $('.highlight1').last().text();

                    var num_of_day = $('#numDay').val(checkIn + "-" + checkOut);
                    var esc_sp = num_of_day.val().replace(/\s+/g, " ");
                    num_of_day.val(esc_sp);

                    var room_text = $('.highlight1').parent().text();
                    var escape_space = room_text.replace(/\s+/g, " ");
                    var splic_num = escape_space.split(" ");
                    $('#rnb').val(splic_num[1]);
                    // alert($('#contron_checkin').val());
                    document.getElementById("rmenu").className = "showcontext";
                    document.getElementById("rmenu").style.top = mouseY(event) + 'px';
                    document.getElementById("rmenu").style.left = mouseX(event) + 'px';

                    window.event.returnValue = false;
                });
                //    for guest-cell contextMenu
                $('body').on('contextmenu', '.guest_cell', function () {
                    var text_id = $(this).text();
                    // alert(text_id);
                    var escpce = text_id.replace(/\s+/g, " ");
                    var id = escpce.split(" ");
                    var guest_id = id[1];
                    var room_text = $(this).parent().text();
                    var escape_space = room_text.replace(/\s+/g, " ");
                    var splic_num = escape_space.split(" ");
                    // alert(splic_num);
                    // for payment value
                    // alert(id);
                    $('#invoice_id').val(id[1]);
                    $('#room_type').val(id[7]);
                    $('#room_cost').val(id[6]);
                    var payment_day = id[5] - id[4] + 1;
                    $('#payment_name').val(id[2]);
                    $('#payment_day').val(payment_day);
                    var cost = id[6] * payment_day;
                    $('#payment_cost').val(id[6] * payment_day);
                    $('#payment_room').val(splic_num[1]);
                    var tax = cost * 0.01 * {{ $invoice->tax }};
                    $('#tax').val(tax);
                    var total = cost + tax;
                    $('#total').val(total);
                    $('#discount').keyup(function () {

                        $('#total').val(total - $('#discount').val());
                    });
                    $("#link_href").attr('href', "{{url('user/frontdesk')}}"+'/'+"guest/checkout/" + guest_id+"/" + splic_num[1]);
                    $("#cancle").attr('href', "{{url('user/frontdesk')}}"+ "/guest/cancleguest/" + guest_id + "/" + splic_num[1]);

                    document.getElementById("rmenu").className = "showcontext";
                    document.getElementById("rmenu").style.top = mouseY(event) + 'px';
                    document.getElementById("rmenu").style.left = mouseX(event) + 'px';

                    window.event.returnValue = false;
                });

                //    for room number ContextMenu
                $('body').on('contextmenu', '#roomNum', function () {
                    var room_num = $(this).text();
                    var escpce = room_num.replace(/\s+/g, " ");
                    var num = escpce.split(" ");
                    var room = num[1];
                    // alert($('#count_user').text());
                    var num_of_house = $('#count_user').text();
                    for (var start = 1; start <= num_of_house; start++) {
                        var user_id = $('#ask_housekeeping' + start + ' #user_id').text();
                        $('#ask_housekeeping' + start).attr('href',"{{url('user/housekeeping')}}"+ '/' + user_id + "/" + room + "/{{Auth::user()->id}}");
                    }
                    // alert(window.location.href + "?room=modify&number=" + room);
                    $("#link_href_room").attr('href',"{{url('user/room')}}"+ "/checkin/" + room);
                    $("#link_href_room1").attr('href', "{{url('user/room')}}"+ "/checkout/" + room);
                    $("#link_href_room2").attr('href', "{{url('user/room')}}" + "/housekeeping/" + room);
                    $("#link_href_room3").attr('href', "{{url('user/room')}}" + "/outofservice/" + room);
                    $("#link_href_room0").attr('href', "{{url('user/room')}}"+ "/idel/" + room);
                    $("#link_href_room4").attr('href', "{{url('user/room')}}" + "/reserv/" + room);
                    document.getElementById("number").className = "showcontext";
                    document.getElementById("number").style.top = mouseY(event) + 'px';
                    document.getElementById("number").style.left = mouseX(event) + 'px';

                    window.event.returnValue = false;
                });

                //for reservation form
                $('body').on('contextmenu', '#reserv', function () {
                    var raw_reserve = $(this).text();

                    var escape_reserve = raw_reserve.replace(/\s+/g, " ");
                    var reserve_guest = escape_reserve.split(" ");
                    // var room_text = $('#reserv').parent().text();
                    // var escape_space = room_text.replace(/\s+/g, " ");
                    // var splic_num = escape_space.split(" ");
                    // alert(splic_num);
                    var room_text = $(this).parent().text();
                    var escape_space = room_text.replace(/\s+/g, " ");
                    var splic_num = escape_space.split(" ");
                    // alert(splic_num);
                    $('#guest_id').val(reserve_guest[1]);
                    $('#rnb').val(splic_num[1]);
                    $('#name').val(reserve_guest[2]);
                    $('#phone').val(reserve_guest[3]);
                    $('#numDay').val(reserve_guest[4] + "-" + reserve_guest[5]);
                    $('#contron_checkin').val('reserv');
                    // alert($('#contron_checkin').val());
                    $("#cancle").attr('href', "{{url('user/guest/frontdesk')}}"+ "/cancleguest/" + reserve_guest[1] + "/" + splic_num[1]);
                    document.getElementById("rmenu").className = "showcontext";
                    document.getElementById("rmenu").style.top = mouseY(event) + 'px';
                    document.getElementById("rmenu").style.left = mouseX(event) + 'px';
                    window.event.returnValue = false;
                });
            }
            $('#resert').click(function () {
                var checkIn = $('.highlight1').first().text();
                var checkOut = $('.highlight1').last().text();

                var num_of_day = $('#reserv_numDay').val(checkIn + "-" + checkOut);
                var esc_sp = num_of_day.val().replace(/\s+/g, " ");
                num_of_day.val(esc_sp);
                var room_text = $('.highlight1').parent().text();
                var escape_space = room_text.replace(/\s+/g, " ");
                var splic_num = escape_space.split(" ");
                $('#reserv_room').val(splic_num[1]);
                // alert(splic_num[1]);
                document.getElementById("reservation_form").className = "showcontext";
            });
        });
    </script>
</head>

<body>

<div class="hide list-group" id="rmenu">

    <a onclick="$('#checkInForm').show();" class="pointer list-group-item list-group-item-action">Check In</a>
    <a href="" id="link_href" class="pointer list-group-item list-group-item-action">Check Out</a>
    <a onclick="$('#payment_form').show();" id="link_href" class="pointer list-group-item list-group-item-action">Payment </a>
    <a onclick="$('#reservation_form').show();" class="pointer list-group-item list-group-item-action" id="resert">Reservation</a>

    <a href="" id="cancle" class="pointer list-group-item list-group-item-action">Cancle</a>

</div>

<div class="hide list-group" id="number">
    <li class="list-group-item">Assign</li>
    @php($count_user=0)
    @foreach(App\user::all() as $user)
        @if($user->hasRole('housekeeping'))
            <a href="" id="ask_housekeeping{{++$count_user}}" class="list-group-item list-group-item-action">
                <span class="hide" id="user_id">{{ $user->id }}</span>
                <p class="text mb-0">{{$user->name}}</p>
            </a>
        @endif
    @endforeach
    <span class="hide" id="count_user">{{$count_user}}</span>
    <li class="list-group-item">အခန်းအခြေအနေ</li>


    <a href="" id="link_href_room0" class="list-group-item list-group-item-action">
        <span class="checkmark idel ml-1 mb-0"></span>
        <p class="text ml-5 mb-0">Idel</p>
    </a>

    <a href="" id="link_href_room2" class="list-group-item list-group-item-action ">
        <span class="checkmark housekeeping ml-1"></span>
        <p class="text ml-5 mb-0">Housekeeping</p>
    </a>
    <a href="" id="link_href_room3" class="list-group-item list-group-item-action ">
        <span class="checkmark out-of-service ml-1"></span>
        <p class="text ml-5 mb-0">Out Of Service</p>
    </a>

</div>
{{--reservation form --}}
<div class="hide" id="reservation_form">
    <div class="row reservation_class">
        <div class="card card-body col-md-4 container form-width">

            <legend>Reservation Form</legend>

            <form action="" method="post">
                {{ csrf_field() }}

                <input type="hidden" name="status" value="3">
                <div class="row">
                    <div class="col">
                        <label for="forroomnumber">Room Number</label>
                        <input type="text" readonly name="roomNum" id="reserv_room" class="form-control">
                    </div>
                    <div class="col">
                        <label for="day">No of day</label>
                        <input type="text" readonly name="days" id="reserv_numDay" class="form-control">
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="" class="form-control" placeholder="Name....">
                    </div>
                    <div class="col">
                        <label for="forPhone">Phone Number</label>
                        <input type="number" name="phone" id="" class="form-control">
                    </div>
                </div>
                <input type="hidden" name="guest_month" value="{{$mon}}">
                <input type="hidden" name="guest_year" value="{{$year}}">
                <input type="hidden" id="contron_checkin" name="contron" value="checkin">
                <input type="submit" value="Reserv" class="mt-3 btn btn-outline btn-outline-info">
                <input type="button" onclick="hideReserv()" value="Cancel"
                       class="mt-3 btn btn-outline btn-outline-warning">
            </form>
        </div>
    </div>
</div>
<script>
    function hideReserv() {
        $('#reservation_form').hide();
    }

</script>
</body>

</html>