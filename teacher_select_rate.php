<?php include "auth_inc.php"; ?>
<?php require_once('Connections/promusic.php'); ?>
<?php
$tname = $_GET['teacher'];
$course = $_GET['course'];
$fromPage = $_GET['fromPage'];
$rowNum = $_GET['rowNum'];

mysql_select_db($database_promusic, $promusic);
$query_teacher_rates = "SELECT course.course_name, teacher_rate.rate_category, teacher_rate.external_rate, teacher_rate.split, teacher_rate.fixed_cost, teacher_rate.cost_type FROM (teacher_rate INNER JOIN course ON teacher_rate.course_id = course.course_id) INNER JOIN teacher ON teacher_rate.teacher_id = teacher.teacher_id WHERE teacher.teacher='$tname' and course.course_name = \"$course\" order by course.course_name, rate_category;";
$teacher_rates = mysql_query($query_teacher_rates, $promusic) or die(mysql_error());
/* $row_teacher_rate = mysql_fetch_assoc($teacher_rates); */
$totalRows_teacher_rates = mysql_num_rows($teacher_rates);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Teacher Rate Table</title>
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

<script language="javascript">

function setTeacherRateForClass(ext_rate, split, fixed, cost_type) {
  self.opener.document.form2.Rext_rate<?php echo $rowNum; ?>.value = ext_rate;

  //if (isManager) {
      if (cost_type == "S") {
          self.opener.document.form2.Rcost<?php echo $rowNum; ?>.value = split;
      }
      else {
          self.opener.document.form2.Rcost<?php echo $rowNum; ?>.value = fixed;
      }
      self.opener.document.form2.Rcost_type<?php echo $rowNum; ?>.value = cost_type;
  //}
  /*else {
      self.opener.document.form2.Rcost<?php echo $rowNum; ?>.value = 0"-"
      self.opener.document.form2.Rcost_type<?php echo $rowNum; ?>.value = "-";
  }*/
  window.close();
}

function setTeacherRateStudent(ext_rate, split, fixed, cost_type, isManager) {
  self.opener.document.form1.ext_rate.value = ext_rate;

  if (isManager) {
      if (cost_type == "S") {
          self.opener.document.form1.internal_cost.value = split;
          self.opener.document.form1.internal_cost_override.value = split;
      }
      else {
          self.opener.document.form1.internal_cost.value = fixed;
          self.opener.document.form1.internal_cost_override.value = fixed;
      }
      self.opener.document.form1.internal_cost_override.readOnly = false;

      self.opener.document.form1.cost_type.value = cost_type;

      self.opener.document.form1.cost_type_override.value = cost_type;
      self.opener.document.form1.cost_type_override.readOnly = false;
  }
  else {
      if (cost_type == "S") {
          self.opener.document.form1.internal_cost.value = split;
      }
      else {
          self.opener.document.form1.internal_cost.value = fixed;
      }
      self.opener.document.form1.internal_cost_override.value = "-";

      //jng - can't use "disabled" attribute since disabled input field
      // is not submitted with the form. Use "readOnly" instead.
      //self.opener.document.form1.internal_cost_override.disabled = true;
      self.opener.document.form1.internal_cost_override.readOnly = true;

      self.opener.document.form1.cost_type.value = cost_type;
      self.opener.document.form1.cost_type_override.value = "-";
      self.opener.document.form1.cost_type_override.readOnly = true;
  }

  self.opener.document.form1.cost_type.readOnly = true;     //jng
  self.opener.document.form1.internal_cost.readOnly = true; //jng

  self.opener.document.form1.time.focus();
  window.close();
}
  
function setTeacherRateForAddClasses(ext_rate, split, fixed, cost_type, isManager) {
  self.opener.document.courseform.ext_rate.value = ext_rate;

    if (isManager) {
        if (cost_type == "S") {
            self.opener.document.courseform.internal_cost.value = split;
        }
        else {
            self.opener.document.courseform.internal_cost.value = fixed;
        }
        self.opener.document.courseform.cost_type.value = cost_type;
    }
    else {
        self.opener.document.courseform.internal_cost.value = "-"
        self.opener.document.courseform.cost_type.value = "-";
    }
  self.opener.document.courseform.time.focus();
  window.close();
}

</script>
<link href="main.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style7 {color: #FFFFFF}
.style9 {color: #000000}
.style10 {font-size: 12px; color: #000000;}
body {
	background-color: #F8F8EF;
}
-->
</style>
</head>

<body>
<h4 align="center">
<p><span class="banner_text">Rate Table for <?php echo $tname; ?></span>
  </h3>
</p>
<form action="" method="post" name="form0">
  <table width="700" border="1" align="center" cellpadding="3" cellspacing="0">
    <tr>
      <td width="120" height="22" bgcolor="#FFCF9F" class="style7 bluetext"><span class="style9">Course </span></td>
      <td width="110" bgcolor="#FFCF9F" class="style7 bluetext"><span class="style9">Rate Category </span></td>
      <td width="100" bgcolor="#FFCF9F" class="style7 bluetext"><span class="style9">External Rate </span></td>
      <td width="70" bgcolor="#FFCF9F" class="style7 bluetext"><span class="style9">Split % </span></td>
      <td width="90" bgcolor="#FFCF9F" class="style7 bluetext"><span class="style9">Fixed Cost </span></td>
      <td width="80" bgcolor="#FFCF9F" class="style10">Cost Type </td>
    </tr>
<?php
while (list($course, $category, $ext_rate, $split, $fixed, $type) = mysql_fetch_row($teacher_rates)) {
    //echo "from Page: $fromPage \n";//jng

    echo " <tr>\n";

    //Bjng
	if ( $fromPage == "student" ) {
      /*echo " <td><button class='class'
             onclick='window.location.href='<?php echo \"javascript: setTeacherRateStudent($ext_rate, $split, $fixed, '$type', $UserIsManager);\";?>''>
           $course</button></td>\n";
      */
      $isManager=0;
      if ($UserIsManager) {
          $isManager=1;
      }
      /*echo " <td><button class=\"class\"
           onclick=\"window.location.href=setTeacherRateStudent($ext_rate,$split,$fixed,\"$type\",$isManager);\">$course</button></td>\n" .
           " <td><button class=\"class\" onclick='window.location.href='> $category</button></td>\n";*/

        echo "<td><a href='javascript:void(0)'
               onclick=\"window.location.href=setTeacherRateStudent($ext_rate,$split,$fixed,'$type',$isManager);\">$course</a>
              </td>\n" .
             "<td><a href='javascript:void(0)'
               onclick=\"window . location . href = setTeacherRateStudent($ext_rate, $split, $fixed, '$type', $isManager);\">$category</a>
              </td>\n";

        //echo "  <td><a href=\"javascript: setTeacherRateStudent($ext_rate, $split, $fixed, '$type'); \">$course</a></td>\n" .
        //     "  <td><a href=\"javascript: setTeacherRateStudent($ext_rate, $split, $fixed, '$type'); \">$category</a></td>\n";
	}
	//Ejng

	if ( $fromPage == "classSchedule" ) {
	  echo "  <td><a href=\"javascript: setTeacherRateForClass($ext_rate, $split, $fixed, '$type', $UserIsManager); \">$course</a></td>\n" .
           "  <td><a href=\"javascript: setTeacherRateForClass($ext_rate, $split, $fixed, '$type'); \">$category</a></td>\n";
	}

	if ( $fromPage == "addClasses" ) {
	  echo "  <td><a href=\"javascript: setTeacherRateForAddClasses($ext_rate, $split, $fixed, '$type', $UserIsManager); \">$course</a></td>\n" .
           "  <td><a href=\"javascript: setTeacherRateForAddClasses($ext_rate, $split, $fixed, '$type', $UserIsManager); \">$category</a></td>\n";
	}

	if ($UserIsManager) {
      echo " <td>$ext_rate</td>\n" .
           " <td>$split&nbsp;</td>\n" .
           " <td>$fixed&nbsp;</td>\n" .
           " <td>$type</td>\n" .
           " </tr>\n";
    }
    else {
      echo " <td>$ext_rate</td>\n" .
           " <td>-&nbsp;</td>\n" .
           " <td>-&nbsp;</td>\n" .
           " <td>-</td>\n" .
           " </tr>\n";
    }
}


/* 
while ($row = mysql_fetch_assoc ($teacher_rates)) {
  echo "    <tr>\n";
  foreach ($row as $value) {
    echo "      <td>" . $value . "&nbsp;</td>\n";
  }
  echo "    </tr>\n";
}
*/

?>
  </table>
  <table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><div align="center">
        <input name="Button" type="button" class="btn" id="submit" onClick="window.close()"
   onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Close Window"/>
      </div></td>
    </tr>
  </table>
</form>
</body>
</html>
