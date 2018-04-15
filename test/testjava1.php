<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<script type="text/javascript">
function checkdateformat(userinput){
var dateformat = /^\d{1,2}(\-|\/|\.)\d{1,2}\1\d{4}$/
return dateformat.test(userinput) //returns true or false depending on userinput
}

</script>

<script type="text/javascript">
if ( checkdateformat("12/01/2008") ) { document.write("true") }
else { document.write("false") }
document.write("done")

</script>
</body>
</html>
