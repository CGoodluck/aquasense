<!--
test.php
Aquasense

Created by Christopher Goodluck on 05/01/2021.
Copyright (c) 2021 All rights reserved.
-->

<?php
    date_default_timezone_set("Etc/GMT+4");

    $row_date = "2021-04-06";
    $row_time = "23:29:11";

    $date = date("j");

    //$date2 = date('d',strtotime($row_date));

    $update = $date-1;

    $ym= date('Y-m');


    //$yesterday = date('Y-m-d',strtotime("-1 days"));
    //echo date('G:i', strtotime($row_time));


    $current = date('G:i');
    $time = "06:00";
    $time1 = "06:01";
    $time2 = "06:02";
    $time3 = "06:03";
    $time4 = "06:04";
    $time5 = "06:05";

    if ($current == $time1 || $current == $time2 || $current == $time3 || $current == $time4 || $current == $time5){
        //include 'summary_report.php';
        echo "sent";
    }
    else{
        echo "Daily Report Not Sent";
    }





    /*if ($date == $date2) {
        echo "Today @ " . date('g:i A',strtotime($row_time));
    }
    else if (($date - 1) == $date2) {
        echo "Yesterday @ " . date('g:i A',strtotime($row_time));
    }
    else if (($date - 2) == $date2 || ($date - 3) == $date2 || ($date - 4) == $date2 || ($date - 5) == $date2) {
        echo date('l',strtotime($row_date)) . " @ ". date('g:i A',strtotime($row_time));
    }
    else {
        echo $row_date . " @ " . date('g:i A',strtotime($row_time));
    }*/
?>