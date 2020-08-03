<div class="printArea  checkinlist">
<div class="text-center mb-2 mt-2">{{$invoice->title}}  နေ့စဉ်ဧည့်မှတ်တမ်း <i class="fa fa-phone ml-2"></i> {{$invoice->phone}}</div>
<table class="table table-bordered table-sm ">

    <thead>
    <tr>
        <th scope="col">စဉ်</th>
        <th scope="col"> အခန်းနံပါတ်</th>
        <th scope="col">အမည်</th>
        <th scope="col">အဘ အမည်</th>
        <th scope="col">မှတ်ပုံတင်</th>
        <th scope="col">အသက်</th>
        <th scope="col">လိင်</th>
        <th scope="col">လူမျိုး</th>
        <th scope="col">နေရပ်လိပ်စာ</th>
        <th scope="col">အလုပ်အကိုင်</th>
    </tr>
    </thead>
    <tbody>
    @php($male=0)
    @php($female=0)
    @php($count=0)
    
    @foreach($guests as $guest)
    @php($indays=array())
    @for($i=$guest->stard_day;$i<=$guest->end_day;$i++)
        @php(array_push($indays,$i))
    @endfor
    @if($guest->year==date('Y') && $guest->month==date('m') && in_array(date('d'),$indays) && ($guest->guest_status==1 || $guest->guest_status==4))
        <tr>
            <th scope="row">{{++$count}}</th>
            <td>{{$guest->room_number}}</td>
            <td>{{$guest->name}}</td>
            <td>{{$guest->father_name}}</td>
            <td>{{$guest->nrc}}</td>
            <td>{{$guest->age}}</td>
            <td>{{$guest->gender}}</td>
            <td>{{$guest->nation}}</td>
            <td>{{$guest->state}}</td>
            <td>{{$guest->job}}</td>


        </tr>
        

        @if($guest->gender=="ကျား")
            @php(++$male)
            @else
                @php(++$female)
                @endif
    @endif
    @endforeach
    </tbody>
</table>
{{--    {{ $guests->links() }}--}}
<div>ကျား {{$male}} မ {{$female}}</div>
</div>
<div class="btn btn-info mt-3 " onclick="$('div.printArea.checkinlist').printArea();" >Print</div>
