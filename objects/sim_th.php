<?php

/* This is a temperature simulator. This code is going to generate random (consistant) values for humidity and temperature. The information is stored into a MySQL table.  
   12.2022 First version
   Author: Ermanno Lo Cascio
   
*/

// Include database procedural 
include_once '../config/database_procedural.php';

    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    $temp = rand(15,35);
    $hr = rand(60,90);
    $note = "temp-HR-ext";
    $timestamp = date("m/d/Y h:i:s a", time());
 
    $sql1 = "INSERT INTO `th_measurments`( `temperature`, `humidity`, `note`, `timestamp` ) 
    VALUES ('$temp', '$hr', '$note', '$timestamp')";
    if (mysqli_query($conn, $sql1)) {
        //echo "Pushed:" .$entry. "</br>";
    } 
    else {
   // echo json_encode(array("statusCode"=>201));
    }

    mysqli_close($conn);

      
   ?>
