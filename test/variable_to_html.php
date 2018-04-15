<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>


</head>

<body>
<?php
function variable_to_html($variable) {
    if ($variable === true) {
        return 'true';
    } else if ($variable === false) {
        return 'false';
    } else if ($variable === null) {
        return 'null';
    } else if (is_array($variable)) {
        $html = "<table border=\"1\">\n";
        $html .= "<thead><tr><td><b>KEY</b></td><td><b>VALUE</b></td></tr></thead>\n";
        $html .= "<tbody>\n";
        foreach ($variable as $key => $value) {
            $value = variable_to_html($value);
            $html .= "<tr><td>$key</td><td>$value</td></tr>\n";
        }
        $html .= "</tbody>\n";
        $html .= "</table>";
        return $html;
    } else {
        return strval($variable);
    }
}
?>

<?php
$meeting = array(
    'title' => 'Sales Meeting',
    'start_time' => array(
        'hours' => 11,
        'minutes' => 15,
        'ampm' => 'am'
    ),
    'end_time' => array(
        'hours' => 1,
        'minutes' => 30,
        'ampm' => 'pm'
    ),
    'attendees' => array(
        array('first_name' => 'Bob', 'last_name' => 'Smith', 'email' => 'bobsmith@email.com'),
        array('first_name' => 'James', 'last_name' => 'Andrews', 'email' => 'jamesandrews@email.com'),
        array('first_name' => 'Tom', 'last_name' => 'Schmoe', 'email' => 'bobsmith@email.com')
    )
);
echo variable_to_html($meeting);
echo "<p>";
 echo variable_to_html(date("M-d-Y", mktime(0,0,0,2,-1,2012)));

?> 

</body>
</html>
