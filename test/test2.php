<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<?php
// PHP Calendar Control.
// Use the querystring as a Unix epoch number
// for our initial calendar display.
$qstring = $_GET['dts'];
// If there is no querystring value,
// use the first moment of the first
// day of this month as the epoch number.
echo "dts = " . $_GET['dts'];
if (empty ($qstring)){
$ts = mktime (0, 0, 0, date ('n'), 1, date ('Y'));
echo $ts;
} else {
// First make sure the querystring is numeric only.
if (is_numeric($qstring)){
$ts = $qstring;
echo "qstring = " . $qstring;
} else {
// Some sort of querystring crack effort, perhaps.
// Shut it down, impolitely.
echo "qstring = " . $qstring;
exit();
}
}
?></body>
</html>
