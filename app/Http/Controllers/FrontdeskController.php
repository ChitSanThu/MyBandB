<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;
use App\RoomType;

class FrontdeskController extends Controller
{
    static $month=2;
    static $yr=2020;
    function index($num_of_day = 5)
    {
        $date=new Controller();

        $rooms = Room::all();
        $roomtypes = RoomType::all();

         $mon = $date->getMonth();
         $year = $date->getYear();


        $dayName = [1 => 'Su', 2 => 'Mo', 3 => 'Tu', 4 => 'We', 5 => 'Th', 6 => 'Fr', 7 => 'Sa'];

        if ($num_of_day == 5) {
            $num_of_day = cal_days_in_month(CAL_GREGORIAN, $mon, $year);
            $startDay = 1;
        } else {
            $startDay = date("d");
        }
        $firstDay = substr(date("l", mktime(5, 5, 5, $mon, $startDay, $year)), 0, 2);
        return view('frontdesk.index',
            compact("startDay", "rooms", 'roomtypes', 'mon', 'year', 'num_of_day', 'dayName', 'firstDay'));
    }

    function previous()
    {
        $date=new Controller();
        $date->setter(1);
        $d=new Controller();
        echo $date->getMonth();
        echo $d->getYear();
//        return redirect("/");
    }
}
