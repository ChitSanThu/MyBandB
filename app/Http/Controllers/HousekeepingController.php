<?php

namespace App\Http\Controllers;

use App\Housekeeping;
use App\Notifications\FrontdeskNotification;
use App\Notifications\HousekeeperCommentNoti;
use Illuminate\Http\Request;
use App\Room;
use App\User;
use Illuminate\Support\Facades\Auth;

class HousekeepingController extends Controller
{
    public function index()
    {
        $rooms=Room::all();
        $user=Auth::user();
        $front_id=array(0);
        $notis=$user->unreadnotifications;
        $index=0;
        foreach($notis as $noti){
            $test=$noti->data['auth_id'];
            if($front_id[$index]!=$test){
                array_push($front_id,$noti->data['auth_id']);
                ++$index;
            }     
        }
        return view('housekeeping.housekeeping',compact('rooms','notis'));
    }
    public function housekeepingRoom($number){
            $this->updateRoom($number,0);
            $user=User::find(session('auth_id'));
            $user->notify(new HousekeeperCommentNoti(Auth::user(),["clean",$number]));
            return redirect('housekeeping/index');
    }
    public function updateRoom($number, $state)
    {
        $rooms = Room::where('roomumber', $number)->first();
        $rooms->room_state = $state;
        $rooms->save();
        // die("i am work");
    }
    public function sentNotiHousekeeper($id){
            Auth::user()->unreadNotifications->markAsRead();
            $user=User::find($id);
            $user->notify(new FrontdeskNotification(Auth::user()));
            return redirect('/housekeeping/index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Housekeeping $housekeeping)
    {
        //
    }

    public function edit(Housekeeping $housekeeping)
    {
        //
    }

    public function update(Request $request, Housekeeping $housekeeping)
    {
        // dd($request->all());
        $user=User::find(session("auth_id"));
        $user->notify(new HousekeeperCommentNoti(Auth::user(),
        [$request->get('housekeeper-comment'),$request->get('number')]));
        return redirect('/housekeeping/index')->with(["success"=>"အောင်မြင်စွာအကြောင်းပြီးပါပြီ"]);
    }

    public function destroy(Housekeeping $housekeeping)
    {
        //
    }
}
