<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script>
        $(document).ready(function() {


            if ($("#test").addEventListener) {
                $("#test").addEventListener('contextmenu', function(e) {
                    alert("You've tried to open context menu"); //here you draw your own menu
                    e.preventDefault();
                }, false);
            } else {

                //document.getElementById("test").attachEvent('oncontextmenu', function() {
                //$(".test").bind('contextmenu', function() {
                $('body').on('contextmenu', '#custom', function() {


                    //alert("contextmenu"+event);
                    document.getElementById("rmenu").className = "show";
                    document.getElementById("rmenu").style.top = mouseY(event) + 'px';
                    document.getElementById("rmenu").style.left = mouseX(event) + 'px';

                    window.event.returnValue = false;


                });
            }

        });

        // this is from another SO post...
        $(document).bind("click", function(event) {
            document.getElementById("rmenu").className = "hide";
        });



        function mouseX(evt) {
            if (evt.pageX) {
                return evt.pageX;
            } else if (evt.clientX) {
                return evt.clientX + (document.documentElement.scrollLeft ?
                    document.documentElement.scrollLeft :
                    document.body.scrollLeft);
            } else {
                return null;
            }
        }

        function mouseY(evt) {
            if (evt.pageY) {
                return evt.pageY;
            } else if (evt.clientY) {
                return evt.clientY + (document.documentElement.scrollTop ?
                    document.documentElement.scrollTop :
                    document.body.scrollTop);
            } else {
                return null;
            }
        }
    </script>
    <link rel="stylesheet" href="contextmenu.css" />
    <style>
        .show {
            z-index: 1000;
            position: absolute;
            background-color: #C0C0C0;
            border: 1px solid blue;
            padding: 2px;
            display: block;
            margin: 0;
            list-style-type: none;
            list-style: none;
        }

        .hide {
            display: none;
        }

        .show li {
            list-style: none;
        }

        .show a {
            border: 0 !important;
            text-decoration: none;
        }

        .show a:hover {
            text-decoration: underline !important;
        }
    </style>
</head>
<body>



<div id="test">
    <a href="www.google.com" id="custom">Google</a>
    <a href="www.google.com" id="custom">Link 2</a>
    <a href="www.google.com" id="custom">Link 3</a>
    <a href="www.google.com" id="custom">Link 4</a>
</div>

<!-- initially hidden right-click menu -->
<div class="hide" id="rmenu">
    <ul>
        <li>
            <a href="{{url('/')}}">Google</a>
        </li>

        <li>
            <a href="http://localhost:8080/login">Localhost</a>
        </li>

        <li>
            <a href="C:\">C</a>
        </li>
    </ul>
</div>
</body>
</html>