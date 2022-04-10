<?php
	session_start();
	if(!isset($_SESSION['username'])){
		header("Location: ../login.php");
		 die(); //Deny access 
	} 
	
	// define variables 
	$fieldName = array("id");
	$valueField = array("");
	$errorField= array("");
	$errorStatus = 0;/*No submit, No error*/
	$dbErrorMsg = "";  
	
	require '../formValidation.php';
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$errorStatus = 1; /*Submitted and No error*/
		validation($_POST["id"],0) ;	
	}

	if($errorStatus ==1){
		include("db.php");
		 /*Help file: login.php*/
		$sql = "SELECT * FROM teachers WHERE id = '$valueField[0]'";
		$result = mysqli_query($conn, $sql);
		$count = mysqli_num_rows($result);
		if($count == 1) {
			$sql = "DELETE FROM teachers WHERE id=$valueField[0]";
			if (mysqli_query($conn, $sql)) {
				$dbErrorMsg =  "Deleted successfully<br>";
			} else {
				$dbErrorMsg =  "Error: " . mysqli_error($conn);
			} 
		}
		else
			$dbErrorMsg =  "Teacher ID is Invalid<br>";				
	}
	
	require 'header.php';
	require 'menu.php';
?> 		
<div class="row">
	<h3> Delete A Teacher information</h3>
	<p> 
	<span style="color:red;"><?php echo $dbErrorMsg; ?></span>
	<form action="delt.php" method="post">
		<label for="id">Teacher ID:</label><br>
		<input type="text" id="id" name="id"><br>
		<span style="color:red;"><?php echo $errorField[0];?></span><br>
	
		<input type="submit" value="DELETE"> 
	</form>

	</p>
</div>		
<?php
	require 'footer.php';
?>		