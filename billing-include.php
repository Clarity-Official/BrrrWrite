<?php 
$today = date('m-d-Y');
$date1 = $today; 
$date2 = $trialenddate; 

if ($date1 > $date2) {
   //echo "Trial has ended!";
if ($paid == "yes") {
   //echo "Trial ended but paid!";
} else {
   //echo "Trial ended but not paid!";
   header("Location: /settings#billing");  
}
} else {
   //echo "Trial is still active!"; 
}
?> 