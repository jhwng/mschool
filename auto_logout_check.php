<?php
session_start();

if (isset($_SESSION['timeout']) && $_SESSION['timeout'] != 0) {
    // time() returns # seconds since epoch
    $session_life = time() - $_SESSION['timeout'];
    //echo "session life: $session_life";
        // Set a 5-minute timeout
        if($session_life > 5*60) {
            $_SESSION['timeout'] = 0;
            echo "0";
        }
        else {
            echo "1";
        }
}
else {
    //echo "auto-logout reset session time";
    $_SESSION['timeout'] = time();
    echo "1";
}
?>