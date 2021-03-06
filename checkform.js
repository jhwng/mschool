var ratesWindow;
var friendsWindow;
var studentErrorWindow;
var parentsErrorWindow;
var nameSearchWindow;

function stopRKey(evt) {
  var evt = (evt) ? evt : ((event) ? event : null);
  var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
  if ((evt.keyCode == 13) && (node.type=="text"))  {return false;}
}

document.onkeypress = stopRKey;

function isPositiveNumber (inputVal) {
	var oneDecimal = false;
	inputStr = inputVal.toString();
	for ( var i = 0; i < inputStr.length; i++ ) {
		var oneChar = inputStr.charAt(i);
		if ( i == 0 && oneChar == "-" ) {
			return false
		}
		if ( oneChar == "." && !oneDecimal ) {
			oneDecimal = true;
			continue
		}
		if ( oneChar < "0" || oneChar > "9" ) {
			return false
		}
	}
	return true
}

function checkDateFormat (form, date1) {
	if (date1.value == "" ) { return true }
	var date2=date1.value.replace(/[.|\/]/, "-");
	var date2=date2.replace(/[.|\/]/, "-");
	if ( date2 == "today" ) { 
	    today = new Date();
		mm = today.getMonth() + 1;
		date2 = today.getFullYear() + "-" + mm + "-" + today.getDate() 
	}
	if ( date2.length <= 5 ) {
		var today=new Date();
        var thisYear=today.getFullYear();
		var date3 = thisYear + "-" + date2;
	}
	else {
		var date3 = date2;	
	}
	var day, month, year;
	var datePat = /^(\d{2,4})([.|\/|-])(\d{1,2})([[.|\/|-])(\d{1,2})$/;

	var matchArray = date3.match(datePat);

	if (matchArray == null) {
		alert ('Invalid Date Format');
		date1.focus();
		return false;
	}                                                   

	day = matchArray[5]; // p@rse date into variables
	month = matchArray[3];
	year = matchArray[1];
	if ( year.length == 2 ) { year1 = "20" + year; year = "20" + year } else { year1 = year }
	if ( month.length == 1 ) { month1 = "0" + month } else { month1 = month }
	if ( day.length == 1 ) { day1 = "0" + day } else { day1 = day }

	month--;
	dteDate=new Date(year,month,day);
	if( ((day==dteDate.getDate()) && (month==dteDate.getMonth()) && (year==dteDate.getFullYear())) )
	{
		date1.value = year1 + "-" + month1 + "-" + day1;
	    //jng - if ( date1.value <= '1900-01-01' ) {
		//jng - now is 2018, so let's put 2028 as the limit. If we're still
		//      in biz after 10 years, then it's a good problem to have :-)
        if ( date1.value <= '2012-01-01' || date1.value > '2028-01-01') {
		   alert ('Invalid Date Format');
		   date1.focus();
		   return false;
	    }
		return true;
	}
	else {
		alert ('Invalid Date Format');
		date1.focus();
		return false;
	}
}

function checkTimeFormat(form, time2) {
  	var time1 = time2.value;
    if (time1 == "" ) { alert('Please specify time');  return false; }
	var colonpos=time1.search(/[:|.]/);
	var ampmpos=time1.search(/[AM|PM|am|pm]/);
	/* time is in hh[am|pm] format */
	if ( colonpos == -1 && ( ampmpos == 1 || ampmpos == 2) ) {
		var hh=time1.slice(0,ampmpos);
		var mm="00";
		var ampm=time1.substr(ampmpos,2);
	}
	else {
	   if ( colonpos < 1 || ampmpos < 3 ) { alert('Invalid Time Format'); return false; }
	   var hh=time1.slice(0,colonpos);
       var mm=time1.slice(colonpos+1,ampmpos);
	   var ampm=time1.substr(ampmpos,2);
	}
	if (( !(isPositiveNumber(hh)) || hh < 1 || hh > 12 || hh.length > 2 ) || ( !(isPositiveNumber(mm)) || mm < 0 || mm > 59 || mm.length > 2 ) || ( ampm != "am" && ampm != "pm" && ampm != "AM" && ampm != "PM" )) { alert('Invalid Time Format'); return false; }
	time1 = hh + ":" + mm + ampm;
	time2.value = time1;
	return true;
}

function check_class_schedule_form(form, isManager) {
    /* jng - WTF?? Where's all the checking logic?
	   from Davina: it could be intentional so that they can easily
	   override things in "special cases". */

    /* jng - perhaps we should let ONLY Managers to ignore checks? */
	if (isManager) {
      //alert("Manager: check_class_schedule_form() called");
	} else {
      //alert("Employee: check_class_schedule_form() called");
	}

    //return false;
	return true;
}

function check_costs(form, confirmWarning, isManager) {
    var ext_rate = parseFloat(form.ext_rate.value);
    if ( isNaN(ext_rate) || ext_rate <= 0 ) {
        alert('Invalid External Rate. Must be a numeric > 0');
        form.ext_rate.select();
        return false;
    }
    var internal_cost = parseFloat(form.internal_cost.value);
    var internal_cost_override = parseFloat(form.internal_cost_override.value); //jng

    //jng
    //if ( isNaN(internal_cost) || internal_cost <= 0 ) { alert('Invalid Internal Cost'); form.internal_cost.focus(); return false; }
    if (//!isManager && form.internal_cost.value == "" || //jng - don't remember why I added this condition for... doesn't seem to make any sense
        //(isNaN(internal_cost) && form.internal_cost.value != "") || //jng - don't remember why internal_cost can be "" either...
        isNaN(internal_cost) || internal_cost <= 0 ) {
        alert('Invalid database "Internal Cost". Must be a numeric > 0');
        form.internal_cost.select();
        return false;
    }

    //jng - for Manager-user internal_cost_override cannot be "-", it must be a numeric.
    if ((isManager && isNaN(internal_cost_override)) ||
		(form.internal_cost_override.value != "-" &&
         (isNaN(internal_cost_override) || internal_cost_override <= 0))) {
        alert('Invalid "Internal Cost". Must be a numeric > 0');
        form.internal_cost_override.select();
        return false;
    }

    //if (form.cost_type.value != "S" && form.cost_type.value != "F" ) { alert('Cost Type Must be "S" or "F"'); form.cost_type.focus(); return false; }
    //if (form.cost_type.value != "-" && form.cost_type.value != "S" && form.cost_type.value != "F" ) {
    if (//!isManager && form.cost_type.value == "" || //jng - don't remember why cost_type can be "" for Manager...
        //form.cost_type.value != "" && form.cost_type.value != "S" && form.cost_type.value != "F" ) {
		(form.cost_type.value != "S" && form.cost_type.value != "F")) {
        alert('Invalid database "Cost Type". Must be "S" or "F"');
        form.cost_type.select();
        return false;
    }

    //jng - for Manager-user cost_type_override should NOT be "-".
    if ((isManager && form.cost_type_override.value == "-" ) ||
		(form.cost_type_override.value != "-" &&
         form.cost_type_override.value != "S" && form.cost_type_override.value != "F")) {
        alert('Invalid "Cost Type". Must be "S", or "F"');
        form.cost_type_override.select();
        return false;
    }

    //jng
    // If cost_type/cost_type_override == "F", check external rate <= internal_cost/internal_cost_override
    var cost_type_check = form.cost_type_override.value;
    if (cost_type_check == "-" ||
		(cost_type_check != "F" && cost_type_check != "S")) {
        cost_type_check = form.cost_type.value;
    }

    var internal_cost_check = internal_cost;
    if (!isNaN(internal_cost_override)) { // if internal_cost_override is a numeric
        internal_cost_check = internal_cost_override;
    }

    if (cost_type_check == "F") {
        if (ext_rate <= internal_cost_check) {
            //alert ("Invalid \"External Rate\":\nFor \"Fixed Cost Type\" it must be greater than \"Internal Cost\".\n\nPlease check with School Admin.");
            if (confirmWarning) {
              if (!confirm("WARNING: Abnormal \"External Rate\".\n\nContinue?")) {
                form.ext_rate.select();
                return false;
              }
            }
            else {
              alert("WARNING: Abnormal \"External Rate\".\n\nPlease check with School Admin.");
              form.ext_rate.select();
              return false;
            }
        }
    }
    else if (cost_type_check == "S") {
        if (internal_cost_check >= 100) {
            if (confirmWarning) {
                if (!confirm("WARNING: Abnormal \"Internal Cost\":\nFor \"Split Cost Type\" it should be less than 100.\n\nContinue?")) {
                    form.internal_cost_override.select();
                    return false;
			    }
            }
            else {
                alert("WARNING: Abnormal \"Internal Cost\":\nFor \"Split Cost Type\" it should be less than 100.\n\nPlease check with School Admin.");
                form.internal_cost_override.select();
                return false;
            }
        }
    }

	return true;
}

function check_student_form(form, source, isManager) {
	var fullname=form.full_name.value;
	var pos=fullname.indexOf(",");
	if (pos < 0 ) { 
	  alert('Student name must be in Last Name, First Name format. Missing ","');
	  form.full_name.focus();
	  return false;
	}
	
	if (form.parents_names.value == "" ) {
	  alert('Please enter Parents names');
	  form.parents_names.focus();
	  return false;
	}

	if (form.home_tel.value == "") {
	  alert('Please enter Home Phone');
	  form.home_tel.focus();
	  return false;
	}

	if (form.discount.value < 0 || form.discount.value > 100 ) {
	  alert('Discount must be between 0 and 100');
	  form.discount.focus();
	  return false;
	}

//	if (form.course_name.value == "None" ) { alert('Please select a course'); form.course_name.focus(); return false; }
    
    if ( source == "create" ) {
	  if (form.course_name.value != "None" ) {

        //jng
        var costIsValid = check_costs(form, false, isManager);
        if (costIsValid == false) {
          return false;
		}

	    var thisTime = document.form1.time;
	    var result = checkTimeFormat(form, thisTime);
	    if ( result == false ) {
	      form.time.select();
	      return false;
	    }

	    /* jng: that's not the right way to compare dates man!
	    if (form.start_date.value > form.end_date.value ) {
	      alert('Start Date Must be earlier than End Date');
	      return false;
	    }*/

        if (!checkStartEndDates(form, form.start_date, form.end_date)) {
        	return false;
		}
      }
    }

    return true;
}

//Bjng
function validateStartEndDates(form, start_date, end_date) {
    // Check to make sure end date > start date
    var startDate = new Date(start_date.value);
    var endDate = new Date(end_date.value);

    // Only do the comparison if both start & end dates are valid dates
    if (!isNaN(startDate) && !isNaN(endDate)) {
        if (startDate > endDate) {
            start_date.select();
            alert('Error: \"Start Date\" must be the same or earlier than \"End Date\"');
            return false;
        }
    }

    return true;
}

function checkStartEndDates(form, start_date, end_date) {
	// start_date and end_date are form objects (not extracted values)
    if (start_date.value == "") {
        alert ('Error: Missing \"Start Date\"');
        start_date.select();
        return false;
    }

    if (end_date.value == "") {
        alert ('Error: Missing \"End Date\"');
        end_date.select();
        return false;
    }

    rc = checkDateFormat(form, start_date);
    if (!rc) {
        return false;
    }

    rc = checkDateFormat(form, end_date);
    if (!rc) {
        return false;
    }

    // Check to make sure end date > start date
    var startDate = new Date(start_date.value);
    var endDate = new Date(end_date.value);

    if (startDate > endDate) {
    	start_date.select();
        alert ('Error: \"Start Date\" must be the same or earlier than \"End Date\"');
        return false;
    }

    return true;
}
//Ejng

function lookupTeacherRateForClass (form, teacherName, courseName, rowNum) {
	if (ratesWindow) { ratesWindow.close(); }
	var url="teacher_select_rate.php?teacher=" + teacherName + "&course=" + courseName + "&fromPage=classSchedule&rowNum=" + rowNum; 
	ratesWindow=window.open(url,"teacherRate","location,status,resizable=yes,scrollbars,toolbar,menubar,HEIGHT=500,WIDTH=800");
	ratesWindow.focus();
}
	

function lookup_teacher_rate(form) {
	var tname=form.teacher.value;
	var course=form.course_name.value;
	if (course=="None") { alert('Please select a Course for the rate lookup'); return }
	if (ratesWindow) { ratesWindow.close(); }
	var url="teacher_select_rate.php?teacher=" + tname + "&course=" + course + "&fromPage=student&rowNum=NA"; 
	ratesWindow=window.open(url,"teacherRate","location,status,resizable=yes,scrollbars,toolbar,menubar,HEIGHT=500,WIDTH=800");
//	form.time.focus();
	ratesWindow.focus();
}

function lookupTeacherRateForAddClasses(form) {
	var tname=form.teacher.value;
	var course=form.course_name.value;
	if (course=="None") { alert('Please select a Course for the rate lookup'); return }
	if (ratesWindow) { ratesWindow.close(); }
	var url="teacher_select_rate.php?teacher=" + tname + "&course=" + course + "&fromPage=addClasses&rowNum=NA"; 
	ratesWindow=window.open(url,"teacherRate","location,status,resizable=yes,scrollbars,toolbar,menubar,HEIGHT=500,WIDTH=800");
//	form.time.focus();
	ratesWindow.focus();
}

function lookup_friends(form) {
	var friends=form.related_friends.value;
	var fullname=form.full_name.value;
	var url="related_friends.php?friends=" + friends + "&fullname=" + fullname;
	if (friendsWindow) { friendsWindow.close(); }
	friendsWindow=window.open(url,"friends","location,status,resizable=yes,scrollbars,toolbar,menubar,HEIGHT=500,WIDTH=800");
	friendsWindow.focus();

	return;
}

function studentNameConflict(full_name,name_tie_breaker,parents_names,home_tel) {
    var url="student_name_conflict.php?fullname=" + full_name + "&tiebreaker=" + name_tie_breaker + "&pnames=" + parents_names + "&hometel=" + home_tel;
	if (studentErrorWindow) { studentErrorWindow.close(); }
	studentErrorWindow=window.open(url,"studentErr","location,status,resizable=yes,scrollbars,toolbar,menubar,HEIGHT=500,WIDTH=800");
	studentErrorWindow.focus();

	return;
}

function checkParentsNames(form) {
	var fullname = escape(form.full_name.value, 1);
	var pnames = escape(form.parents_names.value, 1);
	var url = "parents_names_conflict.php?pnames=" + pnames;
	var hometel = form.home_tel.value;
	if ( hometel.length > 0 ) { url += "&hometel=" + escape(hometel, 1); }
	if ( fullname.length > 0 ) { url += '&fullname=' + fullname; }
	if (parentsErrorWindow) { parentsErrorWindow.close(); }
	parentsErrorWindow=window.open(url,"parentsErr","location,status,resizable=yes,scrollbars,toolbar,menubar,HEIGHT=500,WIDTH=800");
	parentsErrorWindow.focus();

	return;
}

function studentNameSearch(form) {
	var thisname = escape(form.full_name.value, 1);
	var url = "student_name_search.php?name=" + thisname;
	if (nameSearchWindow) { nameSearchWindow.close(); }
	nameSearchWindow=window.open(url,"nameSearch","location,status,resizable=yes,scrollbars,toolbar,menubar,HEIGHT=500,WIDTH=800");
	nameSearchWindow.focus();

	return;
}

function teacherNameSearch(form) {
	var thisname = escape(form.teacher.value, 1);
	var url = "teacher_name_search.php?name=" + thisname;
	if (nameSearchWindow) { nameSearchWindow.close(); }
	nameSearchWindow=window.open(url,"nameSearch","location,status,resizable=yes,scrollbars,toolbar,menubar,HEIGHT=500,WIDTH=800");
	nameSearchWindow.focus();

	return;
}

function stripSpaces(form) {
	var postalcode = form.postal_code.value;
	postalcode = postalcode.replace(/ /g,"");
	form.postal_code.value = postalcode;
}
