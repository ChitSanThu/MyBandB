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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        // echo "<pre>".print_r($front_id,true)."</pre>";//test for number of frontdesk
        // exit();
       $id=0;
       $fid=0;
        if(isset($_GET['sent'])){
             $id=$_GET['sent'];
            
            Auth::user()->unreadNotifications->markAsRead();
            $user=User::find($_GET['sent']);
            $user->notify(new FrontdeskNotification(Auth::user()));
            return redirect('/housekeeping/index');
        }
        // echo $id;
        // exit();
        if(isset($_GET['room-num'])){
            // echo $id;
            // exit();
                $this->updateRoom($_GET['room-num'],0);
                $user=User::find(session('auth_id'));
                $user->notify(new HousekeeperCommentNoti(Auth::user(),["clean",$_GET['room-num']]));
                return redirect('housekeeping/index');
        }
        return view('housekeeping.housekeeping',compact('rooms','notis'));
    }

    function updateRoom($number, $state)
    {
        $rooms = Room::where('roomumber', $number)->first();
        $rooms->room_state = $state;
        $rooms->save();
        // die("i am work");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Housekeeping  $housekeeping
     * @return \Illuminate\Http\Response
     */
    public function show(Housekeeping $housekeeping)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Housekeeping  $housekeeping
     * @return \Illuminate\Http\Response
     */
    public function edit(Housekeeping $housekeeping)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Housekeeping  $housekeeping
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Housekeeping $housekeeping)
    {
        // return $request->all();
        // exit();
        $user=User::find(session("auth_id"));
        $user->notify(new HousekeeperCommentNoti(Auth::user(),
        [$request->get('housekeeper-comment'),$request->get('number')]));
        return redirect('/housekeeping/index')->with(["success"=>"အောင်မြင်စွာအကြောင်းပြီးပါပြီ"]);
        // return $request->get('hidden_room');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Housekeeping  $housekeeping
     * @return \Illuminate\Http\Response
     */
    public function destroy(Housekeeping $housekeeping)
    {
        //
    }
}
