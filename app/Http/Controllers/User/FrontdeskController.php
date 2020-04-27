<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;
use App\RoomType;
use App\CheckIn;
use App\Record;
use App\Invoice;
use App\Http\Requests\InvoiceFormRequest;


class FrontdeskController extends Controller
{

    function index($num_of_day = 5)
    {

        $record = Record::all()->first();

        $guests = CheckIn::all();
        $rooms = Room::all();
        $roomtypes = RoomType::all();

        if (isset($_GET['guest'])) {
            $guest_state = $_GET['guest'];
            $id = $_GET['id'];
            $number = $_GET['roomnum'];
            switch ($guest_state) {
                case 'checkout':
                    {
                        $state = 2;
                        $rooms = Room::where('roomumber', $number)->first();
                        $rooms->room_state = $state;
                        $rooms->save();
                    }
                    break;
                default:
                    $state = 3;
            }
            $this->guestState($id, $state);

            return redirect("/5");
        }
        if (isset($_GET['room'])) {
            $room_state = $_GET['room'];
            $number = $_GET['number'];
            switch ($room_state) {
                case "clean":
                    $state = 1;
                    break;
                case "dirty":
                    $state = 2;
                    break;
                case "modify":
                    $state = 3;
                    break;
                case "close":
                    $state = 4;
                    break;
                default:
                    "something was wrong";
            }
            $rooms = Room::where('roomumber', $number)->first();
            $rooms->room_state = $state;
            $rooms->save();
            return redirect("/5");

        }
        if (isset($_GET['decrease'])) {
            $id = $_GET['decrease'];
            $record = Record::find($id);

            if ($record->month > 1) {
                $record->month -= 1;
                $record->save();
            } else {
                $record->year -= 1;
                $record->month = 12;
                $record->save();
            }
            return redirect('/5');
        }
        if (isset($_GET['increase'])) {
            $id = $_GET['increase'];
            $record = Record::find($id);
            if ($record->month == 12) {
                $record->year += 1;
                $record->month = 1;
                $record->save();
            } else {
                $record->month += 1;
                $record->save();
            }

            return redirect('/5');
        }
        if (isset($_GET['current'])) {
            $id = $_GET['current'];
            $record = Record::find($id);
            $record->month = date("m");
            $record->year = date("Y");
            $record->save();
            return redirect("/5");
        }

        $mon = $record->month;
        $year = $record->year;
        $month_name = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $dayName = [1 => 'Su', 2 => 'Mo', 3 => 'Tu', 4 => 'We', 5 => 'Th', 6 => 'Fr', 7 => 'Sa'];
        $days_of_month = cal_days_in_month(CAL_GREGORIAN, $mon, $year);
        if ($num_of_day == 5) {
            $num_of_day = $days_of_month;
            $startDay = 1;
        } else {
            $startDay = date("d");
        }

        $firstDay = substr(date("l", mktime(5, 5, 5, $mon, $startDay, $year)), 0, 2);
        $invoice=Invoice::all()->first();
        return view('frontdesk.index',
            compact("invoice","month_name", "days_of_month", "startDay", "guests", "rooms", 'roomtypes', 'mon', 'year', 'num_of_day', 'dayName', 'firstDay'));
    }


    function store(Request $request)
    {
        if ($request->get('contron') == 'checkin') {


            $nrc = $request->get('nrctype') . $request->get('nrc') . $request->get('nrcno');

            $days = $request->get('days');


            $days = explode("-", $days);


            CheckIn::create([
                'start_day' => $days[0],
                'end_day' => $days[1],
                'room_number' => $request->get('roomNum'),
                'days' => $days,
                'name' => preg_replace("/(\s+)/","",$request->get('name')),
                'father_name' => $request->get('fname'),
                'phone' => $request->get('phone'),
                'nrc' => $nrc,
                'gender' => $request->get('gender'),
                'age' => $request->get('age'),
                'nation' => $request->get('nation'),
                'job' => $request->get('job'),
                'address' => $request->get('address'),
                'state' => $request->get('state'),
                'guest_status' => $request->get('status'),
                'month'=>$request->get('guest_month'),
                'year'=>$request->get('guest_year')
            ]);
            return redirect('/5')->with('checkin', "success");
        } else {
            $nrc = $request->get('nrctype') . $request->get('nrc') . $request->get('nrcno');
            $guests = CheckIn::find($request->get('guest_id'));
            $guests->father_name = $request->get('fname');
            $guests->nrc = $nrc;
            $guests->gender = $request->get('gender');
            $guests->age = $request->get('age');
            $guests->nation = $request->get('nation');
            $guests->job = $request->get('job');
            $guests->address = $request->get('address');
            $guests->state = $request->get('state');
            $guests->guest_status = $request->get('status');
            $guests->save();
            return redirect('/5');
        }

    }

    function print_daily_guest()
    {
        $guests = CheckIn::all();
        return view('frontdesk.print_daily_guest', compact('guests'));
    }

    function guestState($id, $status)
    {
        $guest_state = CheckIn::find($id);
        $guest_state->guest_status = $status;
        $guest_state->save();
    }

    function roomState($num, $status)
    {
        $room_state = Room::find($num);
        $room_state->room_state = $status;
        $room_state->save();
    }
    public function invoice(){
        $invoice=Invoice::all()->first();
        return view('invoice',compact('invoice'));
    }
    public function logoStore($id,InvoiceFormRequest $request){
        $logo=$request->file('logo');
        $invoice=Invoice::find($id);
        $invoice->title=$request->get('hotel_name');
        $invoice->address=$request->get('hotel_address');
        $invoice->phone=$request->get('hotel_phone');
        $invoice->logo=$logo->getClientOriginalName();
        $invoice->tax=$request->get('tax');
        $invoice->save();
        
        $logo->move(public_path().'/logo/',$logo->getClientOriginalName());
        return redirect('/invoice/1/edit');
    }
    public function invoicePrint(Request $request){
        $guests=CheckIn::find($request->get('invoice_id'));
        $invoice=Invoice::all()->first();
        $cost=$request->get('payment_cost');
        $discount=$request->get('discount');
        $tax=$request->get('tax');
        $total=$request->get('total');
        $room_type=$request->get('room_type');
        $room_cost=$request->get('room_cost');
        return view('frontdesk.invoice_print',
        compact('guests','invoice','cost','discount','tax','total','room_type','room_cost'));
    }
}

