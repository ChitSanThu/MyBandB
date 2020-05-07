<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RoomType;
use App\Room;

class RoomOperation extends Controller
{
    function room()
    {
        $types = RoomType::all();
        return view('room_operation.room', compact('types'));
    }

    function storeRoom(Request $request)
    {
        $this->validate($request, [
            'roomNumber' => 'required',
            'roomType' => 'required',
        ]);
        Room::create([
            'roomumber' => $request->get('roomNumber'),
            'roomtype' => preg_replace("/(\s+)/", "", $request->get('roomType'))
        ]);
        return redirect('user/create/rooms')->with("status", $request->get('roomType')." ထဲသို့ အခန်းများ အောင်မြင်စွာ ထည့်သွင်းပြီးပါပြီ");
    }

    function storeRoomType(Request $request)
    {
        $this->validate($request, [
            'price' => 'required',
            'roomType' => 'required',
        ]);
        RoomType::create([

            'roomtype' => $request->get('roomType'),
            'price' => $request->get('price'),
        ]);
        return redirect('user/create/roomtype')->with('status', 'အခန်းအမျိုးအစားနှင့်စျေးနှုန်း အောင်မြင်စွာ ထည့်သွင်းပြီးပါပြီ');
    }
}
