<?php

$myFile = "c:/tmp/testFile.txt";
$fh = fopen($myFile, 'a') or die("can't open file");
$stringData = "New Stuff 1\n";
fwrite($fh, $stringData);
$stringData = '"name one","name 2"' . "\n";
fwrite($fh, $stringData);
fclose($fh);

?>