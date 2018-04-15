<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<?php
$row = 1;
$handle = fopen("/tmp/test.csv", "r");
while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
    $num = count($data);
    $row++;
$account_id=$data[0];
$full_name=$data[1];
$course=$data[2];
$grade=$data[3];
$teacher=$data[4];
$external_rate=$data[5];
$internal_cost=$data[6];
$cost_type=strtoupper($data[7]);
$time=$data[8];
$duration=$data[9];
$start_date=$data[10];
$end_date=$data[11];
        echo "account=$account_id" . "<br />\n";
		echo "full_name=$full_name<br>";
		echo "course=$course<br>";
		echo "grade=$grade<br>";
		echo "teacher=$teacher<br>";
		echo "external_rate=$external_rate<br>";
		echo "internal_cost=$internal_cost<br>";
		echo "cost_type=$cost_type<br>";
		echo "time=$time<br>";
		echo "duration=$duration<br>";
		echo "start_date=$start_date<br>";
		echo "end_date=$end_date<br>";
		echo "========================================<br>";
}
fclose($handle);

?>
</body>
</html>
