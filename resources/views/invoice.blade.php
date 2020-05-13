@extends('layout.master')
@section('title','invoice')
@section('content')

    <div class="row col-md-12 " style="margin: auto">
        <div class="col-md-4 my-0 card card-body">
            <form action="" method="post" class="form-group form_width" enctype="multipart/form-data">
                {{-- <input type="hidden" name="_token" value="{{csrf_token()}}"> --}}
                <legend class="">Create Your Invoice</legend>
                {{ csrf_field() }}
                @foreach ($errors->all() as $error)

                    <p class="alert alert-danger" id="error">{{$error}}</p>

                @endforeach
                <div class=" input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-info" style="width:1.8cm"
                              id="inputGroupFileAddon01">Logo</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" name="logo" class="custom-file-input form-control-sm" id="inputGroupFile01"
                               aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                    </div>
                </div>


                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-info" style="width:1.8cm">Name</span>
                    </div>
                    <input type="text" name="hotel_name" id="hotel_name" class="form-control">
                </div>
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-info" style="width:1.8cm">Address</span>
                    </div>
                    <input type="text" class="form-control" name="hotel_address" id="hotel_address">
                </div>
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-info" style="width:1.8cm">Phone</span>
                    </div>
                    <input type="text" class="form-control" name="hotel_phone" id="hotel_phone">
                </div>
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-info" style="width:1.8cm">Tax</span>
                    </div>
                    <input type="number" class="form-control" name="tax" id="invoice_tax">
                </div>


                <div class="row mt-3 ml-0">
                    <input type="submit" class="btn btn-sm btn-outline btn-outline-info mr-3" value="Save" id="submit">
                    <a href="{{url('user/invoice/1/edit')}}" class="btn btn-sm btn-outline btn-outline-warning">Cancle</a>
                </div>

            </form>
        </div>
        <div class="col-md-8 card card-body" style="background-color:lighcyan;">
            <div class="row">
                <div class="">
                    <img src="{!! asset("logo/".$invoice->logo) !!}" alt="Logo" class="logo ml-5">
                </div>
                <div class="content col-md-8">
                    <h6 class="text-center" id="invoice_name" aria-placeholder="">{{$invoice->title}}</h6>
                    <h6 class="text-center" id="invoice_address">{{$invoice->address}}</h6>
                    <h6 class="text-center" id="invoice_phone">{{$invoice->phone}}</h6>
                </div>
            </div>
            <hr>
            <h6 class="text-center">Invoice</h6>
            <p>Guest Name : U Mya</p>
            <table class="custom-table">
                <thead>
                <tr>
                    <th scope="col" class="text-center">Sr</th>
                    <th scope="col" class="text-center">Date</th>
                    <th scope="col" class="text-center">Description</th>
                    <th scope="col" class="amount text-center">Amount</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row" class="text-center">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td class="text-right">@mdo</td>
                </tr>
                <tr>
                    <th scope="row" class="text-center">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td class="text-right">@fat</td>
                </tr>
                <tr>
                    <td colspan="3" class="text-right table-bordered-less">Total</td>
                    <td class="text-right"></td>
                </tr>
                <tr>
                    <td colspan="3" class="text-right table-bordered-less">Discount</td>
                    <td class="text-right"></td>
                </tr>
                <tr>
                    <td colspan="3" class="text-right table-bordered-less">Tax</td>
                    <td class="text-right" id="tax_col">{{$invoice->tax}}%</td>
                </tr>
                <tr>
                    <td colspan="3" class="text-right table-bordered-less">Total Balance</td>
                    <td class="text-right"></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            // alert($('#hotel_name').val());
            $('#hotel_name').val($('#invoice_name').text());
            $('#hotel_address').val($('#invoice_address').text());
            $('#hotel_phone').val($('#invoice_phone').text());
            $('#invoice_tax').val($('#tax_col').text());

            $('input').keyup(function () {
                $('#invoice_name').text($('#hotel_name').val());
                $('#invoice_address').text($('#hotel_address').val());
                $('#invoice_phone').text($('#hotel_phone').val());

            });

            $('#invoice_tax').keyup(function () {
                $('#tax_col').text($('#invoice_tax').val());
                $('#invoice_tax').css("background-color", "white");
                $('#tax_col').css("background-color", "white");
            });
            $('#invoice_tax').keydown(function () {

                $('#invoice_tax').css("background-color", "cyan");
                $('#tax_col').css("background-color", "cyan");
            });
        });
        // function invoice(){
        //     alert('i ma invioce method');
        //     $('#hotel_name').val()=" u r l";
        //     $('#hotel_address').val()=$('#invoice_address').text();
        //     $('#hotel_phone').val()=$('#invoice_phone').text();
        // }
    </script>
@endsection()
