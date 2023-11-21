<?php

    // Establish connection 
    $con = mysqli_connect("localhost","database_name","password","databasename");
    if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
    }

    // Query data from MySQL
    $sql = "SELECT temperature, humidity FROM th_measurments order by id desc limit 1";
    if ($result = mysqli_query($con, $sql)) {
        // Fetch one and one row
        while ($row = mysqli_fetch_row($result)) {
   
           $temp = $row[0]; // Temperature
           $hr = $row[1]; // Humidity
      
            }
        }

    // Store into an array 
    $outputArray = Array (
        "temp" => $temp,
        "hr" => $hr,
          
        );

      // Encapusulate into a json and echo - this is the output that will be passed to the ajax
      echo json_encode($outputArray);
      
?>
