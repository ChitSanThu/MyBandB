<table class="daytable table-hover">

    @php

        //$date=new index();

        $viewMonth=$mon;
        //$year=$year;

        $month=cal_days_in_month(CAL_GREGORIAN,$viewMonth,$year);
        $dayName=['Su'=>1,'Mo'=>2,'Tu'=>3,'We'=>4,'Th'=>5,'Fr'=>6,'Sa'=>7];
      $firstDay= substr(date("l", mktime(5, 5, 5, $viewMonth, 1, $year)),0,2);

    @endphp
    <div class="row mt-2 ml-3 mb-0">
        <form action="">
            <div class="btn-group btn-group-sm" role="group">
                <button type="button" class="btn btn-outline-info">&laquo;</button>
                <button type="button" class="btn btn-info">December 2019</button>
                <button type="button" class="btn btn-outline-info">&raquo;</button>
            </div>
        </form>

    </div>
    <thead class="mt-0">
    <tr>
        @foreach ($dayName as $key=>$name)
            <th>{{$key}}</th>
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
                    <td>{{$count}}</td>
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
                <td>{{$count}}</td>
                @php($count++)
            @endfor
        </tr>
    @endfor
    </tbody>
</table>

