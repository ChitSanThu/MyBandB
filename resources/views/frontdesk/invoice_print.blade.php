@extends('layout.master')
@section('content')
<div class="col-md-8 card card-body  PrintArea area1" style="background-color:lighcyan;width:800px;margin:0 auto;">
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
            <th scope="col" class="amount text-center" style="border:1px solid black;">Amount</th>
        </tr>
        </thead>
        <tbody>
            @php($day=1)
            @for ($i = $guests->start_day; $i <= $guests->end_day; $i++)
                <tr style="border:1px solid black;">
                    <th scope="row" class="text-center" style="border:1px solid black;">{{$day}}</th>
                    <td style="border:1px solid black;">{{$i}}/{{$guests->month}}/{{$guests->year}}</td>
                    <td style="border:1px solid black;">{{$room_type}}</td>
                    <td class="text-right" style="border:1px solid black;">{{$room_cost}}</td>
                </tr>
                @php($day++)
            @endfor
        
        
        <tr>
            <td colspan="3" class="text-right table-bordered-less">Total</td>
            <td class="text-right" style="border:1px solid black;">{{$cost}}</td>
        </tr>
        <tr>
            <td colspan="3" class="text-right table-bordered-less">Discount</td>
            <td class="text-right" style="border:1px solid black;">{{$discount}}</td>
        </tr>
        <tr>
            <td colspan="3" class="text-right table-bordered-less">Tax</td>
        <td class="text-right" id="tax_col" style="border:1px solid black;">{{$tax}}</td>
        </tr>
        <tr>
            <td colspan="3" class="text-right table-bordered-less">Total Balance</td>
        <td class="text-right" style="border:1px solid black;">{{$total}}</td>
        </tr>
        </tbody>
    </table>
   
</div>
<a href="{{url('user/frontdesk')}}" class="btn btn-warning ml-3" style="float:right">Cancle</a>
<div onclick="$( ' div.PrintArea.area1' ).printArea();" style="float:right" class="btn  btn-info">
    Print
</div>
@endsection