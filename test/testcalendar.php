<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>

<style type="text/css">

.main {
width:300px;
border:1px solid black;
}

.month {
background-color:white;
font:bold 12px verdana;
color:black;
}

.daysofweek {
background-color:white;
font:bold 12px verdana;
color:black;
}

.days {
font-size: 12px;
font-family:verdana;
color:black;
background-color: white;
padding: 2px;
}
.days #today{
font-weight: bold;
color: red;
}

.holiday {
font-weight: bold;
font-size: 12px;
font-family:verdana;
color:black;
background-color: #DCDCDC;
padding: 2px;

}

</style>


<script type="text/javascript" src="basiccalendar.js">

/***********************************************
* Basic Calendar-By Brian Gosselin at http://scriptasylum.com/bgaudiodr/
* Script featured on Dynamic Drive (http://www.dynamicdrive.com)
* This notice must stay intact for use
* Visit http://www.dynamicdrive.com/ for full source code
***********************************************/

</script> 
</head>

<body>
<script type="text/javascript">

var todaydate=new Date()
var curmonth=todaydate.getMonth()+1 //get current month (1-12)
var curyear=todaydate.getFullYear() //get current year

</script>

<table border="0" cellspacing="0" cellpadding="3">
<tr>
<td width="33%">
<script>
document.write(buildCal(curmonth-1 ,curyear, "main", "month", "daysofweek", "days", 1));
</script></td>
<td width="33%">
<script>
document.write(buildCal(curmonth ,curyear, "main", "month", "daysofweek", "days", 1));
</script></td>
<td width="34%">
<script>
document.write(buildCal(curmonth+1 ,curyear, "main", "month", "daysofweek", "days", 1));
</script></td>
</tr>
</table> 

</body>
</html>
