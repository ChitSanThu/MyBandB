<div class="row payment_state" id="order_form">
    <div class=" col-md-5 card card-body container ">
        <form action="{{url('user/order/store')}}" method="post" class="form-group form_width">

            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="order_id" id="order_id" value="">
            <div class="row">
                <div class="col-md-12">
                    <h5 class="text text-center">အခန်းနံပါတ် <span id="order_room"></span> <span id="order_guest"></span> အတွက် အော်ဒါ မှာရန်</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-sm" id="order_show_box">

                    </table>
                </div>
            </div>
            <div class="" style="margin-bottom: 0">
                <div class="row">
                    <div class="col-md-4 text-center">
                        ကုန်အုပ်စု အမည်
                    </div>
                    <div class="col-md-8">
                        <select name="order_gp" id="order_gp"  onchange="showItems(this.value)" class="form-control form-control-sm">
                            <option value="">ကုန်အုပ်စုရွေးရန်</option>
                            @foreach($order_gp as $item)
                                <option value="{{$item->id}}">{{$item->cat_name}}</option>

                            @endforeach
                        </select>
                    </div>
                </div>
                <br>
            <div class="row">
                <div class="col-md-4 text-center">
                    ကုန်ပစ္စည်း အမည်
                </div>
                <div class="col-md-8">
                    <select name="order_name" onchange="showPrice(this.value)" id="item_result" class="form-control form-control-sm">
                        <option value="">ကုန်အုပ်စုအရင်ရွေးရန်လိုအပ်ပါသည်</option>

                    </select>
                </div>
{{--                <div class="col-md-8">--}}
{{--                    <input type="text" name="order_name" id="order_name" class="form-control form-control-sm">--}}
{{--                </div>--}}
            </div>
            <br>
            <div class="row">
                <div class="col-md-4 text-center">
                    စျေးနှုန်း
                </div>
                <div class="col-md-8">
                    <input type="number" name="order_price" id="order_price" class="form-control form-control-sm">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4 text-center">
                    အရေအတွက်
                </div>
                <div class="col-md-8">
                    <input onchange="cal()" type="number" name="order_qty" id="order_qty" class="form-control form-control-sm" value="0">
                </div>
            </div>
            <br>
            <div class="row">

                <div class="col-md-4 text-center">
                    စုစုပေါင်း
                </div>
                <div class="col-md-8">
                    <input type="number" name="ordre_total" id="order_total" class="form-control form-control-sm"><br>
                </div>
            </div>

                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-8">
                        <input type="radio" name="order_method" id="" class="payment_radio" value="0">လက်ငင်း
                        <input type="radio" name="order_method" id="" class="ml-3 payment_radio" value="1">အကြွေး
                    </div>
                </div>
                <br>
            <div class="row justify-content-md-center">
                <input type="submit" value="မှတ်မည်" class="btn btn-outline mr-5 btn-outline-info">
                <input type="button" onclick="addOrder()" value="မှာရန်" class="btn btn-outline mr-5 btn-outline-secondary">
                <div onclick="$('#order_form').hide();" class="btn btn-outline btn-outline-warning">ပိတ်မည်</div>
            </div>
            </div>
        </form>
    </div>
</div>
<script>
    let items=document.getElementById("order_show_box");
    let total=0;
    $('#order_price').keyup(function () {
        $('#order_total').val($(this).val()*$('#order_qty').val()+parseInt(total));
    });
    $('#order_qty').keyup(function () {
        $('#order_total').val($(this).val()*$('#order_price').val() + parseInt(total));
    });
    function cal(){
        $('#order_total').val($('#order_qty').val()*$('#order_price').val() + parseInt(total));
    };
    function textValid(txt) {
        if(txt)
            return txt;
        else
            return false;
    }
    function addOrder() {
        let name=$('#toget'+$('#item_result').val()).attr('title');
        // alert(name);
        // return 
        // this.searchNameByCatId(name)
        // let ftd='<td id="order_search_name"></td>';
        let price=textValid($('#order_price').val());
        let qty=textValid($('#order_qty').val());
        if(qty>0){
            items.innerHTML+= `<input type='hidden' name='order_items[]' value= ${name +","+ price +","+ qty} /> `;
            items.innerHTML+=`<tr><td>${name}</td><td>${price}</td><td>${qty}</td><td>${price*qty}</td></tr>`;

            // $('#item_result').val("");
            // $('#order_price').val("");
            $('#order_qty').val(0);
            total=$('#order_total').val();
        }
    }
</script>
<script>
    function searchNameByCatId(str) {
        let xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
            if (this.readyState==4 && this.status==200) {
                document.getElementById("order_search_name").innerHTML=this.responseText;
            }
        }
        xmlhttp.open("GET","{{url('user/searchById')}}"+"/"+str,true);
        xmlhttp.send();
    }
    function showItems(str) {
        if (str=="") {
            document.getElementById("item_result").innerHTML="<option value=\"\">ကုန်အုပ်စုအရင်ရွေးရန်လိုအပ်ပါသည်</option>";
            return;
        }
        let xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
            if (this.readyState==4 && this.status==200) {
                document.getElementById("item_result").innerHTML=this.responseText;
            }
        }
        xmlhttp.open("GET","{{url('user/search/order')}}"+"/"+str,true);
        xmlhttp.send();
    }
    function showPrice(str) {
        if (str=="") {
            document.getElementById("order_price").value="500";
            return;
        }
        let xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
            if (this.readyState==4 && this.status==200) {
                document.getElementById("order_price").value=this.responseText;
            }
        }
        xmlhttp.open("GET","{{url('user/search/order/price')}}"+"/"+str,true);
        xmlhttp.send();
    }
</script>
