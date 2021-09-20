<!--
connect.php
Aquasense

Created by Christopher Goodluck on 05/01/2021.
Copyright (c) 2021 All rights reserved.
-->

<?php
    
    // ---------------------------------DATABASE-------------------------------//
    
    echo "Database Update! <br>";

    $dbname = 'aqua_sense';
    $dbuser = 'root';  
    $dbpass = ''; 
    $dbhost = 'localhost'; 
    $sid = 1;

    $connect = @mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

    if(!$connect){
        echo "Error: " . mysqli_connect_error();
        exit();
    }

    echo "Database Connection Successful!<br>";

    if (is_null($_GET['wtemp'])){

        echo "Insertion Error! Water Temperature value is Null!";
    }
    else {

        $wtemp = $_GET['wtemp'];
        $ph = $_GET['ph'];
        $wlevel = $_GET['wlevel'];
        $atemp = $_GET['atemp'];
        $humidity = $_GET['humidity'];
        $light = $_GET['light'];

        $query = "INSERT INTO sensors (`sid`, wtemp, ph, wlevel, atemp, humidity, light) VALUES ('$sid', '$wtemp', '$ph', '$wlevel', '$atemp', '$humidity', '$light')";
        
        $result = mysqli_query($connect,$query);
        echo "Insertion Success!<br>";
    }

    // -----------------------------WARNINGS-----------------------------------//
    echo "Sensor Warnings! <br>";

    include "warnings.php";

    // -----------------------------SUMAMRY REPORT--------------------------------//
    echo "Summary Report! <br>";

    include "summary_report.php";

    ?>