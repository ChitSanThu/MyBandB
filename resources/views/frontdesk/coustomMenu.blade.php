<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .showcontext {
            position: absolute;
        }

        .hide {
            display: none;
        }
    </style>
    <script>
        $(document).ready(function () {

            if ($("#test").addEventListener) {
                $("#test").addEventListener('contextmenu', function (e) {
                    alert("You've tried to open context menu"); //here you draw your own menu
                    e.preventDefault();
                }, false);
            } else {
                $('body').on('contextmenu', '.highlight1', function () {

                    document.getElementById("rmenu").className = "showcontext";
                    document.getElementById("rmenu").style.top = mouseY(event) + 'px';
                    document.getElementById("rmenu").style.left = mouseX(event) + 'px';

                    window.event.returnValue = false;
                });
            }
        });

        $(document).bind("click", function (event) {
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
</head>
<body>
<div class="hide list-group" id="rmenu">

    <a href="{{url('/checkin/guest')}}" class="list-group-item list-group-item-action">Dapibus ac </a>
    <a href="#" class="list-group-item list-group-item-action">Morbi leo </a>
    <a href="#" class="list-group-item list-group-item-action">Porta ac </a>
    <a href="#" class="list-group-item list-group-item-action ">Vestibulum at </a>
</div>
<script>

</script>
</body>
</html>