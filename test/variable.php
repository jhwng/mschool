<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<pre>
DEBUG :
<?php
print_r($_GET);
print_r($_POST);
echo "<p>Group Lessons are: ";
echo $_POST['group_lessons'];
?>
</pre>

<?php
$a1=232321;
$a2=2;
$a3="dsafdfasdfdsa";
$i=1;
for ($i = 1; $i <= 3; $i++) {
  $varname="a".$i;
    echo "a" . $i . " = " . $$varname . "<br>"; 

}

?>
</body>
</html>
