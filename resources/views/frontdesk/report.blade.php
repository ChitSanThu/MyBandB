@extends('layout.reportspecial')
@section('content')
<div class="col-md-9 " style="margin:auto">
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
        <input type="text" class="form-control form-control-sm" name="report_name" placeholder="Name" value="{{old('report_name')}}">
      </div>

      <div class="col-2">
        <input type="text" class="form-control form-control-sm" name="report_price" placeholder="Price" value="{{old('report_price')}}">
      </div>
      <div class="ml-2">
        <input type="submit" class="btn btn-sm btn-onuline btn-outline-info" value="Save">
      </div>

      <div class="ml-4">
        <input type="date" id="from-date" class="form-control form-control-sm" value="">

      </div>
      <div class="ml-2">
        <p >to</p>
      </div>
      <div class="ml-2">
        <input type="date" id="to-date" class="form-control form-control-sm">
      </div>

      <div class="ml-4">
        <a href="" id="view-report" onclick="showDate();" class="btn btn-sm btn-onuline btn-outline-info" >View</a>
      </div>

    </div>
  </form>
  @if(session('date_range'))
    <p class="text-center bg-white mt-2">{{session('date_range')[0]}} မှ {{session('date_range')[1]}} ထိ</p>
    @endif
  <table class="table table-bordered table-sm bg-white mt-2 ">

    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <!-- <th scope="col">Comment</th> -->
        <th scope="col" style="text-align:center">Total</th>
      </tr>
    </thead>
    @if(session("date_range"))
    <tbody>
      @php($i=0)
      @php($dept_total=0)
      @php($total=0)
      @php($cost=0)
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
        <td style="text-align:right">{{number_format($report->price)}}</td>
      </tr>
      @php($cost+=$report->price)
      
      @endforeach

      <tr>
        <td colspan="2" style="text-align:right">Total</td>
        <td style="text-align:right">{{number_format($dept_total+$total)}}</td>
      </tr>
      <tr>
        <td colspan="2" style="text-align:right">Costs</td>
        <td style="text-align:right">{{number_format($cost)}}</td>
      </tr>
      <tr>
        <td colspan="2" style="text-align:right">Dept</td>
        <td style="text-align:right">{{number_format($dept_total)}}</td>
      </tr>
      <tr>
        <td colspan="2" style="text-align:right">Grand Total</td>
        <td style="text-align:right">{{number_format($total-$cost)}}</td>
      </tr>
    </tbody>
    @else
    <tbody>
      @php($i=0)
      @php($dept_total=0)
      @php($total=0)
      @php($cost=0)
      @foreach($guest_info as $key => $value)
      @if($value["date"]==date("Y-m-d"))
      <tr>
        <td>{{++$i}}</td>
        <td>{{$value["name"]}}</td>
        <!-- <td>{{$value["comment"]}}</td> -->
        <td style="text-align:right">{{number_format($value["total"])}}</td>
        @php($total+=$value["total"])
      </tr>
      @endif
      @endforeach
      @foreach($debt_guests as $key => $value)
      @if($value["date"]==date("Y-m-d"))
      <tr>
        <td>{{++$i}}</td>
        <td>{{$value["name"]}}</td>
        <!-- <td>{{$value["comment"]}}</td> -->
        <td style="text-align:right">{{number_format($value["total"])}}</td>
        @php($dept_total+=$value["total"])

      </tr>
      @endif
      @endforeach
      @foreach($reports as $report)
      @if(explode(" ",$report->created_at)[0]==date("Y-m-d"))
      <tr>
        <td>{{++$i}}</td>
        <td>{{$report->content}}</td>
        <td style="text-align:right">{{number_format($report->price)}}</td>
      </tr>
      @php($cost+=$report->price)
      @endif
      @endforeach

      <tr>
        <td colspan="2" style="text-align:right">Total</td>
        <td style="text-align:right">{{number_format($dept_total+$total)}}</td>
      </tr>
      <tr>
        <td colspan="2" style="text-align:right">Costs</td>
        <td style="text-align:right">{{number_format($cost)}}</td>
      </tr>
      <tr>
        <td colspan="2" style="text-align:right">Dept</td>
        <td style="text-align:right">{{number_format($dept_total)}}</td>
      </tr>
      <tr>
        <td colspan="2" style="text-align:right">Grand Total</td>
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