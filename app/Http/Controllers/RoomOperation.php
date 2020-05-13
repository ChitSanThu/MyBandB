<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RoomType;
use App\Room;

class RoomOperation extends Controller
{
    public function room()
    {
        $types = RoomType::all();
        return view('room_operation.room', compact('types'));
    }

    public function storeRoom(Request $request)
    {
        $this->validate($request, [
            'roomNumber' => 'required',
            'roomType' => 'required',
        ]);

        if(strpos($request->get('roomNumber'),',')){
            $rooms=explode(',',$request->get('roomNumber'));
            foreach ($rooms as $room){
                Room::create([
                    'roomumber' => $room,
                    'roomtype' => preg_replace("/(\s+)/", "", $request->get('roomType'))
                ]);
            }
            return redirect('user/create/rooms')->with("status", $request->get('roomType')." ထဲသို့ အခန်းများ အောင်မြင်စွာ ထည့်သွင်းပြီးပါပြီ");

        }else{
            Room::create([
                'roomumber' => $request->get('roomNumber'),
                'roomtype' => preg_replace("/(\s+)/", "", $request->get('roomType'))
            ]);
            return redirect('user/create/rooms')->with("status", $request->get('roomType')." ထဲသို့ အခန်းနံပါတ်".$request->get('roomNumber')." အောင်မြင်စွာ ထည့်သွင်းပြီးပါပြီ");
        }
    }

    public function storeRoomType(Request $request)
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

    public function showForDelete(){
        $rooms=Room::paginate(10);
        return view('backend.users.delete_room',compact("rooms"));
    }
    public function deleteRoom($id){
        Room::find($id)->delete();
        return redirect('user/delete/rooms')->with(['room'=>"ဖျက်ပြီးပါပြီ"]);
    }
    public function deleteRooms(Request $rooms){
        if($rooms->get('delete_rooms')==null)
            return redirect('user/delete/rooms')->with(['room_em'=>"အခန်းများဖျက်ရန်ရွေးချယ်ပေးပါ"]);
        else{
            foreach ($rooms->get('delete_rooms') as $id) {
                Room::find($id)->delete();
            }
            return redirect('user/delete/rooms')->with(['room'=>"အခန်းများဖျက်ပြီးပါပြီ"]);

        }

    }
}
