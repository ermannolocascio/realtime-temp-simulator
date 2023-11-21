<!-- 
This is the dashboard of the website. Here you can activate the data streamer and access to all other pages
Author Ermanno Lo Cascio 
Date 12.2022 
-->

<!-- Include Header -->
<?php

$pagetitle ='Dashboard';
require_once 'includes/header.php';
?>


 <div class="form-check form-switch">
  <span id='sensor_IoT' style="color:rgb(0, 191, 255);" class="material-symbols-outlined">sensors</span>
  <input class="form-check-input"  type="checkbox" id="stream_data" onchange="stream_data()">  
  <label class="form-check-label" for="flexSwitchCheckChecked" >Stream data</label>
</div>

<script>
  function stream_data(){
   
  // add vibration when the switch is activated
   navigator.vibrate([60]); 

  // Change the color on switch  
  var select =  document.getElementById('stream_data').checked;  

  if(select == true){
    document.getElementById('streamer').hidden = false;
    document.getElementById("sensor_IoT").style.color = "blue";
   }

   if(select == false){
    document.getElementById('streamer').hidden = true;
    document.getElementById("sensor_IoT").style.color = "gray";
   }
    
  }
  
</script>

   <div id='streamer' hidden>
    <div class="row mb-3">
      <div class="col-md-8 themed-grid-col">
      
        <!-- Chart here -->
      <div id="chart_div" style="width:350px;height:180px"></div>
        <!-- End of chart -->
      </div>

  <!-- Include Google Charts loader script -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script>
  // Load the current version of Google Charts with the specified packages
  google.charts.load('current', {
    packages: ['corechart', 'line'],
  });

  // Set a callback function to be executed when the Google Charts API is loaded
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    // Create a data object with default values (initially one data point with zero values)
    let data = google.visualization.arrayToDataTable([
      ['Time', 'Temp', 'HR'],
      [0, 0, 0],
    ]);

    // Create options object for chart customization (background color, legend, series colors, etc.)
    var options = {
      backgroundColor: 'transparent',
      legend: 'none',
      series: {
        0: { color: '#ff2508', lineWidth: 4 },
        1: { color: '#e7711b', lineWidth: 4 },
      },
      vAxis: {
        gridlines: { color: 'transparent' },
      },
      hAxis: {
        gridlines: { color: 'transparent' },
      }
    };

    // Draw the initial chart
    let chart = new google.visualization.LineChart(document.getElementById('chart_div'));
    chart.draw(data, options);

    // Set up variables for data update
    let maxDatas = 50; // Maximum number of data rows to be displayed
    let index = 0; // Index for the x-axis data

    // Set up an interval for adding new data every 1600ms (1.6 seconds)
    setInterval(function () {
      // Instead of generating random data, make an AJAX call to fetch real-time data
      $.ajax({
        url: 'objects/query_th.php',
        type: 'POST',
        data: { action: 'fetch' },
        dataType: "JSON",
        success: function (php_result) {
          // Update the real-time data on the webpage
          document.getElementById("temp_real").innerHTML = php_result.temp + " °C";
          document.getElementById("hr_real").innerHTML = php_result.hr + " %";
          document.getElementById("timestamp").innerHTML = php_result.timestamp;
        }
      });

      // Retrieve the latest temperature and humidity values
      let randomTEMP = parseInt(document.getElementById("temp_real").innerHTML);
      let randomHR = parseInt(document.getElementById("hr_real").innerHTML);

      // Remove old data if the number of rows exceeds the specified maximum
      if (data.getNumberOfRows() > maxDatas) {
        data.removeRows(0, data.getNumberOfRows() - maxDatas);
      }

      // Add a new row of data to the chart
      data.addRow([index, randomTEMP, randomHR]);

      // Redraw the chart with updated data and options
      chart.draw(data, options);

      // Increment the x-axis index for the next data point
      index++;
    }, 1600); // Interval set to 1600ms (1.6 seconds)
  }
</script>


<style>
  /* Style for div.ex3 */
  div.ex3 {
    background-color: transparent;
    width: 410px;
    height: 210px;
    overflow: auto;
  }

  /* Custom scrollbar style */
  /* Width of the scrollbar */
  ::-webkit-scrollbar {
    width: 10px;
  }

  /* Track style */
  ::-webkit-scrollbar-track {
    background: rgb(56, 42, 222);
  }

  /* Handle style */
  ::-webkit-scrollbar-thumb {
    background: rgb(20, 10, 138);
  }

  /* Handle style on hover */
  ::-webkit-scrollbar-thumb:hover {
    background: #555;
  }
</style>

      
      
  <div class="col-md-4 themed-grid-col">
  <div class="ex3">
    <div class="d-flex justify-content-around">
      <!-- Display temperature and humidity values -->
      <h1 id='temp_real' style="color:rgb(0, 191, 255);"></h1>
      <h1 id='hr_real' style="color:rgb(0, 191, 255);"></h1>
    </div>
  </div>
</div>

<!-- Include jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
 
<script type="text/javascript">
  // Function to fetch external temperature data at regular intervals
  function externalTemperaturebis() {
    // Uncomment the line below to change the color of the "sensor_IoT" element to blue
    // document.getElementById("sensor_IoT").style.color = "blue";

    // Set up an interval to make an AJAX call every 1450 milliseconds (1.45 seconds)
    setInterval(function(){
      $.ajax({
        url: 'objects/sim_th.php',
        type: 'POST',
        data: {},
        success: function(php_result) {
          // Uncomment the line below to update the content of the "th_measures" element with the PHP result
          // document.getElementById("th_measures").innerHTML = php_result;
        }
      });
    }, 1450);
  }

  // Call the externalTemperaturebis function to start fetching data
  externalTemperaturebis();
</script>
  


<table class="table table-borderless" id='th_measures'>
</tbody>
</table>
      </div>
      </div>
    </div>
    </div>

</main>

    
  </body>
</html>



