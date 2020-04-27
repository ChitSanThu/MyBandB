<div class="boxWidth" id="checkInForm">
    <div class="row checkInstatus">
        <div class="card card-body col-md-6 container form-width">
            <legend>Check In Form</legend>

            <form action="" method="post">
                {{ csrf_field() }}

                <input type="hidden" name="status" value="1">
                <input type="hidden" id="guest_id" name="guest_id" value="">
                <input type="hidden" name="guest_month" value="{{$mon}}">
                <input type="hidden" name="guest_year" value="{{$year}}">

                <div class="row">
                    <div class="col col-md-3">
                        <label for="forroomnumber">အခန်းနံပါတ်</label>
                        <input type="text" name="roomNum" id="rnb" readonly class="form-control">
                    </div>
                    <div class="col  col-md-3">
                        <label for="day">နေထိုင်မည့်ရက်</label>
                        <input type="text" name="days" id="numDay" readonly class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="name">ဧည့်သည်အမည်</label>
                        <input type="text" name="name" required id="name" class="form-control" placeholder="အမည်">
                    </div>
                    <div class="col">
                        <label for="fatherName">ဖခင်အမည်</label>
                        <input type="text" required name="fname" id="" class="form-control" placeholder="ဖခင်အမည်">
                    </div>
                    <div class="col">
                        <label for="forPhone">ဖုန်းနံပါတ်</label>
                        <input type="text" required name="phone" id="phone" class="form-control" placeholder="ဖုန်းနံပါတ်">
                    </div>
                </div>

                <label for="forNrc">မှတ်ပုံတင်အမှတ်</label><br>
                <div class="row">

                    <div class="form-group col-md-4">

                        <input list="inputState" name="nrctype" class="form-control" placeholder="၅/မရန">

                        <datalist id="inputState">
                            @foreach($nrc_type as $nrc)
                            <option value="{{$nrc->nrc_type}}">
                            
                            @endforeach
                        </datalist>


                    </div>

                    <!-- <div class="col">

                        <select name="nrctype" required id="" class="form-control">
                            <option value="Choice">Choice...</option>
                        </select>
                    </div> -->
                    <div class="col">

                        <select name="nrc" id="" required class="form-control">
                            <option value="နိုင်"> နိုင် </option>
                            <option value="ပြု"> ပြု </option>
                            <option value="ဧည့်"> ဧည့် </option>
                            <option value="သာ"> သာ </option>
                        </select>
                    </div>
                    <div class="col">

                        <input type="text" required name="nrcno" id="" class="form-control" placeholder="နံပါတ်">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col col-md-1">

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" required value="ကျား">
                            <label class="form-check-label" for="inlineRad"></label>
                            ကျား
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" required type="radio" name="gender" value="မ">
                            <label class="form-check-label" for="inlineRadio2">မ</label>
                        </div>
                    </div>
                    <div class="col col-md-3">
                        {{-- <label for="forAge">အသက်</label> --}}
                        <input type="text" required name="age" id="" class="form-control" placeholder="အသက်">
                    </div>
                    <div class="col">

                        <input type="text" required name="nation" id="" class="form-control" placeholder="လူမျိုး">
                    </div>
                    <div class="col">
                        <input type="text" required name="job" class="form-control" id="" placeholder="အလုပ်အကိုင်">
                    </div>

                </div>

                <div class="row">
                    <div class="col">
                        <label for="forAddress">နေရပ်လိပ်စာ</label>
                        <input type="text" required name="address" id="" class="form-control" placeholder="နေရပ်လိပ်စာ">
                    </div>
                    <div class="col col-md-4">
                        <label for="forAddress">တိုင်း</label>
                        <input type="text" required name="state" id="" class="form-control">
                    </div>
                </div>
                <input type="hidden" id="contron_checkin" name="contron" value="checkin">
                <input type="submit" value="သိမ်းမည်" class="mt-3 btn btn-outline btn-outline-info">
                <input type="button" onclick="hideBox();" value="ပိတ်မည်" class="mt-3 btn btn-outline btn-outline-warning">
            </form>
        </div>
    </div>
</div>
<script>
    function hideBox() {
        $('#checkInForm').hide();
        window.location.href = "{{url('/user/5')}}";
    }
</script>