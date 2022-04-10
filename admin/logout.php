<?php
   session_start();
   
   if(!isset($_SESSION['username'])){
	   header("Location: ../login.php");
	   die(); //Deny access 
   }
   
   if(session_destroy()){
      header("Location: ../login.php");
   }
?>