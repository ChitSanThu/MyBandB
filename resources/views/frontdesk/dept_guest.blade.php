<table class="table table-bordered table-sm">

    <thead>
    <tr>
        <th scope="col">စဉ်</th>
        <th scope="col">အမည်</th>
        <th scope="col">စုစုပေါင်း</th>
        <th scope="col">အကြောင်းအရာ</th>
        <th scope="col">နေ့စွဲ</th>
        <th scope="col">ငွေရှင်းရန်</th>
        <!-- <th scope="col">Delete</th> -->
    </tr>
    </thead>
    <tbody id="txtHintHide" class="">
        @php($i=0)
	@if(isset($guest_info))
        @foreach($guest_info as $key => $value)
            <tr>
                <td>{{++$i}}</td>
                <td>{{$value['guest_name']}}</td>
                <td>{{$value['total']}}+{{$value['order']}}</td>
                <td>{{$value['comment']}}</td>
                <td>{{$value['date']}}</td>
                <td><a  href="{{url('user/debt/'.$value['guest_id'])}}" class="btn btn-sm btn-info">ငွေရှင်းပြီး</a></td>
                
            </tr>
        @endforeach

	@endif
    </tbody>
    <tbody id="txtHint">
        
    </tbody>
</table>
