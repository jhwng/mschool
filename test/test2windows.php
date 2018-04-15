<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script language="javascript1.1">
var myWind
function doNew() {
  if (!myWind || myWind.closed) {
    myWind = window.open("lst14-11.htm","subWindow","HEIGHT=200,WIDTH=350")
  }
  else {
    myWind.focus()
  }
}
</script>
</head>
	
<body>
<form id="input" name="input" method="post" >
  <p>Select a color for a new widnow:<br />
    <input name="color" type="radio" value="red" checked="checked" />Red
    <input name="color" type="radio" value="yellow" />
    Yellow
    <input name="color" type="radio" value="blue" />
    Blue
    <br />
    <input name="storage" type="submit" id="storage" value="Make a Windows" onClick="doNew()"/>
  </p>
  <HR>
  This field will be filled from an entry in another window:
  <input type="text" name="entry" size=25 />
</form>
</body>
</html>
