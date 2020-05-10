<table class="daytable table-hover">

    @php
        $viewMonth=$mon;
        $month=cal_days_in_month(CAL_GREGORIAN,$viewMonth,$year);
        $dayName=['Su'=>1,'Mo'=>2,'Tu'=>3,'We'=>4,'Th'=>5,'Fr'=>6,'Sa'=>7];
      $firstDay= substr(date("l", mktime(5, 5, 5, $viewMonth, 1, $year)),0,2);

    @endphp
    <div class="row mt-2 ml-3 mb-0">
        <form action="">
            <div class="btn-group btn-group-sm" role="group">
                <a href="{{url('/user/month/decrease')}}" class="btn btn-outline-secondary">&laquo;</a>
                <a href="{{url('/user/month/current')}}" class="btn btn-secondary">{{$month_name[$viewMonth-1]}}{{$year}} </a>
                <a href="{{url('/user/month/increase')}}" type="button" class="btn btn-outline-secondary">&raquo;</a>
            </div>
        </form>

    </div>
    <thead class="mt-0">
    <tr>
        @foreach ($dayName as $key=>$name)
            <th><p class="text-center my-0">{{$key}}</p></th>
        @endforeach
    </tr>
    </thead>
    <tbody style="">
    <tr>
        @php($i=1)
        @for ($i; $i <=7; $i++)
            @if($i==$dayName[$firstDay])
                @php($count=1)
                @for ($i; $i <=7; $i++)
                    @if($count==date("d") && $mon==date("m") && $year==date("Y"))
                        <td><p class="my-0 current text-center">{{$count}}</p></td>
                    @else
                        <td><p class="my-0 text-center">{{$count}}</p></td>
                    @endif
                    @php($count++)

                @endfor
                @break
            @endif
            <td></td>
        @endfor
    </tr>
    @for ($r = 3; $r <= 7; $r++)
        <tr>
            @for($c=0;$c<7;$c++)
                @if($count>$month)
                    @break
                @endif
                @if($count==date("d") && $mon==date("m") && $year==date("Y"))
                    <td><p class="my-0 current text-center">{{$count}}</p></td>
                @else
                    <td><p class="my-0 text-center">{{$count}}</p></td>
                @endif
                @php($count++)
            @endfor
        </tr>
    @endfor
    </tbody>
</table>

