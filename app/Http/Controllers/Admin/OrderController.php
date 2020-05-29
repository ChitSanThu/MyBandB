<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {

    }

    public function showCat()
    {
        $cats = DB::table('categories')->select()->get();
        return view('backend.order.create_categories', compact('cats'));
    }

    public function storeCat(Request $request)
    {
        $this->validate($request, [
            'categories' => 'required',
        ]);
        DB::table('categories')->insert([
            'cat_name' => $request->get('categories')
        ]);
        return redirect('admin/create/categories')->with('status', "ထည့်သွင်းမှုအောင်မြင်ပါသည်");
    }

    public function deleteCat($id)
    {
        DB::table('categories')->where('id', '=', $id)->delete();
        return redirect('admin/create/categories')->with('status', "အောင်မြင်စွာဖျက်ပြီးပါပြီ");

    }

    public function showOrderForm()
    {
        $cats = DB::table('categories')->select()->get();
        return view('backend.order.create_order_item', compact('cats'));

    }

    public function storeOrder(Request $request)
    {
        $this->validate($request, [
            'item' => 'required',
            'price' => 'required',
            'categories' => 'required',
        ]);
        DB::table('order_items')->insert([
            'item' => $request->get('item'),
            'price' => $request->get('price'),
            'categories' => $request->get('categories')
        ]);
        return redirect('admin/create/order')->with('status', "ထည့်သွင်းမှုအောင်မြင်ပါသည်");
    }

    public function orderStore(Request $request)
    {
        $this->validate($request, [
            'order_id' => 'required',
            'order_items' => 'required',
            'order_method'=>'required',
        ]);
//        return "<pre>".print_r($request->all(),true)."</pre>";
        foreach ($request->get('order_items') as $order) {
            $item = explode(',', $order);
            DB::table('guest_orders')->insert([
                "guest_id" => $request->get('order_id'),
                "item_name" => $item[0],
                "price" => $item[1],
                "qty" => $item[2],
                "type"=>$request->get("order_method"),
                "created_at" => date("Y-m-d"),
            ]);
        }
        return redirect('user/frontdesk');
    }

    public function searchItem($name)
    {
        $output = "<option>ကုန်ပစ္စည်းရွေးရန်</option>";
        $result = DB::table('order_items')->where([['categories', '=', $name]])->get();
        if ($result) {
            foreach ($result as $item) {
                $output .= "<option value='$item->id' id='toget' title='$item->item'>$item->item</option>";
            }
            echo $output;
        }
    }

    public function searchPrice($id)
    {
//        echo $id;
        $result = DB::table('order_items')->where([['id', '=', $id]])->get();
        echo $result[0]->price;

    }

    public function changeToName($name)
    {
        $result = DB::table('order_items')->where([['id', '=', $name]])->get();
        return $result[0]->item;

    }
}
