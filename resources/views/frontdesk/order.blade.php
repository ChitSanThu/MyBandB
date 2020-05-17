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
                    order အမည်
                </div>
                <div class="col-md-8">
                    <input type="text" name="order_name" id="order_name" class="form-control form-control-sm">
                </div>
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
                    <input onchange="cal()" type="number" name="order_qty" id="order_qty" class="form-control form-control-sm" value="1">
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
        let name=textValid($('#order_name').val());
        let price=textValid($('#order_price').val());
        let qty=textValid($('#order_qty').val());
        if(name && price && qty>0){
            items.innerHTML+= `<input type='hidden' name='order_items[]' value= ${name +","+ price +","+ qty} /> `;
            items.innerHTML+=`<tr><td>${name}</td><td>${price}</td><td>${qty}</td><td>${price*qty}</td></tr>`;
            $('#order_name').val("");
            $('#order_price').val("");
            $('#order_qty').val(1);
            total=$('#order_total').val();
        }
    }
</script>
