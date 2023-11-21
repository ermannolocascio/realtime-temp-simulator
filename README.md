# realtime-temp-simulator

This is a simulator to show in a real-time fashion temperature logs from remote sensor.  

To emulate a data streaming process, I'm using javascript to run two functions via ajax: the sim_th.php (which simulate the sensors logs) and the query_th.php (which is used to retreive the simulated measurments from the MySQL database). 

The two functions are called in a coordinated fashion in order to enable the simulation.

After retreiving the actual simulated measurment the chart is updated. 

This is a personal project. 

<img src="assets/data_streaming.PNG" width="628"/>

