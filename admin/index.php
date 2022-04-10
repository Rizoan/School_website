<?php
	session_start();
	 if(!isset($_SESSION['username'])){
		   header("Location: ../login.php");
		   die(); //Deny access 
	  } 
	require 'header.php';
	require 'menu.php';
?> 		
		<div class="row">
			<h3> Welcome Page</h3>
			<p> Peace Be upon You </p>
		</div>
		
<?php
	require 'footer.php';
?>		