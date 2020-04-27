<table class="table table-bordered table-sm">

    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Total</th>
        <th scope="col">Comment</th>
        <th scope="col">Date</th>
        <th scope="col">Payment</th>


        <!-- <th scope="col">Delete</th> -->
        
    </tr>
    </thead>
    <tbody id="txtHintHide" class="">
        @php($i=0)
        @foreach($guest_info as $key => $value)
            <tr>
                <td>{{++$i}}</td>
                <td>{{$value['guest_name']}}</td>
                <td>{{$value['total']}}</td>
                <td>{{$value['comment']}}</td>
                <td>{{$value['date']}}</td>
                <td><a  href="{{url('user/5?debt='.$value['guest_id'])}}" class="btn btn-sm btn-info">ငွေရှင်းပြီး</a></td>
                
            </tr>
        @endforeach
    </tbody>
    <tbody id="txtHint">
        
    </tbody>
</table>