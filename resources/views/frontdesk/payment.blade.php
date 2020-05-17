<div class="row payment_state" id="payment_form">
    <div class=" col-md-5 card card-body container ">

        <form action="{{url('/user/invoice/print')}}" method="post" class="form-group form_width">
            
            <legend class="mb-3 text-center">ငွေပေးချေမှု <span class="mr-0 close_tab" onclick="$('#payment_form').hide();">X</span></legend>
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="invoice_id" id="invoice_id">
            <input type="hidden" name="room_type" id="room_type">
            <input type="hidden" name="room_cost" id="room_cost">
            <div class="row">
                <div class="col-md-4 text-center">
                    ဧည့်သည်အမည်
                </div>
                <div class="col-md-8">
                    <input type="text" name="payment_name" id="payment_name" class="form-control form-control-sm">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4 text-center">
                    အခန်းနံပါတ်
                </div>
                <div class="col-md-8">
                    <input type="text" name="payment_room" id="payment_room" class="form-control form-control-sm">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4 text-center">
                    နေထိုင်သောရက်
                </div>
                <div class="col-md-8">
                    <input type="text" name="payment_day" id="payment_day" class="form-control form-control-sm">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4 text-center">
                    ကျသင့်ငွေ
                </div>
                <div class="col-md-8">
                    <input type="text" name="payment_cost" id="payment_cost" class="form-control form-control-sm">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4 text-center">
                    လျော့စျေး
                </div>
                <div class="col-md-8">
                    <input type="number" name="discount" id="discount" class="form-control form-control-sm">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4 text-center">
                    အခွန်
                </div>
                <div class="col-md-8">
                    <input type="text" name="tax" id="tax" class="form-control form-control-sm">
                </div>
            </div>
            <br>
            <div class="row">

                <div class="col-md-4 text-center">
                    စုစုပေါင်း
                </div>
                <div class="col-md-8">
                    <input type="text" name="total" id="total" class="form-control form-control-sm"><br>

                    <input type="radio" name="payment_method" id="payment_method"onclick="$('#comment').addClass('hide')" class="payment_radio" value="0">လက်ငင်း
                    <input type="radio" name="payment_method" onclick="$('#comment').removeClass('hide')" id="payment_method" class="ml-3 payment_radio" value="1">အကြွေး

                </div>
            </div>
            <br>
            <div class="row hide" id="comment">
                <div class="col-md-4 text-center">
                    မှတ်ချက်
                </div>
                <div class="col-md-8">
                    <input type="text" name="comment" id="comment" class="form-control form-control-sm"><br>
                </div>
            </div>
            <div class="row justify-content-md-center">
            <input type="submit" value="သိမ်းမည်" class="btn btn-outline mr-5 btn-outline-info">
                    <div onclick="$('#payment_form').hide();" class="btn btn-outline btn-outline-warning">ပိတ်မည်</div>
            </div>
        </form>
    </div>
</div>
