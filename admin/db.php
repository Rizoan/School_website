<?php
   /*read file*/
   $serverFile = fopen("../install/serverFile.txt",'r') or die("File Error");
   $arr = array();
   $i = 0;
   while(!feof($serverFile)){
	   $arr[$i] = fgets($serverFile);
	   //echo $arr[$i]."<br>"; 
	   $i = $i + 1;
   }
   $server = trim($arr[0]);
   $user = trim($arr[1]);
   $pass = trim($arr[2]);
   $dbName=trim($arr[3]);
   $conn = mysqli_connect($server,$user,$pass,$dbName);
   // Check connection
	if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
	}
?>