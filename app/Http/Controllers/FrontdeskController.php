<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;
use App\RoomType;
use App\CheckIn;
use App\Record;
use App\Invoice;
use App\DeptRecord;
use App\Report;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\InvoiceFormRequest;
use App\Notifications\HousekeepingNotification;

class FrontdeskController extends Controller
{

    function index($num_of_day = 5,Request $request)
    {


        $record = Record::all()->first();
        $nrc_type = DB::table('nrctype')->select('nrc_type')->get();
        $guests = CheckIn::all();
        $rooms = Room::all();
        $roomtypes = RoomType::all();
        $dept = DeptRecord::all();
        if (isset($_GET['guest'])) {
            $guest_state = $_GET['guest'];
            $id = $_GET['id'];
            $number = $_GET['roomnum'];
            switch ($guest_state) {
                case 'checkout': {
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

            return redirect("/user/5");
        }
        if (isset($_GET['room'])) {
            $room_state = $_GET['room'];
            $number = $_GET['number'];
            switch ($room_state) {

                case "checkin":
                    $state = 1;
                    break;
                case "checkout":
                    $state = 2;
                    break;
                case "housekeeping":
                    $state = 3;
                    break;
                case "outofservice":
                    $state = 4;
                    break;
                case "idel":
                    $state = 0;
                    break;
                case "reserv":
                    $state = 5;
                    break;
                default:
                    "something was wrong";
            }
            $this->updateRoomState($number, $state);

            return redirect("/user/5");
        }
        if ($request->get('decrease')) {
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
            return redirect('/user/5');
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

            return redirect('/user/5');
        }
        if (isset($_GET['current'])) {
            $id = $_GET['current'];
            $record = Record::find($id);
            $record->month = date("m");
            $record->year = date("Y");
            $record->save();
            return redirect("/user/5");
        }
        if(isset($_GET['cancleguest'])){
            DB::table('check_ins')->where('id', '=', $_GET['id'])->delete();
            // DB::table('check_ins')->truncate();
            return redirect('user/5');
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
        $invoice = Invoice::all()->first();
        $guest_info = $this->deptInfo(1); //for dept guest 
        $record = Record::all()->first();
        if (isset($_GET['userid'])) {
            $this->sentNotification($_GET['userid'], [$_GET['number'], $_GET['auth']]);
            $this->updateRoomState($_GET['number'], 3);
            return redirect('/user/5');
        }
        // for debt payment
        if (isset($_GET['debt'])) {
            $user = DeptRecord::where('guest_id', $_GET['debt'])->first();
            $user->status = 0;
            $user->save();
            return redirect('/user/5');
        }
        // for guest comment
        if (isset($_GET['guest_comment'])) {
            // $this->deleteNotification($_GET['guest_comment']);
            return redirect('/user/5')->with(['guestnoti'=>"show"]);
        }

        // for notification 
        if (isset($_GET['noti'])) {
            foreach (Auth::user()->unreadNotifications as $noti) {
                if ($noti->data['housekeeper']['id'] == $_GET['noti'])
                    $noti->markAsRead();
            }

            return redirect('user/5');
        }

        return view(
            'frontdesk.index',
            compact("nrc_type","record", "guest_info", "dept", "invoice", "month_name", "days_of_month", "startDay", "guests", "rooms", 'roomtypes', 'mon', 'year', 'num_of_day', 'dayName', 'firstDay')
        );
    }

    function store(Request $request)
    {
        if ($request->get('contron') == 'checkin') {

            // $this->updateRoomState($request->get('roomNum'), 1);
            $nrcs_tp = DB::table('nrctype')->where('nrc_type','=',$request->get('nrctype'))->get();
            
                if(!$nrcs_tp)
                    DB::table('nrctype')->insert(["nrc_type"=>$request->get('nrctype')]);
            
            $nrc = $request->get('nrctype') . $request->get('nrc') . $request->get('nrcno');

            $days = $request->get('days');


            $days = explode("-", $days);


            CheckIn::create([
                'start_day' => $days[0],
                'end_day' => $days[1],
                'room_number' => $request->get('roomNum'),
                'days' => $days,
                'name' => preg_replace("/(\s+)/", "", $request->get('name')),
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
                'month' => $request->get('guest_month'),
                'year' => $request->get('guest_year')
            ]);
            if ($nrc != "")
                $this->updateRoomState($request->get('roomNum'), 1);
            // else
            //     $this->updateRoomState($request->get('roomNum'), 1);
            // $this->sendSlackNotification("Hi! Admin\nNew article posted for review\nTitle: ");
            return redirect('/user/5')->with('checkin', "success");
        } else {

            if (true)
                $this->updateRoomState($request->get('roomNum'), 1);
            $nrc = $request->get('nrctype') . $request->get('nrc') . $request->get('nrcno');
            $nrcs_tp = DB::table('nrctype')->select('nrc_type')->get();
            foreach($nrcs_tp as $nrc){
                if($nrc!=$_GET['nrctype'])
                    DB::table('nrctype')->insert(["nrc_type"=>$request->get('nrctype')]);
            }
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

            return redirect('/user/5');
        }
    }
    function updateRoomState($number, $state)
    {
        $rooms = Room::where('roomumber', $number)->first();
        $rooms->room_state = $state;
        $rooms->save();
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
    public function invoice()
    {
        $invoice = Invoice::all()->first();
        return view('invoice', compact('invoice'));
    }
    public function logoStore($id, InvoiceFormRequest $request)
    {
        $logo = $request->file('logo');
        $invoice = Invoice::find($id);
        $invoice->title = $request->get('hotel_name');
        $invoice->address = $request->get('hotel_address');
        $invoice->phone = $request->get('hotel_phone');
        $invoice->logo = $logo->getClientOriginalName();
        $invoice->tax = $request->get('tax');
        $invoice->save();

        $logo->move(public_path() . '/logo/', $logo->getClientOriginalName());
        return redirect('/user/invoice/1/edit');
    }
    public function invoicePrint(Request $request)
    {

        $guest_id = $request->get('invoice_id');
        $guests = CheckIn::find($guest_id);
        $invoice = Invoice::all()->first();
        $cost = $request->get('payment_cost');
        $discount = $request->get('discount');
        $tax = $request->get('tax');
        $total = $request->get('total');
        $room_type = $request->get('room_type');
        $room_cost = $request->get('room_cost');
        $status = $request->get('payment_method');
        // $this->guestState($guest_id,);

        $dept = DeptRecord::create([
            'guest_id' => $guest_id,
            'name' => $guests->name,
            'nrc_no' => $guests->nrc,
            'total' => $total,
            'comment' => $request->get('comment'),
            'status' => $status
        ]);
        if ($status == 1) {
            $this->guestState($guest_id, 5);
        } else
            $this->guestState($guest_id, 4);

        return view(
            'frontdesk.invoice_print',
            compact('guests', 'invoice', 'cost', 'discount', 'tax', 'total', 'room_type', 'room_cost')
        );
    }
    public function report()
    {
        $reports = Report::all();

        if (isset($_GET['sreport'])) {
            $reports = DB::table('reports')
                ->whereBetween('created_at', [$_GET['sreport'], $_GET['ereport']." 23:59:59"])
                ->get();
            $guest_info = $this->deptInfo(0, [$_GET['sreport'], $_GET['ereport']]);
            $debt_guests = $this->deptInfo(1, [$_GET['sreport'], $_GET['ereport']]);

            return redirect('/user/report/frontdesk')
                ->with([
                    'date_range' => [$_GET['sreport'], $_GET['ereport']], 'guest_info' => $guest_info,
                    'debt_guests' => $debt_guests, "reports" => $reports
                ]);
        }
        else {
            $guest_info = $this->deptInfo(0);
            $debt_guests = $this->deptInfo(1);
            return view('frontdesk.report', compact('guest_info', 'debt_guests', 'reports'));
        }
    }
    public function reportStore(Request $request)
    {
        $this->validate($request, [
            'report_name' => 'required',
            'report_price' => 'required',
        ]);

        Report::create([
            "content" => $request->get("report_name"),
            "price" => $request->get('report_price')
        ]);

        return redirect("/user/report/frontdesk");
    }
    public function deptInfo($status, $range = 0)
    {
        if ($range == 0)

            $dept = DeptRecord::where('status', $status)->get();
        else
            $dept = DeptRecord::where('status', $status)
                ->whereBetween('created_at', [$range[0], $range[1]])->get();

        $guest_info = array();


        foreach ($dept as $guest) {

            $guests = CheckIn::find($guest->guest_id);
            $date =  $guest->created_at;

            array_push($guest_info, array(
                "guest_id" => $guests->id,
                "guest_name" => $guests->name,
                "nrc_no" => $guests->nrc,
                "name" => $guests->room_number,
                "total" => $guest->total,
                "comment" => $guest->comment,
                "date" => date('d/m/Y h:i:s a',strtotime($date))
            ));
        }


        return $guest_info;
    }
    public function sentNotification($id, $number)
    {
        $user = User::find($id);
        $user->notify(new HousekeepingNotification($number));
    }
    public function deleteNotification($where)
    {
        $user = User::find(Auth::user()->id);
        $user->notifications()->where('created_at', $where)->delete();
    }

    public function search(Request $request)
    {
        // get the q parameter from URL
        if ($_GET["q"]) {
            $q = $_GET["q"];

            $output = "";

            $nrc_search = DB::table('dept_records')->where('nrc_no', 'LIKE', '%' . $q . "%")->get();
            if ($nrc_search) {
                foreach ($nrc_search as $key => $product) {
                    $output .= '<tr>' .
                        '<td>' . $product->id . '</td>' .
                        '<td>' . $product->name . '</td>' .
                        '<td>' . $product->total . '</td>' .
                        '<td>' . $product->comment . '</td>' .

                        '<td>' . $product->created_at . '</td>' .
                        '<td>' . '<a href="{{url(' . 'user/5?debt=' . $product->guest_id . ')}}" class=
                    "btn btn-sm btn-info">ငွေရှင်းပြီး</a></td>' .

                        '</tr>';
                }
            }

            $products = DB::table('dept_records')->where('name', 'LIKE', '%' . $q . "%")->get();
            if ($products) {
                foreach ($products as $key => $product) {
                    $output .= '<tr>' .
                        '<td>' . $product->id . '</td>' .
                        '<td>' . $product->name . '</td>' .
                        '<td>' . $product->total . '</td>' .
                        '<td>' . $product->comment . '</td>' .

                        '<td>' . date('d/m/Y h:i:s a',strtotime($product->created_at)) . '</td>' .
                        '<td>' . '<a href="{{url(' . 'user/5?debt=' . $product->guest_id . ')}}" class=
                    "btn btn-sm btn-info">ငွေရှင်းပြီး</a></td>' .

                        '</tr>';
                }
            }
            echo $output;
        }
    }
}
