@extends('layout.master')
@section('content')
<div class="checkInstatus">
<div class="col-md-8 card card-body   PrintArea area1 " style="background-color:white;width:800px;margin:0 auto;">
<div class="row">
        <div class="col-md-4 mr-5 ">
            <img src="{!! asset("logo/".$invoice->logo) !!}" alt="Logo" class="logo" width="100px" height="100">
        </div>
        <div class="col-md-8 ml-5 " style="position:absolute;justify-content:center;">
            <h6 class="text-center" id="invoice_name" aria-placeholder="">{{$invoice->title}}</h6>
            <h6 class="text-center" id="invoice_address">{{$invoice->address}}</h6>
            <h6 class="text-center" id="invoice_phone">{{$invoice->phone}}</h6>
        </div>
</div>
    <hr>
    <h6 class="text-center">Invoice</h6>
    <p>Guest Name : {{$guests->name}}</p>
    <table class="custom-table">
        <thead>
        <tr style="border:1px solid black;">
            <th scope="col" class="text-center" style="border:1px solid black;">Sr</th>
            <th scope="col" class="text-center" style="border:1px solid black;">Date</th>
            <th scope="col" class="text-center" style="border:1px solid black;">Description</th>
            <th scope="col" class="text-center" style="border:1px solid black;">Price</th>
            <th scope="col" class="text-center" style="border:1px solid black;">Qty</th>

            <th scope="col" class="amount text-center" style="border:1px solid black;">Amount</th>
        </tr>
        </thead>
        <tbody>
            @php($day=0)
            @php($num=$guests->end_day-$guests->start_day+1)
                <tr style="border:1px solid black;">
                    <th scope="row" class="text-center" style="border:1px solid black;">{{++$day}}</th>
                    @if($guests->end_day==$guests->start_day)
                        <td style="border:1px solid black;">{{$guests->start_day}}/{{$guests->month}}/{{$guests->year}}</td>
                    @else
                        <td style="border:1px solid black;">{{$guests->start_day}}/{{$guests->month}}/{{$guests->year}}မှ
                            {{$guests->end_day}}/{{$guests->month}}/{{$guests->year}}</td>
                        @endif

                    <td style="border:1px solid black;">{{$room_type}}</td>
                    <td class="" style="border:1px solid black;">{{$room_cost}}</td>
                    <td class="" style="border:1px solid black;">{{$num}}</td>
                    <td class="text-right" style="border:1px solid black;">{{$num*$room_cost}}</td>
                </tr>
            @php($order_total=0)
        @foreach($order as $item)
            <tr style="border:1px solid black;">
                <th scope="row" class="text-center" style="border:1px solid black;">{{++$day}}</th>
                <td style="border:1px solid black;">{{date('d/m/Y ', strtotime($item->created_at))}}</td>
                <td style="border:1px solid black;">{{$item->item_name}}</td>
                <td style="border:1px solid black;">{{$item->price}}</td>
                <td style="border:1px solid black;">{{$item->qty}}</td>
                <td class="text-right" style="border:1px solid black;">{{$order_total+=$item->price*$item->qty}}</td>
            </tr>
        @endforeach
        
        <tr>
            <td colspan="5" class="text-right table-bordered-less">Total</td>
            <td class="text-right" style="border:1px solid black;">{{$cost+$order_total}}</td>
        </tr>
        <tr>
            <td colspan="5" class="text-right table-bordered-less">Discount</td>
            <td class="text-right" style="border:1px solid black;">{{$discount}}</td>
        </tr>
        <tr>
            <td colspan="5" class="text-right table-bordered-less">Tax</td>
        <td class="text-right" id="tax_col" style="border:1px solid black;">{{$tax}}</td>
        </tr>
        <tr>
            <td colspan="5" class="text-right table-bordered-less">Total Balance</td>
        <td class="text-right" style="border:1px solid black;">{{$total+$order_total}}</td>
        </tr>
        </tbody>
    </table>
   
</div>
<a href="{{url('user/frontdesk')}}" class="btn btn-warning ml-3" style="float:right">ပြန်သွားရန်</a>
<div onclick="$( ' div.PrintArea.area1' ).printArea();" style="float:right" class="btn  btn-info">
    ပြေစာထုတ်ရန်
</div>
</div>
@endsection