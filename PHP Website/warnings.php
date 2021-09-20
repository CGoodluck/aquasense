<!--
warnings.php
Aquasense

Created by Christopher Goodluck on 05/01/2021.
Copyright (c) 2021 All rights reserved.
-->

<?php

    $servername = "localhost";
    $dbname = "aqua_sense";
    $username = "root";
    $password = "";
    $sid = 1;

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    echo "Database Connection Successful!<br>";

    $sql = "SELECT * FROM `alerts`";
    $sql_email = "SELECT * FROM `owners` WHERE `id` = $sid";

    if ($result = $conn->query($sql)) {
        while ($row = $result->fetch_assoc()) {

            $row_wtemp_low = $row["wtemp_low"];
            $row_wtemp_high = $row["wtemp_high"];
            $row_atemp_low = $row["atemp_low"];
            $row_atemp_high = $row["atemp_high"];
            $row_ph_low = $row["ph_low"];
            $row_ph_high = $row["ph_high"];
            $row_wlevel = $row["wlevel"];
            $row_light = $row["light"];
            $row_humidity_low = $row["humidity_low"];
            $row_humidity_high = $row["humidity_high"];

            //echo $row_wtemp_low . " " . $row_wtemp_high . " " . $row_ph_low . " " . $row_ph_high;
            //echo $row_wlevel . " " . $row_light . " " . $row_humidity_low . " " . $row_humidity_high;
        }
    }

    if ($result = $conn->query($sql_email)) {
        while ($row = $result->fetch_assoc()) {

            //$name = $row['first_name'] . " " . $row['last_name'];
            $email = $row['email'];

            //echo $name . " " . $email;
        }
    }
    
    $SensorName = "NULL";
    $SensorReading;

    if($_GET['wtemp'] < $row_wtemp_low || $_GET['wtemp'] > $row_wtemp_high){
        
        $SensorName = "Water Temperature Sensor"; 
        $SensorReading = $_GET['wtemp'];           
    }
    //elseif($_GET['atemp'] < $row_atemp_low || $_GET['atemp'] > $row_atemp_high){
        
    //    $SensorName = "Air Temperature Sensor"; 
    //    $SensorReading = $_GET['atemp'];           
    //}
    elseif($_GET['ph'] < $row_ph_low || $_GET['ph'] > $row_ph_high){
        
        $SensorName = "pH Sensor"; 
        $SensorReading = $_GET['ph']; 
    }
    elseif($_GET['wlevel'] == $row_wlevel){
        
        $SensorName = "Water Level Sensor";  
        $SensorReading = $_GET['wlevel'];
    }
    elseif($_GET['light'] == $row_light){
        
        $SensorName = "Light Sensor";  
        $SensorReading = $_GET['light'];
    }
    //elseif($_GET['humidity'] < $row_humidity_low || $_GET['humidity'] > $row_humidity_high){
        
    //    $SensorName = "Humidity Sensor";  
    //    $SensorReading = $_GET['wlevel'];
    //}
    else{
        echo "No Email Sent";
        return;
    }

    $to = $email;
    $subject = "About Your Aquasense Aquarium";

    $message = "<h3>Hey there,</h3>
        <p>You have one new notification from your AquaSense</p>

        <div style=\"text-align: center;\">
                            
            <h2><b>LOW LEVELS</b></h2> 
            <p>Your <h3> " . $SensorName . " </h3> is reading <h1 style=\"color: red;\">" . $SensorReading . "</h1></p>

            <button> <a target=\"_blank\" rel=\"noopener noreferrer\"style=\"text-decoration: none; color: black;\" href=\"http://localhost/aquasense\">Your AquaSense </a></button>

            <p>For more information, click the link above.</p>
        </div>

        <br><hr>
        <footer>
            This is an automated reply generated by AquaSense. Do not reply. <br> Email: aquasense246@gmail.com for customer support.
        </footer>";

    $headers = "From: Aquasense <aquasense246@gmail.com>\r\n";
    $headers .= "Reply-To: no-reply@aquasense.com\r\n";
    $headers .= "Content-type: text/html \r\n";

    mail($to, $subject, $message, $headers);

    echo "Email Sent";

?>