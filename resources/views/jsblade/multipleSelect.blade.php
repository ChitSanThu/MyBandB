<?php
$cin = 5;
$cout = 6;
?>
<script>
    $(function () {
        $.contextMenu({
            selector: '.highlight1',
            callback: function (key, options) {
                //var k;
                //switch (key) {
                //    case "cin":
                //        k = "<?php //echo $cin;?>//";
                //        break;
                //    case "cout":
                //        k = "<?php //echo $cout;?>//"
                //        break;
                //
                //}
                //alert(k);
                
                if(key=="cin"){
                    window.location.href='http://localhost/MyB&B/public/checkin/guest';
                }
            },
            items: {
                "cin": {name: "Check", icon: "fa-check-circle"},
                "cout": {name: "Check Out", icon: "cut"},
                "quit1": "-----------",

                "assign": {name: "Assign"},
                "unsign": {name: "Un Assign"},
                "sep1": "---------",
                // "quit": {name: "Quit", icon: function(){
                //     return 'context-menu-icon context-menu-icon-quit';
                // }
                // }
            }
        });
    });

    // $(document).ready(function () {
    //     createCookie("height", $(window).height(), "10");
    // });

    function createCookie(name, value, days) {
        var expires;
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toGMTString();
        } else {
            expires = "";
        }
        document.cookie = escape(name) + "=" + escape(value) + expires + "; path=/";
    }
</script>
<form action="">
    <input type="hidden" name="keys" id="k">
</form>
<?php
if(isset($_REQUEST['keys'])){
    echo "almost done";
}
?>