<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Delete Cheque Deposit List</title>

<?php
unlink ("cheque_deposit.csv");
$myFile = "cheque_deposit.csv";
$fh = fopen($myFile, 'a') or die("can't open file");
$stringData = "\"Date\",\"Student Name\",\"Cheque No.\",\"Amount\",\"Holder's Name\"" . "\n";
fwrite($fh, $stringData);
fclose($fh);
?>

<link href="main.css" rel="stylesheet" type="text/css" />
</head>

<body>
<p>&nbsp;</p>
<p align="center">The Cheque Deposit List File Has Been Deleted </p>
<p align="center">
  <input name="Button" type="button" class="btn" id="submit" onclick="window.close()"
   onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Close Window"/>
</p>
</body>
</html>
