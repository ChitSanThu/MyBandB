<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .status {

        }

        .room_status {
            width: 20px;
            height: 20px;
            background-color: #2a88bd;
            text-align: left;
        }

        .roomNumColor {
            cursor: pointer;
        }
        /*
        start content menu css
        */
        .labels > span > ul {
            margin: 0;
            padding: 0;
            list-style: none;
            display: block;
            float: none;
        }
        .labels > span > ul > li {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 1px solid #CCC;
            overflow: hidden;
            text-indent: -2000px;
        }
        .labels > span > ul > li.selected,
        .labels > span > ul > li:hover { border: 1px solid #000; }
        .labels > span > ul > li + li { margin-left: 5px; }
        .labels > span > ul > li.label1 { background: red; }
        .labels > span > ul > li.label2 { background: green; }
        .labels > span > ul > li.label3 { background: blue; }
        .labels > span > ul > li.label4 { background: yellow; }
        /*end content menu*/
    </style>
</head>
<body>
@foreach ($roomtypes as $type)
    <tr>
        <td class="status">{{$type->roomtype}}</td>
        <td class="roomTypeSpan" colspan="{{$num_of_day}}">{{$type->roomtype}}</td>
    </tr>
    @foreach ($rooms as $room)

        @if($room->roomtype==$type->roomtype)
            <tr>

                <td class="roomNumColor">

                    {{$room->roomumber}}
                </td>
                @for ($i = 0; $i < $num_of_day; $i++)
                    <td class="roomCell"></td>
                @endfor
            </tr>
        @endif

    @endforeach
@endforeach
<script>

    $(function () {
        /**************************************************
         * Custom Command Handler
         **************************************************/
        $.contextMenu.types.label = function (item, opt, root) {
            // this === item.$node

            $('<span>Rome State<ul>'
                + '<li class="label1" title="clear">label 1'
                + '<li class="label2" title="dirty">label 2'
                + '<li class="label3" title="modefine">label 3'
                + '<li class="label4" title="close">label 4')
                .appendTo(this)
                .on('click', 'li', function () {
                    // do some funky stuff
                    alert('Clicked on ' + $(this).text());
                    // hide the menu
                    root.$menu.trigger('contextmenu:hide');
                });

            this.addClass('labels').on('contextmenu:focus', function (e) {
                // setup some awesome stuff
            }).on('contextmenu:blur', function (e) {
                // tear down whatever you did
            }).on('keydown', function (e) {
                // some funky key handling, maybe?
            });
        };

        /**************************************************
         * Context-Menu with custom command "label"
         **************************************************/
        $.contextMenu({
            selector: '.roomNumColor',
            callback: function (itemKey, opt, rootMenu, originalEvent) {
                var m = "clicked: " + itemKey+opt+rootMenu+originalEvent;
                alert(m);
            },
            items: {
                open: {name: "Open", callback: $.noop},
                label: {type: "label", customName: "Label"},
                edit: {name: "Edit", callback: $.noop}
            }
        });
    });
</script>
<script>
    $('.room_status').dbclick(function () {
        alert('click');
    });
</script>
</body>
</html>
