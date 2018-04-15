<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">


/* caption determines the style of 
   the month/year banner above the calendar. */ 

caption  
     { 
     font-family:arial,helvetica;  
     font-size:12px;  
     color: black; 
     font-weight: bold; 
     } 

/* .calendar determines the overall formatting style of the calendar,   
   acting as the default unless later overruled. */ 

.calendar  
     { 
     font-family:arial, helvetica;  
     font-size:11px;  
     color: #000000; 
/*     border-style: solid; 
     border-width: 1px;  */
	 width: 220px;
	 border:1px grey;

     } 

/* .calendarlink determines the formatting of those days linked to 
   content. */ 

.calendarlink  
     { 
     color: white; 
     } 

/* .header determines the formatting of the weekday headers at the top 
   of the calendar. */ 

.header  
     {
	font-family:arial, helvetica;
	font-size:11px;
	background-color: #CCCCCC;
     } 
	 
.holiday
     {
	font-family:arial, helvetica;
	font-size:11px;
	background-color: #CCCCCC;
     } 
	 	 

/* .day determines the formatting of each day displayed in the 
   calendar. */ 

.day  
     {
	font-family:arial, helvetica;
	font-size:11px;
     } 

/* .linkedday determines the formatting of a date to which content is 
   available. */ 

.linkedday  
     { 
     background-color: #8080ff; 
     border-color: #000000; 
     border-style: solid; 
     border-width: 1px; 
     text-align: center 
     } 
</style>

<?php 

function build_calendar($month,$year) { 

     // Create array containing abbreviations of days of week. 
     $daysOfWeek = array('Su','Mo','Tu','We','Th','Fr','Sa'); 

     // What is the first day of the month in question? 
     $firstDayOfMonth = mktime(0,0,0,$month,1,$year); 

     // How many days does this month contain? 
     $numberDays = date('t',$firstDayOfMonth); 

     // Retrieve some information about the first day of the 
     // month in question. 
     $dateComponents = getdate($firstDayOfMonth); 

     // What is the name of the month in question? 
     $monthName = $dateComponents['month']; 

     // What is the index value (0-6) of the first day of the 
     // month in question. 
     $dayOfWeek = $dateComponents['wday']; 

     // Create the table tag opener and day headers 

     $calendar = "<table class='calendar' border='1' cellpadding='0' cellspacing='0'  bordercolor='#999999'>"; 
     $calendar .= "<caption>$monthName $year</caption>"; 
     $calendar .= "<tr>"; 

     // Create the calendar headers 

     foreach($daysOfWeek as $day) { 
          $calendar .= "<th class='header'>$day</th>"; 
     }  

     // Create the rest of the calendar 

     // Initiate the day counter, starting with the 1st. 

     $currentDay = 1; 

     $calendar .= "</tr><tr>"; 

     // The variable $dayOfWeek is used to 
     // ensure that the calendar 
     // display consists of exactly 7 columns. 

     if ($dayOfWeek > 0) {  
          $calendar .= "<td colspan='$dayOfWeek'>&nbsp;</td>";  
     } 

     while ($currentDay <= $numberDays) { 

          // Seventh column (Saturday) reached. Start a new row. 

          if ($dayOfWeek == 7) { 

               $dayOfWeek = 0; 
               $calendar .= "</tr><tr>"; 

          } 
/*
         // Is the $currentDay a member of $dateArray? If so, 
         // the day should be linked. 

         if (in_array($currentDay,$dateArray)) { 

            $date = "$year-$month-$currentDay"; 

            $calendar .= "<td class='linkedday'> 
                       <a href='blogs.php?date=$date' 
                       class='calendarlink'>$currentDay</a></td>"; 

          // $currentDay is not a member of $dateArray. 

          } else { 

               $calendar .= "<td class='day'>$currentDay</td>"; 

          } 
*/

           $calendar .= "<td class='day'>$currentDay</td>"; 

          // Increment counters 
  
          $currentDay++; 
          $dayOfWeek++; 

     } 

     // Complete the row of the last week in month, if necessary 

     if ($dayOfWeek != 7) {  
      
          $remainingDays = 7 - $dayOfWeek; 
          $calendar .= "<td colspan='$remainingDays'>&nbsp;</td>";  

     } 

     $calendar .= "</table>"; 

     return $calendar; 

} 

?> 

</head>


<body>
<?php $action = $_GET['action']; ?>

<?php if ( $action <> 2 ) {
$aaa =<<<EOD
<form id="form1" name="form1" method="post" action="phpcalendar2.php?action=2">
  <p>Start Month: 
    <input name="month" type="text" id="month" size="2" maxlength="2" />
    <br />
    Year: 
    <input name="year" type="text" id="year" size="4" maxlength="4" />
    <br />
    How many months: 
    <input name="number" type="text" id="number" size="2" maxlength="2" />
	  <input type="submit" name="Submit" value="Submit" />

  </p>
</form>
EOD;
echo $aaa;
}

else {
$aaa =<<<EOD
<table border="0" cellspacing="0" cellpadding="2" width="600px">
<tr valign="top">
EOD;
echo $aaa;
$col=1;
$i = 1;
$mth = $_POST['month'];
$yr = $_POST['year'];

while ( $i <= $_POST['number'] ) {
if ($col > 3) {echo "</tr><tr valign='top'>"; $col = 1;}
$aaa =<<<EOD
<td width="33%">
  <div align="center">
EOD;
echo $aaa;

$result = build_calendar($mth, $yr); 
echo $result;
echo "  </div></td>";

$i = $i + 1;
$col = $col + 1;
if ( $mth == 12 ) { $mth = 1; $yr = $yr + 1; }
else { $mth = $mth + 1; }
}
echo "</tr></table> ";
}
?>

</body>
</html>