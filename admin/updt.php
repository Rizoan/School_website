<?php
	session_start();
	if(!isset($_SESSION['username'])){
		header("Location: ../login.php");
		die(); //Deny access 
	} 
	  
	// define variables 
	$fieldName = array("ID","Name","Designation", "Joining Date", "Email", "Country","Other");
	$valueField = array("","","","","","","");
	$errorField= array("","","","","","","");
	$errorStatus = 0;/*No submit, No error*/
	$dbErrorMsg = "";
	
	require '../formValidation.php';
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$errorStatus = 1; /*Submitted and No error*/
		validation($_POST["id"],0) ;
		validation($_POST["name"],1) ;		
		/*Checkbox create problem: not set designation*/
		$_POST["designation"] = empty($_POST["designation"])? "": $_POST["designation"];
		validation($_POST["designation"],2) ;
		validation($_POST["joiningdate"],3) ;
		validation($_POST["email"],4) ;
		validation($_POST["country"],5) ;
		validation($_POST["other"],6) ;	
	}

	if($errorStatus ==1){
		include("db.php");
		 
		$sql = "SELECT * FROM teachers WHERE id = '$valueField[0]'";
		$result = mysqli_query($conn, $sql);
		$count = mysqli_num_rows($result);
		if($count == 1) {
			$sql = "UPDATE teachers SET name='$valueField[1]', designation='$valueField[2]', joiningdate='$valueField[3]', email='$valueField[4]', country='$valueField[5]', other='$valueField[6]' WHERE id = '$valueField[0]'";
			//echo $sql;
			if (mysqli_query($conn, $sql)) {
				$dbErrorMsg=  "Updated successfully<br>";
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
	<h3> Update Teacher's Information</h3>
	<p> 
	<span style="color:red;"><?php echo $dbErrorMsg; ?></span>
	<form action="updt.php" method="post">
		<label for="id">Teacher ID:</label><br>
		<input type="text" id="id" name="id"><br>
		<span style="color:red;"><?php echo $errorField[0];?></span><br>
		
		<label for="name">Name:</label><br>
		<input type="text" id="name" name="name"><br>
		<span style="color:red;"><?php echo $errorField[1];?></span><br>
	 
		Designation:<br>
		<input type="radio" id="designation1" name="designation" value="Lecturer">
		<label for="designation1">Lecturer</label><br>
		<input type="radio" id="designation2" name="designation" value="Assistant Professor">
		<label for="designation2">Assistant Professor</label><br>
		<input type="radio" id="designation3" name="designation" value="Associate Professor">
		<label for="designation3">Associate Professor</label><br>
		<input type="radio" id="designation4" name="designation" value="Professor">
		<label for="designation4">Professor</label><br>
		<span style="color:red;"><?php echo $errorField[2];?></span><br>
		
		<label for="joiningdate">Joining Date:</label>
		<input type="date" id="joiningdate" name="joiningdate"><br>
		<span style="color:red;"><?php echo $errorField[3];?></span><br>
		
		<label for="email">Email:</label>
		<input type="email" id="email" name="email"><br>
		<span style="color:red;"><?php echo $errorField[4];?></span><br>

		<label for="country">Country:</label>
		<select id="country" name="country">
		  <option value="Bangladesh">Bangladesh</option>
		  <option value="Other">Other</option>
		</select><br>
		<span style="color:red;"><?php echo $errorField[5];?></span><br>
		
		<label for="other">Other:</label><br>
		<textarea  id= "other" name="other" rows="10" cols="30"></textarea><br>
		<span style="color:red;"><?php echo $errorField[6];?></span><br>

		<input type="submit" value="UPDATE"> 
	</form>

	</p>
</div>
		
<?php
	require 'footer.php';
?>		