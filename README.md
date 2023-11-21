# Realtime Temperature Simulator

This simulator displays temperature logs from a remote sensor in real-time.

To emulate data streaming, I'm using JavaScript to execute two functions via AJAX: `sim_th.php` (simulating sensor logs) and `query_th.php` (used to retrieve simulated measurements from the MySQL database). These functions are called via AJAX every 1.4 and 1.6 seconds. After retrieving the current simulated measurement, the chart is updated. If the maximum number of data points is reached on the chart, the chart will shift with every new element added (i.e., with every new query).

The data simulator (`sim_th.php`) will eventually be replaced by real sensor measurements, with an Arduino ESP 132 being employed in the future.

Note: This is a personal project.



<img src="assets/data_streaming.PNG" width="628"/>

