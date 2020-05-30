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

    public function index()
    {
        $order_gp=DB::table('categories')->select()->get();
        $record = Record::all()->first();
        $nrc_type = DB::table('nrctype')->select('nrc_type')->get();
        $guests = CheckIn::all();
        $rooms = Room::all();
        $roomtypes = RoomType::all();
        $dept = DeptRecord::all();
        $mon = $record->month;
        $year = $record->year;
        $month_name = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $dayName = [1 => 'Su', 2 => 'Mo', 3 => 'Tu', 4 => 'We', 5 => 'Th', 6 => 'Fr', 7 => 'Sa'];
        $days_of_month = cal_days_in_month(CAL_GREGORIAN, $mon, $year);
        $num_of_day = $days_of_month;
        $startDay = 1;
        $firstDay = substr(date("l", mktime(5, 5, 5, $mon, $startDay, $year)), 0, 2);
        $invoice = Invoice::all()->first();
        $guest_info = $this->deptInfo(1); //for dept guest 
        $record = Record::all()->first();
        return view(
            'frontdesk.index',
            compact("order_gp","nrc_type", "record", "guest_info", "dept", "invoice", "month_name", "days_of_month", "startDay", "guests", "rooms", 'roomtypes', 'mon', 'year', 'num_of_day', 'dayName', 'firstDay')
        );
    }
    public function store(Request $request)
    {
        if ($request->get('contron') == 'checkin') {
            $nrc = $request->get('nrctype') . $request->get('nrc') . $request->get('nrcno');
            $days = $request->get('days');
            $days = explode("-", $days);
            $move_guestss=CheckIn::where('guest_status',8)->where('room_number',$request->get('roomNum'))->whereBetween('end_day', [$days[0],$days[1]])->get();
            if(empty($move_guestss)){
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
            }else{
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
                foreach ($move_guestss as $move_guests){
                    DB::table('move_guests')->insert([
                        'start_day' => $move_guests->start_day,
                        'end_day' => $move_guests->end_day,
                        'room_number' => $move_guests->room_number,
                        'name' => $move_guests->name,
                        'father_name' => $move_guests->father_name,
                        'phone' => $move_guests->phone,
                        'nrc' => $move_guests->nrc,
                        'gender' => $move_guests->gender,
                        'age' => $move_guests->age,
                        'nation' => $move_guests->nation,
                        'job' => $move_guests->job,
                        'address' => $move_guests->address,
                        'state' => $move_guests->state,
                        'guest_status' => $move_guests->guest_status,
                        'month' => $move_guests->month,
                        'year' => $move_guests->year
                    ]);
                }

                CheckIn::where('guest_status',8)->where('room_number',$request->get('roomNum'))
                    ->whereBetween('end_day', [$days[0],$days[1]])->delete();
            }
            if ($nrc != "")
                $this->updateRoomState($request->get('roomNum'), 1);
            return $this->returnFrontdesk();
        } else {

            if (true)
                $this->updateRoomState($request->get('roomNum'), 1);
            $nrc = $request->get('nrctype') . $request->get('nrc') . $request->get('nrcno');
//            $nrcs_tp = DB::table('nrctype')->select('nrc_type')->get();
//            foreach ($nrcs_tp as $nrc) {
//                if ($nrc != $request->get('nrctype'))
//                    DB::table('nrctype')->insert(["nrc_type" => $request->get('nrctype')]);
//            }
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
            return $this->returnFrontdesk();
        }
    }
    public function updateRoomState($number, $state)
    {
        $rooms = Room::where('roomumber', $number)->first();
        $rooms->room_state = $state;
        $rooms->save();
    }
    public function guestState($id, $status)
    {
        $guest_state = CheckIn::find($id);
        $guest_state->guest_status = $status;
        $guest_state->save();
    }
    public function invoice()
    {
        $invoice = Invoice::all()->first();
        return view('invoice', compact('invoice'));
    }
    public function report()
    {
        $order_earn=DB::table('guest_orders')->where('type','=','0')->whereBetween('created_at', [date('Y-m-d 00:00:00'), date('Y-m-d 23:59:59')])->get();
//        return $order_earn;
        $reports = Report::whereBetween('created_at', [date('Y-m-d 00:00:00'), date('Y-m-d 23:59:59')])->get();

        $guest_info = $this->deptInfo(0);
            $debt_guests = $this->deptInfo(1);
            return view('frontdesk.report', compact('order_earn','guest_info', 'debt_guests', 'reports'));
    }
    public function reportMethod($start,$end){
            $reports = Report::whereBetween('created_at', [$start, $end. " 23:59:59"])->get();
            $guest_info = $this->deptInfo(0, [$start, $end]);
            $debt_guests = $this->deptInfo(1, [$start, $end]);
        $order_earn=DB::table('guest_orders')->where('type','=','0')->whereBetween('created_at', [$start, $end.' 23:59:59'])->get();

            return redirect('/user/report/frontdesk')
                ->with([
                    'date_range' => [$start, $end], 'guest_info' => $guest_info,
                    'debt_guests' => $debt_guests, "reports" => $reports,
                    'order_earn'=>$order_earn
                ]);
    }
    public function deptInfo($status, $range = 0)
    {
        if ($range == 0)
            $dept = DeptRecord::where('status', $status)
                ->whereBetween('created_at', [date('Y-m-d 00:00:00'), date('Y-m-d 23:59:59')])->get();
        else
            $dept = DeptRecord::where('status', $status)
                ->whereBetween('created_at', [$range[0], $range[1]. " 23:59:59"])->get();
//        return print_r($dept);
            $guest_info = array();
            $order_total=0;
            foreach ($dept as $guest) {
                $guests = CheckIn::findOrFail($guest->guest_id);
                $orders=DB::table('guest_orders')->where('guest_id','=',$guest->guest_id)->get();
                foreach ($orders as $order)
                    $order_total+=$order->price*$order->qty;
                $date = $guest->created_at;
                array_push($guest_info, array(
                    "guest_id" => $guests->id,
                    "guest_name" => $guests->name,
                    "nrc_no" => $guests->nrc,
                    "name" => $guests->room_number,
                    "total" => $guest->total,
                    "comment" => $guest->comment,
                    "order" =>$order_total,
                    "date" => date('d/m/Y h:i:s a', strtotime($date))
                ));
            }
            return $guest_info;
    }
    public function sentNotification($id, $number)
    {
        $user = User::find($id);
        $user->notify(new HousekeepingNotification($number));
    }
    public function search()
    {
        if(isset($_GET['q'])) {
            $q = $_GET['q'];
            $output = "";
//            $product->guest_id
            $nrc_search = DB::table('dept_records')
                ->where([['status','=','1'], ['nrc_no', 'LIKE', '%' . $q . "%"]])->get();
            if ($nrc_search) {
                foreach ($nrc_search as $key => $product) {
                    $output .= '<tr>' .
                        '<td>' . $product->id . '</td>' .
                        '<td>' . $product->name . '</td>' .
                        '<td>' . $product->total . '</td>' .
                        '<td>' . $product->comment . '</td>' .

                        '<td>' . $product->created_at . '</td>' .
                        '<td>' . '<a href="'.url('user/debt').'/'.$product->guest_id.'" class="btn btn-sm btn-info">ငွေရှင်းပြီး</a></td>' .

                        '</tr>';
                }
            }
            $name_search = DB::table('dept_records')
                ->where([['status','=','1'], ['name', 'LIKE', '%' . $q . "%"]])->get();
            if ($name_search) {
                foreach ($name_search as $key => $product) {
                    $output .= '<tr>' .
                        '<td>' . $product->id . '</td>' .
                        '<td>' . $product->name . '</td>' .
                        '<td>' . $product->total . '</td>' .
                        '<td>' . $product->comment . '</td>' .

                        '<td>' . $product->created_at . '</td>' .
                        '<td>' . '<a href="'.url('user/debt').'/'.$product->guest_id.'" class="btn btn-sm btn-info">ငွေရှင်းပြီး</a></td>' .

                        '</tr>';
                }
            }
            echo $output;
        }
    }
    public function cancleGuest($id,$number){
        DB::table('check_ins')->where('id', '=', $id)->delete();
        return $this->returnFrontdesk();

    }
    public function checkoutGuest($id,$number){
        $rooms = Room::where('roomumber', $number)->first();
        $rooms->room_state = 2;
        $rooms->save();
        $this->guestState($id, 2);
        return $this->returnFrontdesk();
    }
    public function recheckinGuest($id,$number){
        $this->guestState($id, 8);
        return $this->returnFrontdesk();
    }
    public function guestStateChange($state,$id,$number){
            switch ($state) {
                case 'checkout':
                    {
                        $rooms = Room::where('roomumber', $number)->first();
                        $rooms->room_state = 2;
                        $rooms->save();
                        $this->guestState($id, 2);
                    }
                    break;
                case 'cancleguest':
                    DB::table('check_ins')->where('id', '=', $id)->delete();
                    break;
            }
            return $this->returnFrontdesk();
    }
    public function roomStateChange($room_state,$number){
        $state=null;
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
            return $this->returnFrontdesk();
    }
    public function month($state){
        $record = Record::find(1);

        if($state=="decrease"){
            if ($record->month > 1) {
                $record->month -= 1;
                $record->save();
            } else {
                $record->year -= 1;
                $record->month = 12;
                $record->save();
            }
        }else if($state=="increase"){
            if ($record->month == 12) {
                $record->year += 1;
                $record->month = 1;
                $record->save();
            } else {
                $record->month += 1;
                $record->save();
            }

        }else{
            $record->month = date("m");
            $record->year = date("Y");
            $record->save();
        }
        return $this->returnFrontdesk();
    }
    public function housekeeping($user_id,$number,$auth_id){
            $this->sentNotification($user_id, [$number, $auth_id]);
            $this->updateRoomState($number, 3);
            return $this->returnFrontdesk();
    }
    public function paymentDebt($id){
            $user = DeptRecord::where('guest_id', $id)->first();
            $user->status = 0;
            $user->created_at=date("Y-m-d h:i:s");
            $user->save();
            $this->guestState($id,2);
            return $this->returnFrontdesk();
    }
    public function guestComment($create_at){
        $user = User::find(Auth::user()->id);
        $user->notifications()->where('created_at', $create_at)->delete();
        return $this->returnFrontdesk();
    }
    public function sentNotiFrontdesk($id){
            foreach (Auth::user()->unreadNotifications as $noti)
                if ($noti->data['housekeeper']['id'] == $id)
                    $noti->markAsRead();
            return $this->returnFrontdesk();
    }
    public function roomState($num, $status)
    {
        $room_state = Room::find($num);
        $room_state->room_state = $status;
        $room_state->save();
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
        $room_type = $request->get('payment_room');
        $room_cost = $request->get('room_cost');
        $status = $request->get('payment_method');
        // $this->guestState($guest_id,);
        $order=DB::table('guest_orders')->select()->where('guest_id','=',$guest_id)
            ->where('type','=','1')->get();
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
//        return $order;
        return view(
            'frontdesk.invoice_print',
            compact('order','guests', 'invoice', 'cost', 'discount', 'tax', 'total', 'room_type', 'room_cost')
        );
    }
    public function reportStore(Request $request)
    {
        $this->validate($request, [
            'report_name' => 'required',
            'report_price' => 'required',
            'report_type'=>'required',
        ]);

        Report::create([
            "content" => $request->get("report_name"),
            "price" => $request->get('report_price'),
            "type"=>$request->get('report_type'),
        ]);

        return redirect("/user/report/frontdesk");
    }
    public function returnFrontdesk(){
        return redirect('user/frontdesk');
    }
    public function showGuest($id){
        $guest=CheckIn::findOrFail($id);
        return view('frontdesk.single_guest',compact("guest"));
    }
    public function findGuest(){
        if(isset($_GET['q'])) {
            $q = $_GET['q'];
            $output = "";
            $count=0;
            $nrc_search = DB::table('check_ins')
                ->where('nrc', 'LIKE', '%' . $q . "%")->get();
            if ($nrc_search) {
                foreach ($nrc_search as $key => $guest) {
                    $output .=  '<tr>'.
                        '<td>' . ++$count . '</td>' .
                        '<td>' . $guest->room_number . '</td>' .
                        '<td>' . $guest->start_day.'/'.$guest->month.'/'. $guest->year . ' မှ ' . $guest->end_day.'/'.$guest->month.'/'. $guest->year .' ထိ'. '</td>' .
                        '<td>' . $guest->name . '</td>' .
                        '<td>' . $guest->phone . '</td>' .
                        '<td>' . $guest->nrc . '</td>' .
                        '<td>' . $guest->address . '</td>' .
                        '<td>' . '<a href="'.url('user/frontdesk/show').'/'.$guest->id.'" class="btn btn-sm btn-info">ကြည့်ရန်</a></td>' .
                        '</tr>';
                }
            }
            $name_search = DB::table('check_ins')
                ->where('name', 'LIKE', '%' . $q . "%")->get();
            if ($name_search) {
                foreach ($name_search as $key => $guest) {
                    $output .=  '<tr>' .
                        '<td>' . ++$count . '</td>' .
                        '<td>' . $guest->room_number . '</td>' .
                        '<td>' . $guest->start_day.'/'.$guest->month.'/'. $guest->year . ' မှ ' . $guest->end_day.'/'.$guest->month.'/'. $guest->year .' ထိ' . '</td>' .
                        '<td>' . $guest->name . '</td>' .
                        '<td>' . $guest->phone . '</td>' .
                        '<td>' . $guest->nrc . '</td>' .
                        '<td>' . $guest->address . '</td>' .
                        '<td>' . '<a href="'.url('user/frontdesk/show').'/'.$guest->id.'" class="btn btn-sm btn-info">ကြည့်ရန်</a></td>' .
                        '</tr>';
                }
            }
            echo $output;
        }

    }
    public function storeGuest(){

    }
}
