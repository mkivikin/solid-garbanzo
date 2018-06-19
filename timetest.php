<?php
$date1 = "2018-06-08 17:45:10";
$date2 = "2018-06-08 17:45:11";
$date1 = new DateTime($date1);
$date2 = new DateTime($date2);
if ($date1 <= $date2) {
  echo('date1 väiksem v võrdne');
} else {
  echo('date2 väiksem');
}
 ?>
