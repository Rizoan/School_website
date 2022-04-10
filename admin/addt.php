<?php
	session_start();
	 if(!isset($_SESSION['username'])){
		   header("Location: ../login.php");
		   die(); //Deny access 
	  } 
	  
	// define variables 
	$fieldName = array("Name","Designation", "Joining Date", "Email", "Country","Other");
	$valueField = array("","","","","","");
	$errorField= array("","","","","","");
	$errorStatus = 0;/*No submit, No error*/
	$dbErrorMsg = "";

	require '../formValidation.php';
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$errorStatus = 1; /*Submitted and No error*/
		validation($_POST["name"],0) ;		
		/*Checkbox create problem: not set designation*/
		$_POST["designation"] = empty($_POST["designation"])? "": $_POST["designation"];
		validation($_POST["designation"],1) ;
		validation($_POST["joiningdate"],2) ;
		validation($_POST["email"],3) ;
		validation($_POST["country"],4) ;
		validation($_POST["other"],5) ;		
	}

	if($errorStatus ==1){
		include("db.php");
		 
		$sql = "INSERT INTO teachers(name, designation, joiningdate, email, country, other) VALUES('$valueField[0]','$valueField[1]','$valueField[2]','$valueField[3]','$valueField[4]','$valueField[5]')";
		//echo $sql;
		if (mysqli_query($conn, $sql)) {
			$dbErrorMsg =  "New record created successfully<br>";
		} else {
			$dbErrorMsg =  "Error: " . mysqli_error($conn);
		}     
	}	  
	require 'header.php';
	require 'menu.php';
?> 		
<div class="row">
	<h3> Add A Teacher</h3>
	<p> 
	<span style="color:red;"><?php echo $dbErrorMsg; ?></span>
	<form action="addt.php" method="post">
		<label for="name">Name:</label><br>
		<input type="text" id="name" name="name"><br>
		<span style="color:red;"><?php echo $errorField[0];?></span><br>
	 
		Designation:<br>
		<input type="radio" id="designation1" name="designation" value="Lecturer">
		<label for="designation1">Lecturer</label><br>
		<input type="radio" id="designation2" name="designation" value="Assistant Professor">
		<label for="designation2">Assistant Professor</label><br>
		<input type="radio" id="designation3" name="designation" value="Associate Professor">
		<label for="designation3">Associate Professor</label><br>
		<input type="radio" id="designation4" name="designation" value="Professor">
		<label for="designation4">Professor</label><br>
		<span style="color:red;"><?php echo $errorField[1];?></span><br>
		
		<label for="joiningdate">Joining Date:</label>
		<input type="date" id="joiningdate" name="joiningdate"><br>
		<span style="color:red;"><?php echo $errorField[2];?></span><br>
		
		<label for="email">Email:</label>
		<input type="email" id="email" name="email"><br>
		<span style="color:red;"><?php echo $errorField[3];?></span><br>

		<label for="country">Country:</label>
		<select id="country" name="country">
		  <option value="Bangladesh">Bangladesh</option>
		  <option value="Other">Other</option>
		</select><br>
		<span style="color:red;"><?php echo $errorField[4];?></span><br>
		
		<label for="other">Other:</label><br>
		<textarea  id= "other" name="other" rows="10" cols="30"></textarea><br>
		<span style="color:red;"><?php echo $errorField[5];?></span><br>

		<input type="submit" value="Submit"> 
	</form>

	</p>
</div>
		
<?php
	require 'footer.php';
?>		