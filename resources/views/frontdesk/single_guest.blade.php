@extends('layout.master')
@section('content')
    <div class="boxWidth" id="checkInForm">
        <div class="row checkInstatus">
            <div class="card card-body col-md-6 container form-width">
                <legend>{{$guest->name}} ၏ အချက်အလက်</legend>

                <form action="" method="post">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col">
                            <label for="forroomnumber">အခန်းနံပါတ်</label>
                            <input type="text" name="roomNum" id="rnb" readonly class="form-control" value="{{$guest->room_number}}">
                        </div>
                        <div class="col">
                            <label for="day">နေထိုင်မည့်ရက်</label>
                            <input type="text" name="days" id="numDay" readonly value="{{$guest->start_day}}မှ{{$guest->end_day}}ထိ" class="form-control">
                        </div>
                        <div class="col">
                            <label for="name">ဧည့်သည်အမည်</label>
                            <input type="text" name="name" required id="name" value="{{$guest->name}}" readonly class="form-control">
                        </div>
                    </div>
                    <br>
                    <div class="row">

                        <div class="col">
                            <label for="fatherName">ဖခင်အမည်</label>
                            <input type="text" required name="fname" value="{{$guest->father_name}}" readonly class="form-control">
                        </div>
                        <div class="col">
                            <label for="forPhone">ဖုန်းနံပါတ်</label>
                            <input type="text" required name="phone" id="phone" value="{{$guest->phone}}" readonly class="form-control">
                        </div>
                        <div class="col">
                            <label for="forNrc">မှတ်ပုံတင်အမှတ်</label>
                            <input type="text" class="form-control" value="{{$guest->nrc}}" readonly name="" id="">
                        </div>
                    </div>
                    <br>
                    
                    <div class="row">
                        <div class="col ">
                            <label for="">အသက်</label>
                            <input type="text" required name="age" id="" class="form-control" readonly value="{{$guest->age}}">
                        </div>
                        <div class="col">
                            <label for="">လူမျိုး</label>
                            <input type="text" required name="nation" id="" class="form-control" readonly value="{{$guest->nation}}">
                        </div>
                        <div class="col">
                            <label for="">အလုပ်အကိုင်</label>
                            <input type="text" required name="job" class="form-control" id="" readonly value="{{$guest->job}}">
                        </div>

                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <label for="forAddress">နေရပ်လိပ်စာ</label>
                            <input type="text" required name="address" id="" class="form-control" readonly  value="{{$guest->address}}">
                        </div>
                        <div class="col col-md-4">
                            <label for="forAddress">တိုင်း/ပြည်နယ်</label>
                            <input type="text" required name="state" id="" value="{{$guest->state}}" readonly class="form-control">
                        </div>
                    </div>
                    <br>
                    <a href="{{url('user/frontdesk')}}"  class="mt-3 btn btn-outline btn-outline-info">ပိတ်မည်</a>
                </form>
            </div>
        </div>
    </div>

@endsection