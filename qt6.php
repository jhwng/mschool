<?php require_once('Connections/promusic.php'); ?>
<?php
mysql_select_db($database_promusic, $promusic);
$startdate='2007-07-01';
$enddate='2008-06-30';
	
	$query = "SELECT payment_id, teacher_id, date, amount, cheque_num, cheque_name, payment_method, remarks, reference FROM adhoc_payments WHERE date BETWEEN '2007-07-01' AND '2008-06-30'" ;
    echo "$query<br>";
	$result = mysql_query($query, $promusic) or die(mysql_error());
    $numRows_schedule = mysql_num_rows($result);
	
echo "$numRows_schedule<br>";
?>