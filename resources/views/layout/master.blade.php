<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        *{
            font-family: 'Nunito', sans-serif;
        }
    .logo{
            height: 100px;
            width:100px;
            /* border-radius: 50%; */
        }
        .table-bordered-less{
            border:none;
        }
        .custom-table{
            width: 100%;

        }
         th, td {
            border: 1px solid black;
        }
        .amount{
            width: 20%;
        }
        body{
           background: rgba(0,0,0,0.3) !important;
        }

        /* for room state color */
        .room-checkin {
            background-color: #007bff;
        }

        .room-checkout {
            background-color: #ffc107;
        }

        .room-reserv {
            background-color: #17a2b8;
        }

        .housekeeping {
            background-color: #28a745;
        }

        .out-of-service {
            background-color: #dc3545;
        }

        .idel {
            background-color: #6c757d;
        }
        .payment_stay_guest {
            background-color: #155724;
        }
        .checkmark {
            position: absolute;
            height: 25px;
            width: 25px;
            border-radius: 50%;
        }
        .checkInstatus {
            z-index: 1;
            /* Sit on top */
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            position: fixed;
            overflow: auto;
            /* Enable scroll if needed */
            background-color: #99dfff;
            /* Fallback color */
            background-color: rgba(255, 255, 255, 0.7);
            /* Black w/ opacity */
            padding-top: 60px;
            padding-bottom: 60px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="{{asset('js/jquery.PrintArea.js')}}"></script>
</head>
<body>
@include('../sharedata/nav')
<div class="row mt-5 container-fluid">
    <div class="col-md-2 my-0">
        <div class="calandar">
            @include('layout.master-sidebar')
        </div>
    </div>
    <div class="col-md-10" style="margin:auto;">
        @yield('content')
    </div>
</div>


</body>
</html>
