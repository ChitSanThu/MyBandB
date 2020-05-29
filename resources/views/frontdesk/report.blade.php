@extends('layout.reportspecial')
@section('content')
<div class="col-md-12 " style="margin:0 auto">
  <form class="card card-body" method="post">
    @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif
    {{csrf_field()}}
    <input type="hidden" name="report_status" value='2'>
    <div class="row">
      <div class="col-3">
        <input type="text" class="form-control form-control-sm" name="report_name" placeholder="အကြောင်းအရာ" value="{{old('report_name')}}">
      </div>

      <div class="col-2">
        <input type="text" class="form-control form-control-sm" name="report_price" placeholder="စျေးနှုန်း" value="{{old('report_price')}}">
      </div>
      <div class="col-2">
        <select class="form-control form-control-sm" name="report_type">
          <option value="">၀င်ငွေ(သို့)ထွက်ငွေ ရွေးရန်</option>
          <hr>
          <option value="add">၀င်ငွေ ထည့်ရန်</option>
          <hr>
          <option value="sub">ထွက်ငွေ ထည့်ရန်</option>
        </select>
      </div>
      <div class="">
        <input type="submit" class="btn btn-sm btn-onuline btn-outline-info" value="ထည့်ရန်">
      </div>

      <div class="ml-2">
        <input type="date" id="from-date" class="form-control form-control-sm" value="">

      </div>
      <div class="">
        <p > မှ </p>
      </div>
      <div class="">
        <input type="date" id="to-date" class="form-control form-control-sm">
      </div>

      <div class="ml-4">
        <a href="" id="view-report" onclick="showDate();" class="btn btn-sm btn-onuline btn-outline-info" >ကြည့်ရန်</a>
      </div>

    </div>
  </form>
</div>
<div class="col-md-8" style="margin: auto">
  @if(session('date_range'))
    <p class="text-center bg-white mt-1">{{session('date_range')[0]}} မှ {{session('date_range')[1]}} ထိ</p>
    @endif
</div>
<div class="col-md-8" style="margin: auto">
  <table class="table table-bordered table-sm bg-white mt-2 ">

    <thead>
      <tr>
        <th scope="col">စဉ်</th>
        <th scope="col">အကြောင်းအရာ</th>
        <!-- <th scope="col">Comment</th> -->
        <th scope="col" style="text-align:center">စုစုပေါင်း</th>
      </tr>
    </thead>
    @if(session("date_range"))
    <tbody>
      @php($i=0)
      @php($dept_total=0)
      @php($total=0)
      @php($cost=0)
      @foreach(session("order_earn") as $order)
        <tr>
          <td>{{++$i}}</td>
          <td>{{$order->item_name}}</td>
          <td style="text-align:right">{{number_format($order->price * $order->qty)}}</td>
        </tr>
        @php($total+=$order->price * $order->qty)
      @endforeach
      @foreach(session("guest_info") as $key => $value)
      
      <tr>
        <td>{{++$i}}</td>
        <td>{{$value["name"]}}</td>
        <!-- <td>{{$value["comment"]}}</td> -->
        <td style="text-align:right">{{number_format($value["total"])}}</td>
        @php($total+=$value["total"])
      </tr>
      
      @endforeach
      @foreach(session("debt_guests") as $key => $value)
      
      <tr>
        <td>{{++$i}}</td>
        <td>{{$value["name"]}}</td>
        <!-- <td>{{$value["comment"]}}</td> -->
        <td style="text-align:right">{{number_format($value["total"])}}</td>
        @php($dept_total+=$value["total"])

      </tr>
      
      @endforeach
      @foreach(session("reports") as $report)
      
      <tr>
        <td>{{++$i}}</td>
        <td>{{$report->content}}</td>
        <td class="text-right">{{$report->price}}</td>
        @php(number_format($report->price))
      </tr>
      @if($report->type=="sub")
        @php($cost+=$report->price)
      @else
        @php($total+=$report->price)
      @endif
      
      @endforeach



      <tr>
        <td colspan="2" style="text-align:right">ရငွေ</td>
        <td style="text-align:right">{{number_format($dept_total+$total)}}</td>
      </tr>
      <tr>
        <td colspan="2" style="text-align:right">ကုန်ကျစရိတ်</td>
        <td style="text-align:right">{{number_format($cost)}}</td>
      </tr>
      <tr>
        <td colspan="2" style="text-align:right">အကြွေး</td>
        <td style="text-align:right">{{number_format($dept_total)}}</td>
      </tr>
      <tr>
        <td colspan="2" style="text-align:right">စုစုပေါင်း၀င်ငွေ</td>
        <td style="text-align:right">{{number_format($total-$cost)}}</td>
      </tr>
    </tbody>
    @else
    <tbody>
      @php($i=0)
      @php($dept_total=0)
      @php($total=0)
      @php($cost=0)
      @foreach($order_earn as $order)
        <tr>
          <td>{{++$i}}</td>
          <td>{{$order->item_name}}</td>
          <td style="text-align:right">{{number_format($order->price * $order->qty)}}</td>
        </tr>
        @php($total+=$order->price * $order->qty)
      @endforeach
      @foreach($guest_info as $key => $value)
      <tr>
        <td>{{++$i}}</td>
        <td>{{$value["name"]}}</td>
        <!-- <td>{{$value["comment"]}}</td> -->
        <td style="text-align:right">{{number_format($value["total"])}}</td>
        @php($total+=$value["total"])
      </tr>
      @endforeach
      @foreach($debt_guests as $key => $value)
      <tr>
        <td>{{++$i}}</td>
        <td>{{$value["name"]}}</td>
        <!-- <td>{{$value["comment"]}}</td> -->
        <td style="text-align:right">{{number_format($value["total"])}}</td>
        @php($dept_total+=$value["total"])

      </tr>
      @endforeach
      @foreach($reports as $report)
      <tr>
        <td>{{++$i}}</td>
        <td>{{$report->content}}</td>
        <td style="text-align:right">{{number_format($report->price)}}</td>
      </tr>
      @if($report->type=="sub")
      @php($cost+=$report->price)
      @else
        @php($total+=$report->price)
      @endif
        @endforeach

      <tr>
        <td colspan="2" style="text-align:right">ရငွေ</td>
        <td style="text-align:right">{{number_format($dept_total+$total)}}</td>
      </tr>
      <tr>
        <td colspan="2" style="text-align:right">ကုန်ကျစရိတ်</td>
        <td style="text-align:right">{{number_format($cost)}}</td>
      </tr>
      <tr>
        <td colspan="2" style="text-align:right">အကြွေး</td>
        <td style="text-align:right">{{number_format($dept_total)}}</td>
      </tr>
      <tr>
        <td colspan="2" style="text-align:right">စုစုပေါင်း ၀င်ငွေ</td>
        <td style="text-align:right">{{number_format($total-$cost)}}</td>
      </tr>
    </tbody>
    @endif
  </table>

</div>
<script>
  function showDate(){
    var start=$('#from-date').val();
    var end=$('#to-date').val();
    $('#view-report').attr('href',"{{url('user/report')}}"+"/"+start+"/"+end);
    
  }

</script>
@endsection