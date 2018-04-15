<?php
// COMMIT ADD AND EDITS
$error = '';
$link = mysql_connect("localhost", "bp5am", "bp5ampass") 
  or die("Could not connect: " . mysql_error()); 
mysql_select_db('moviesite', $link) 
  or die ( mysql_error()); 
   
switch ($_GET['action']) {
  case "edit":
    switch ($_GET['type']) {
      case "people":
        $sql = "UPDATE people SET " . 
               "people_fullname = '" . $_POST['people_fullname'] . 
               "' WHERE people_id = '" . $_GET['id'] . "'";
        break;
      case "movie":
        $movie_name = trim($_POST['movie_name']);
        if (empty($movie_name)) {
          $error .= "Please+enter+a+movie+name%21%0D%0A";
        }
        if (empty($_POST['movie_type'])) {
          $error .= "Please+select+a+movie+type%21%0D%0A";
        }
        if (empty($_POST['movie_year'])) {
          $error .= "Please+select+a+movie+year%21%0D%0A";
        }
        if (empty($error)) {
          $sql = "UPDATE movie SET " .
             "movie_name = '" . $_POST['movie_name'] . "'," .
             "movie_year = '" . $_POST['movie_year'] . "'," .
             "movie_type = '" . $_POST['movie_type'] . "'," .
             "movie_leadactor = '" . $_POST['movie_leadactor'] . "'," .
             "movie_director = '" . $_POST['movie_director'] . "' " .
             "WHERE movie_id = '".$_GET['id']."'";
        } else {
          header("location:movie.php?action=edit&error=" . 
                 $error . "&id=" . $_GET['id'] );
        }
        break;
    }
    break;
  case "add":
    switch ($_GET['type']) {
      case "people":
        $sql = "INSERT INTO people (people_fullname) " .
               "VALUES ('" . $_POST['people_fullname'] . "')";
        break;
      case "movie":
        $movie_name = trim($_POST['movie_name']);
        if (empty($movie_name)) {
          $error .= "Please+enter+a+movie+name%21%0D%0A";
        }
        if (empty($_POST['movie_type'])) {
          $error .= "Please+select+a+movie+type%21%0D%0A";
        }
        if (empty($_POST['movie_year'])) {
          $error .= "Please+select+a+movie+year%21%0D%0A";
        }
        if (empty($error)) {
          $sql = "INSERT INTO movie (movie_name,movie_year," .
                 "movie_type,movie_leadactor,movie_director) " .
                 "VALUES ('" . $_POST['movie_name'] . "'," .
                 "'" . $_POST['movie_year'] . "'," .
                 "'" . $_POST['movie_type'] . "'," .
                 "'" . $_POST['movie_leadactor'] . "'," .
                 "'" . $_POST['movie_director'] . "')";
        } else {
          header("location:movie.php?action=add&error=" . $error);
        }
        break;
                    
    }
    break;
}
if (isset($sql) && !empty($sql)) {
  echo "<!--".$sql."-->";
  $result = mysql_query($sql)
    or die("Invalid query: " . mysql_error()); 
?>
<p align="center" style="color:#FF0000">
  Done. <a href="index.php">Index</a>
</p>
<?php
}
?>
