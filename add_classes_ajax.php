<?php include "auth_inc.php"; ?>
<?php require_once('Connections/promusic.php'); ?>
<?php
mysql_select_db($database_promusic, $promusic);
$query_teacher = "SELECT teacher FROM teacher where active = 'Y' or active is NULL or active = '' ORDER BY teacher";
$teacherList = mysql_query($query_teacher, $promusic) or die(mysql_error());
$row_teacher = mysql_fetch_assoc($teacherList);
$totalRows_teacher = mysql_num_rows($teacherList);

// action = 1 - retrieve via POST
// action = 2 - Add
// action = 3 - get course list only
// action = 4 - retrieve  via GET

$action=$_GET['action'];
if ( $action <> "" ) {
  if ( $action <> 4 ) {
    $fullname=$_POST['full_name'];
    $courseName=$_POST['course_name'];
    $startdate=$_POST['start_date'];
    $enddate=$_POST['end_date'];
	$grade=$_POST['grade'];
	$external_rate=$_POST['ext_rate'];
	$internal_cost=$_POST['internal_cost'];
	$cost_type=$_POST['cost_type'];
    $time=$_POST['time'];
    $duration=$_POST['duration'];
    $student_id=$_POST['student_id'];
//    $dow=$_POST['dow'];
    $course_id=$_POST['course_id'];
	$addStartDate=$_POST['add_start_date'];
	$addEndDate=$_POST['add_end_date'];
	$updateCourse=$_POST['details_update'];
	$skipHoliday=$_POST['skip_holiday'];
	$cStartDate=$_POST['c_start_date'];
	$cEndDate=$_POST['c_end_date'];
//	$numClasses=$_POST['num_classes'];
	$teacher=$_POST['teacher'];
	$teacherName = $teacher;
  }
  else {
    $fullname=$_GET['full_name'];
    $startdate=$_GET['start_date'];
    $enddate=$_GET['end_date'];
    $student_id=$_GET['student_id'];
	$courseName=$_GET['course_name'];
  }

  // echo "courseName = $courseName<br>";
  if ( $courseName <> "0" && $courseName <> "" ) {
  $query = "SELECT course_id FROM course WHERE course_name=\"$courseName\";";
  $result = mysql_query($query, $promusic) or die(mysql_error());
  $row = mysql_fetch_array($result);
  extract($row);
  }
}


if ( $startdate == "" ) {
   $curMth = date("m");
   $curYear = date("Y");
   if ( $curMth >= 7 && $curMth <= 12 ) {
     
     $startdate = $curYear . "-07-01";
	 $enddate = $curYear + 1;
	 $enddate .= "-06-30";
   }
   else {
     $startdate = $curYear - 1;
	 $startdate .= "-07-01";
	 $enddate = $curYear . "-06-30";

   }
}

if ( $addStartDate == "" ) $addStartDate = date('Y-m-d');
if ( $addEndDate == "" ) $addEndDate = date('Y-m-d');

list($yyyy, $mm, $dd) = split('[/.-]', $enddate);
if ( $mm >= 7 && $mm <= 12 ) {
  $fromYear = $yyyy;
  $toYear = $yyyy + 1;
}
else {
  $fromYear = $yyyy - 1;
  $toYear = $yyyy;
}
$schYear = $fromYear . "-" . $toYear;

if ( $action == 1 || ( $action == 4 && $course_id <> "" )) {
  $query = "SELECT teacher.teacher as teacherName, student_registered_classes.grade, " .
           "student_registered_classes.start_date as cStartDate, student_registered_classes.end_date as cEndDate, " .
           "student_registered_classes.duration, student_registered_classes.time, " .
		   "student_registered_classes.internal_cost, student_registered_classes.cost_type, " .
		   "student_registered_classes.external_rate, student_registered_classes.dow " .
           "FROM teacher, student_registered_classes " . 
		   "WHERE student_registered_classes.teacher_id=teacher.teacher_id " .
		   "AND student_registered_classes.student_id=$student_id " .
		   "AND student_registered_classes.course_id=$course_id " .
		   "AND student_registered_classes.school_year=\"$schYear\";";
  // echo "$query<br>";
  $result = mysql_query($query, $promusic) or die(mysql_error());
  $row = mysql_fetch_array($result);
  extract($row);
}
?>
<style type="text/css" media="screen">	
body {		font: 11px arial;	}	
.suggest_link {		background-color: #FFFFFF;		padding: 2px 6px 2px 6px;	}	
.suggest_link_over {		background-color: #3366CC;		padding: 2px 6px 2px 6px;	}	#search_suggest {		position: absolute; 		background-color: #FFFFFF; 		text-align: left; 		border: 1px solid #000000;				}		
</style>

<script>
//Gets the browser specific XmlHttpRequest Object
function getXmlHttpRequestObject() {
	if (window.XMLHttpRequest) {
		return new XMLHttpRequest();
	} else if(window.ActiveXObject) {
		return new ActiveXObject("Microsoft.XMLHTTP");
	} else {
		alert("Your Browser Sucks!\nIt's about time to upgrade don't you think?");
	}
}

//Our XmlHttpRequest object to get the auto suggest
var searchReq = getXmlHttpRequestObject();

//Called from keyup on the search textbox.
//Starts the AJAX request.
function searchSuggest() {
	if (searchReq.readyState == 4 || searchReq.readyState == 0) {
		var str = escape(document.getElementById('full_name').value);
		searchReq.open("GET", 'searchSuggest.php?search=' + str, true);
		searchReq.onreadystatechange = handleSearchSuggest; 
		searchReq.send(null);
	}		
}

//Called when the AJAX response is returned.
function handleSearchSuggest() {
	if (searchReq.readyState == 4) {
		var ss = document.getElementById('search_suggest')
		ss.innerHTML = '';
		var str = searchReq.responseText.split("\n");
		for(i=0; i < str.length - 1; i++) {
			//Build our element string.  This is cleaner using the DOM, but
			//IE doesn't support dynamically added attributes.
			var suggest = '<div onmouseover="javascript:suggestOver(this);" ';
			suggest += 'onmouseout="javascript:suggestOut(this);" ';
			suggest += 'onclick="javascript:setSearch(this.innerHTML);" ';
			suggest += 'class="suggest_link">' + str[i] + '</div>';
			ss.innerHTML += suggest;
		}
	}
}

//Mouse over function
function suggestOver(div_value) {
	div_value.className = 'suggest_link_over';
}
//Mouse out function
function suggestOut(div_value) {
	div_value.className = 'suggest_link';
}
//Click function
function setSearch(value) {
	document.getElementById('full_name').value = value;
	document.getElementById('search_suggest').innerHTML = '';
}
</script>
<script>
function getSelectedRadio(buttonGroup) {
   // returns the array number of the selected radio button or -1 if no button is selected
   if (buttonGroup[0]) { // if the button group is an array (one button is not an array)
      for (var i=0; i<buttonGroup.length; i++) {
         if (buttonGroup[i].checked) {
            return i
         }
      }
   } else {
      if (buttonGroup.checked) { return 0; } // if the one button is checked, return zero
   }
   // if we get to this point, no radio button is selected
   return -1;
} // Ends the "getSelectedRadio" function

function checkAddClassFields (form) {
   // returns the value of the selected radio button or "" if no button is selected
   var i = getSelectedRadio(form.skip_holiday);
   var j = getSelectedRadio(form.details_update);
   if ( i == -1 || j == -1 ) 
   {
      alert ('Please specify both Skip Holiday and Update Course Details');
      return false;
   }
   else 
      return true;
} 

</script>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Add Classes</title>

<script type="text/javascript" src="checkform.js"> </script>
<script type="text/javascript" src="calendarDateInput.js">

/***********************************************
* Jason's Date Input Calendar- By Jason Moon http://calendar.moonscript.com/dateinput.cfm
* Script featured on and available at http://www.dynamicdrive.com
* Keep this notice intact for use.
***********************************************/

</script>

<link href="main.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style8 {font-size: 12px}
.style9 {font-size: 14px}
.style11 {color: #000000}
body {
	background-image: url();
}
.style12 {font-size: 10px}
-->
</style>
</head>

<body onLoad='document.form1.full_name.focus()'>
<a name="top"></a>
<! Display the top search form -->
<?php include 'banner1.php'; ?>
<table width="815" height="40" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="83">&nbsp;</td>
    <td width="606" valign="middle"><div align="center"><span class="style2">Add Classes </span></div></td>
    <td width="61">&nbsp;</td>
  </tr>
</table>
<table width="815" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="815"><div align="center">
      <form id="form1" name="form1" method="post" action="bulk_changes.php?action=1">
        <div align="center">
          <table width="772" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="772" height="25" valign="middle"><div align="center"> Student Full Name:
                <input name="full_name" type="text" id="full_name" size="30" maxlength="60"
		  <?php if ($fullname <> "") echo "VALUE=\"" . $fullname . "\";" ?> onkeyup="searchSuggest();" autocomplete="off"/><div id="search_suggest" style="position: absolute; background-color: #FFFFFF; text-align: left; border: 1px solid #000000;"></div>
                <input name="submit2" type="button" class="btn" id="submit2" onClick="studentNameSearch(this.form)" onMouseOver="this.className='btn btnhov'" onMouseOut="this.className='btn'" value="Name Search"/>
                &nbsp;&nbsp;&nbsp;Course:
                <select name="course_name" class="dropdowntext" id="course_name" onChange='document.form1.retrieve.click()'>
                  <?php
	if ( isset($student_id) && $student_id <> "" ) {
	  $query = "select distinct student_registered_classes.course_id, course.course_name " .
	           "from student_registered_classes, course where " .
			   "student_registered_classes.course_id = course.course_id and student_id=$student_id " .
			   "and student_registered_classes.school_year = \"$schYear\" " .
			   "order by course.course_name;";
      // echo "$query<br>";
	  $result = mysql_query($query, $promusic) or die(mysql_error());
      $numRows = mysql_num_rows($result);
	  while ( list ($courseID1, $courseName1) = mysql_fetch_row($result)) {
	     echo "<option value=\"$courseName1\" ";
		 if ( $courseName == $courseName1 || $action == 3 ) { echo 'selected="selected"'; }
		 echo " >$courseName1</option>";
      }
	}
	?>
                </select>
              </div></td>
            </tr>
            <tr>
              <td height="25" valign="middle"><div align="center">
                  <input name="student_id" type="hidden" id="student_id" 
		  <?php if ( $student_id <> "" ) { echo "VALUE=\"$student_id\""; } ?> />
                  <input name="course_id" type="hidden" id="course_id" 
		  <?php if ( $course_id <> "" ) { echo "VALUE=\"$course_id\""; } ?> />
                Start Date:
                <input name="start_date" type="text" id="start_date" size="12" maxlength="12" <?php if ($startdate <> "") echo "VALUE=\"" . $startdate . "\""; ?> onchange='checkDateFormat(form, this)' />
                &nbsp;&nbsp;&nbsp;End Date:
                <input name="end_date" type="text" id="end_date" size="12" maxlength="12" <?php if ($enddate <> "") echo "VALUE=\"" . $enddate . "\""; ?> onchange='checkDateFormat(form, this)' />
                &nbsp;&nbsp;&nbsp;
                <input name="getlist" type="submit" class="btn" id="getlist" 
   onclick='document.form1.action="add_classes.php?action=3"; return true;'
   onmouseover="this.className='btn btnhov'" onMouseOut="this.className='btn'" value="Get Course List"/>
&nbsp;&nbsp;&nbsp;
<input name="retrieve" type="submit" class="btn" id="retrieve" 
   onclick='document.form1.action=&quot;add_classes.php?action=1"; return true;'
   onmouseover="this.className='btn btnhov'" onMouseOut="this.className='btn'" value="Retrieve Course Details"/>
              </div></td>
            </tr>
            <tr>
              <td height="25" valign="middle">&nbsp;</td>
            </tr>
          </table>
        </div>

<?php
// if student only have 1 course registered, retrieve course details right away
if ( $numRows == 1 && $action == 3 ) { echo "<script>document.form1.retrieve.click()</script>"; }
if ( $numRows > 1 && $action == 3 ) { 
    echo "<table width='815' height='40' border='0' cellpadding='0' cellspacing='0'>
  <tr>
    <td width='83'>&nbsp;</td>
    <td width='606' valign='middle'><div align='center'><span class='style2'>Student has registered more than 1 course</span></div></td>
    <td width='61'>&nbsp;</td>
  </tr>
  <tr>
    <td width='83'>&nbsp;</td>
    <td width='606' valign='middle'><div align='center'>Select a course and click the Retrieve button</div></td>
    <td width='61'>&nbsp;</td>
  </tr>
</table>";
}

if ( $action <> 3 && $action <> "" ) {
   require ('add_classes_courseform.php');
   echo "<script>document.courseform.course_name.value=\"$courseName\"; " .
       "document.courseform.course_id.value=\"$course_id\"; " .
	   "document.courseform.student_id.value=\"$student_id\"; " .
	   "document.courseform.full_name.value=\"$fullname\"; " .
	   "document.courseform.start_date.value=\"$startdate\"; " .
	   "document.courseform.end_date.value=\"$enddate\"; " .
	   "document.courseform.c_start_date.value=\"$cStartDate\"; " .
	   "document.courseform.c_end_date.value=\"$cEndDate\"; " .
       "</script>";
}


if ( $action == 2 ) {
  // validate addStartDate and addEndDate range
  $error = 0;
  list($yyyy, $mm, $dd) = split('[/.-]', $addStartDate);
  if ( $mm >= 7 && $mm <= 12 ) {
    $startYear = $yyyy;
  }
  else {
    $startYear = $yyyy - 1;
  }

  list($yyyy, $mm, $dd) = split('[/.-]', $addEndDate);
  if ( $mm >= 7 && $mm <= 12 ) {
    $endYear = $yyyy;
  }
  else {
    $endYear = $yyyy - 1;
  }

  if ( $startYear <> $endYear ) {
    $error = 1;
    echo "<script>alert ('Start Date and End Date CANNOT span across 2 school years');document.courseform.addStartDate.focus()</script>";
  }

  if ( $error == 0 ) {
      // get discount info
	  $query = "SELECT discount, discount_expiry_date FROM student " .
	           "WHERE student_id = $student_id;";
      //    echo $query . "<br>"; 
      $result = mysql_query($query, $promusic) or die(mysql_error());
      $row = mysql_fetch_array($result);
      extract($row);
	  
	  // get teacher_id
	  $query = "SELECT teacher_id FROM teacher " .
	           "WHERE teacher = \"$teacher\";";
      // echo $query . "<br>"; 
      $result = mysql_query($query, $promusic) or die(mysql_error());
      $row = mysql_fetch_array($result);
      extract($row);
	  

	  /* get school holidays and keep it in a an array */
	  $query = "SELECT date from school_holidays order by date;";
      $holidays = mysql_query($query, $promusic) or die(mysql_error());
      while ($row = mysql_fetch_assoc ($holidays)) {
        foreach ($row as $val) {
          $holidayList .= $val . "|";
        }
      }

      /* insert class_schedule */
	  list($yyyy, $mm, $dd) = split('[/.-]', $discount_expiry_date);
	  $discountTimeStamp = mktime(12,0,0,$mm,$dd,$yyyy);
	  list($yyyy, $mm, $dd) = split('[/.-]', $addStartDate);
	  $cTimeStamp = mktime(12,0,0,$mm,$dd,$yyyy);
	  $cDate = $addStartDate;
	  list($yyyy, $mm, $dd) = split('[/.-]', $addEndDate);
	  $eTimeStamp = mktime(12,0,0,$mm,$dd,$yyyy);
	  
      /* find out DOW for startdate */
      list($yyyy, $mm, $dd) = split('[/.-]', $addStartDate);
      $dow = date("w", mktime(12,0,0,$mm,$dd,$yyyy));

	  $classCnt = 0;
	  $i = 1;
	  $sevendays = (7 * 24 * 60 * 60);
	  $holiday = 0;
	  $holidayDates = "";

      /* Start SQL transaction */
      $query = "START TRANSACTION;";
      $result = mysql_query($query, $promusic) or die(mysql_error());

	  while ( $cTimeStamp <= $eTimeStamp ) {
	   if(strstr($holidayList, $cDate) == "" ) { 
	      $isHoliday = 0; 
	   } 
	   else { 
	      $isHoliday = 1; 
		  $holiday=1; 
		  $holidayDates = $holidayDates . $cDate . "  ";
	   }
		  
	    if  ( $cTimeStamp <= $discountTimeStamp && $discount > 0 ) {
		  $rate = $ext_rate * ( 100 - $discount) / 100;
		}
		else {
		  $rate = $ext_rate;
		}
	  
        if ( $skipHoliday <> 1 || $isHoliday == 0 || ( $isHoliday == 1 && $skipHoliday == 0 ) ) 
		{
		  $query_class = "INSERT INTO class_schedule " .
		     "(student_id, course_id, grade, date, time, duration, teacher_id, " .
			 "dow, internal_cost, cost_type, external_rate, user_id) " .
			 "VALUES (\"$student_id\", \"$course_id\", \"$grade\", \"$cDate\", \"$time\", " .
			 "$duration, \"$teacher_id\",\"$dow\", $internal_cost, \"$cost_type\", $external_rate, $thisUserID);";
          // echo $query_class . "<br>"; 
		  $insert_class = mysql_query($query_class, $promusic) or die(mysql_error());
		  $classCnt += 1;
		}

		$i += 1;
		$cTimeStamp = mktime(12, 0, 0, date("m", $cTimeStamp)  , date("d", $cTimeStamp)+7, date("Y", $cTimeStamp));;
		$cDate = date ('Y-m-d', $cTimeStamp);

	  }     /* end while */
	  
	  // Update course details if $updateCourse all
	  if ( $updateCourse == "all" ) 
	  {
        list($yyyy, $mm, $dd) = split('[/.-]', $addStartDate);
        $newDOW = date("w", mktime(12,0,0,$mm,$dd,$yyyy));
		
	    $query = "UPDATE student_registered_classes SET " .
                 "teacher_id=$teacher_id, ";
		
		if ( "$addEndDate" > "$cEndDate" )  { $query .= "end_date=\"$addEndDate\", "; }
		
	    $query .= "dow=$newDOW, time=\"$time\", duration=\"$duration\", grade=\"$grade\", " .
	             "external_rate=$external_rate, internal_cost=$internal_cost, cost_type=\"$cost_type\" " .
	             "WHERE student_id=$student_id AND course_id=$course_id AND school_year=\"$schYear\" ";
        // echo "$query<br>";
        $result = mysql_query($query, $promusic) or die(mysql_error());

	  
	  }  // end if updateCourse == all
	  
	  // Update course details if $updateCourse == enddate
	  if ( $updateCourse == "enddate" && "$addEndDate" > "$cEndDate" ) 
	  {
	    $query = "UPDATE student_registered_classes SET " .
               "end_date=\"$addEndDate\" " .
	           "WHERE student_id=$student_id AND course_id=$course_id AND school_year=\"$schYear\" ";
        // echo "$query<br>";
        $result = mysql_query($query, $promusic) or die(mysql_error());
	  }  // end if updateCourse == enddate
	  
      /* Commit Transactions  */
      $query = "COMMIT;";
      $result = mysql_query($query, $promusic) or die(mysql_error());

	  if ( $holiday == 1 ) {
	     echo "<script>alert ('$classCnt classes added.   $holidayDates fall into holiday schedule')</script>";
	  }
	  else {
	     echo "<script>alert (\"$classCnt classes have been added\")</script>";
	  }
  }  // end if error = 0
}

?>
    </body>
</html>