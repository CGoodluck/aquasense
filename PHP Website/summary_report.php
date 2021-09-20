<!--
summary_report.php
Aquasense

Created by Christopher Goodluck on 05/01/2021.
Copyright (c) 2021 All rights reserved.
-->

<?php

  date_default_timezone_set("Etc/GMT+4");
  $yesterday = date('Y-m-d',strtotime("-1 days"));

  $current = date('G:i');
  $time = "06:00";
  $time1 = "06:01";
  $time2 = "06:02";
  $time3 = "06:03";
  $time4 = "06:04";
  $time5 = "06:05";

  if ($current == $time1 || $current == $time2 || $current == $time3 || $current == $time4 || $current == $time5){
    
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

    //$sql = "SELECT * FROM `sensors`";

    $sql_min_wtemp = "SELECT MIN(wtemp) AS `Min` FROM sensors WHERE date = $yesterday";
    $sql_max_wtemp = "SELECT MAX(wtemp) AS `Max` FROM sensors WHERE date = $yesterday";
    $sql_min_ph = "SELECT MIN(ph) AS `Min` FROM sensors WHERE date = $yesterday";
    $sql_max_ph = "SELECT MAX(ph) AS `Max` FROM sensors WHERE date = $yesterday";
    $sql_min_wlevel = "SELECT MIN(wlevel) AS `Min` FROM sensors WHERE date = $yesterday";
    $sql_max_wlevel = "SELECT MAX(wlevel) AS `Max` FROM sensors WHERE date = $yesterday";
    $sql_min_atemp = "SELECT MIN(atemp) AS `Min` FROM sensors WHERE date = $yesterday";
    $sql_max_atemp = "SELECT MAX(atemp) AS `Max` FROM sensors WHERE date = $yesterday";
    $sql_min_humidity = "SELECT MIN(humidity) AS `Min` FROM sensors WHERE date = $yesterday";
    $sql_max_humidity = "SELECT MAX(humidity) AS `Max` FROM sensors WHERE date = $yesterday";
    $sql_min_light = "SELECT MIN(light) AS `Min` FROM sensors WHERE date = $yesterday";
    $sql_max_light = "SELECT MAX(light) AS `Max` FROM sensors WHERE date = $yesterday";

    $sql_email = "SELECT * FROM `owners` WHERE `id` = $sid";  

    if ($result = $conn->query($sql_min_wtemp)) {
      while ($row = $result->fetch_assoc()) {

        $min_wtemp = $row['Min'];
      }
    }

    if ($result = $conn->query($sql_max_wtemp)) {
      while ($row = $result->fetch_assoc()) {

        $max_wtemp = $row['Max'];
      }
    }

    if ($result = $conn->query($sql_min_ph)) {
      while ($row = $result->fetch_assoc()) {

        $min_ph = $row['Min'];
      }
    }

    if ($result = $conn->query($sql_max_ph)) {
      while ($row = $result->fetch_assoc()) {

        $max_ph = $row['Max'];
      }
    }

    if ($result = $conn->query($sql_min_wlevel)) {
      while ($row = $result->fetch_assoc()) {

        $min_wlevel = $row['Min'];
      }
    }

    if ($result = $conn->query($sql_max_wlevel)) {
      while ($row = $result->fetch_assoc()) {

        $max_wlevel = $row['Max'];
      }
    }

    if ($result = $conn->query($sql_min_atemp)) {
      while ($row = $result->fetch_assoc()) {

        $min_atemp = $row['Min'];
      }
    }

    if ($result = $conn->query($sql_max_atemp)) {
      while ($row = $result->fetch_assoc()) {

        $max_atemp = $row['Max'];
      }
    }

    if ($result = $conn->query($sql_min_humidity)) {
      while ($row = $result->fetch_assoc()) {

        $min_humidity = $row['Min'];
      }
    }

    if ($result = $conn->query($sql_max_humidity)) {
      while ($row = $result->fetch_assoc()) {

        $max_humidity = $row['Max'];
      }
    }

    if ($result = $conn->query($sql_min_light)) {
      while ($row = $result->fetch_assoc()) {

        $min_light = $row['Min'];
      }
    }

    if ($result = $conn->query($sql_max_light)) {
      while ($row = $result->fetch_assoc()) {

        $max_light = $row['Max'];
      }
    }

    if ($result = $conn->query($sql_email)) {
      while ($row = $result->fetch_assoc()) {

        //$name = $row['first_name'] . " " . $row['last_name'];
        $email = $row['email'];

        //echo $name . " " . $email;
      }
    }

    $to = $email;
    $subject = "Daily AquaSense Report";

    $message = "
    <html>
    <head>
    <style>
    table, th, td {
      border: 1px solid black;
      border-collapse: collapse;
    }
    th, td {
      padding: 15px;
      text-align: center;
      background-color: #d1dfe3;
    }
    th { background-color: #9ad2e3;}
    
    #t01 { width: 70%;} 
    
    </style>
    </head>
    <body>
    
    <h3>Hey there,</h3>
    <p>See your Daily Report below.</p>
    
    <h2>AquaSense Summary Report</h2>
            
    <table id=\"t01\">
      <tr>
        <th>Sensor</th>
        <th>Lowest</th> 
        <th>Highest</th>
    
      </tr>
      <tr>
        <td>Water Temperature</td>
        <td>$min_wtemp</td>
        <td>$max_wtemp</td>
    
      </tr>
      <tr>
        <td>pH</td>
        <td>$min_ph</td>
        <td>$max_ph</td>
      </tr>
      <tr>
        <td>Water Level</td>
        <td>$min_wlevel</td>
        <td>$max_wlevel</td>
      </tr>
      <tr>
        <td>Air Temperature</td>
        <td>$min_atemp</td>
        <td>$max_atemp</td>
      </tr>
      <tr>
        <td>Humidity</td>
        <td>$min_humidity</td>
        <td>$max_humidity</td>
      </tr>
      <tr>
        <td>Light</td>
        <td>$min_light</td>
        <td>$max_light</td>
      </tr>
    </table>
    <br><hr>
        <footer>
            This is an automated reply generated by AquaSense. Do not reply. <br> Email: aquasense246@gmail.com for customer support.
        </footer>
    </body>
    </html>"
    ;

    $headers = "From: Aquasense <aquasense246@gmail.com>\r\n";
    $headers .= "Reply-To: no-reply@aquasense.com\r\n";
    $headers .= "Content-type: text/html \r\n";

    mail($to, $subject, $message, $headers);

    echo "Email Sent";
    
  }
  else{
    echo "Daily Report Not Sent";
  }
?>