<?php

$date = "2007-11-29";
list($yyyy, $mm, $dd) = split('[/.-]', $date);
echo date("w", mktime(0,0,0,$mm,$dd,$yyyy));
?> 