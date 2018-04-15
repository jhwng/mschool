 <?php 
// demo array to sort 
$latest_array = array( 
 array('news','1234567890','sdf','asdpojq'), 
 array('news','1234567892','uruy','xbuqiwpo'), 
 array('comment','1234567893','fghj','mjktyu'), 
 array('article','1234567891','cvmo','pjklgg'), 
 array('news','1234567894','qwenb','asbhtyhj'), 
); 
 $sort_field = 1; // enter the number of field to sort 
 // compare function 
 function cmpi($a, $b) 
 { 
     global $sort_field; 
     return strcmp($a[$sort_field], $b[$sort_field]); 
 } 
 // do the array sorting 
 usort($latest_array, 'cmpi'); 
 // demo output 
 echo '<pre>'; 
 print_r($latest_array); 
 echo '</pre>';
 echo $latest_array[0][1]; 
 ?> 
