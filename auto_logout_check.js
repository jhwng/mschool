//alert("auto_logout_check.js");
$(document).ready(function() {
    //alert("auto_logout_check.js ready");
    setInterval(function () {
        //alert("calling auto logout check...")
        $.get("auto_logout_check.php", function (data) {

            if (data == 0) {
                //alert("Your session timed out. Please login in again.");
                window.location.href = "logout.php";
            }
            /*else {
                alert("5: not time's up yet");
            }*/
        });
        //alert("6: Time's up");
    }, 30*1000); // Check every 30 seconds
});