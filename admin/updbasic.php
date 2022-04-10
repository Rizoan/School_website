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
	<h3> Update Basic Information</h3>
	<p>
	<?php
	require "db.php";
	$sql = "SELECT * FROM basicinfo";
	$result = mysqli_query($conn, $sql);	
	$row = mysqli_fetch_assoc($result);
	$id = $row['id'];
	$schoolname = $row['schoolname'];
	$moto = $row['moto'];
	$estdate = $row['estdate'];
	$hpname =  $row['hpname'];
	$about = $row['about'];
	$contact = $row['contact'];
	$server = $row['server'];
	$user = $row['user'];
	$pass = $row['pass'];
	$dbName = $row['dbName'];
	?>
	
	<span style="color:red;"><?php echo $dbErrorMsg; ?></span>
	<form action="updbasic.php" method="post">
		<input type="hidden" name="id" value="<?php echo $id?>"><br>
		
		
		<label for="name">School Name:</label><br>
		<input type="text" id="name" name="schoolname" value="<?php echo $schoolname?>"><br>
		<span style="color:red;"><?php echo $errorField[0];?></span><br>
	 
		<label for="moto">Moto of your school:</label><br>
		<input type="text" id="moto" name="moto" value="<?php echo $moto?>"><br>
		<span style="color:red;"><?php echo $errorField[1];?></span><br>
	 

		<label for="estdate">Date of Establishment:</label>
		<input type="date" id="estdate" name="estdate" value="<?php echo $estdate?>"><br>
		<span style="color:red;"><?php echo $errorField[2];?></span><br>
		
		<label for="hpname">Name of Head/principal:</label><br>
		<input type="text" id="hpname" name="hpname" value="<?php echo $hpname?>"><br>
		<span style="color:red;"><?php echo $errorField[3];?></span><br>
	    
		<label for="about">About your School:</label><br>
		<textarea rows = "5" cols = "50" id="about" name="about"><?php echo $about?> </textarea><br>
		<span style="color:red;"><?php echo $errorField[4];?></span><br>
		
		<label for="contact">Contact Information:</label><br>
		<textarea rows = "5" cols = "50" id="contact" name="contact"><?php echo $contact?> </textarea><br>
		<span style="color:red;"><?php echo $errorField[5];?></span><br>
		
		<label for="server">Server: (i.e. localhost or other)</label><br>
		<input type="text" id="server" name="server" value="<?php echo $server?>"><br>
		<span style="color:red;"><?php echo $errorField[6];?></span><br>
		
		<label for="user">Server User (i.e. root):</label><br>
		<input type="text" id="user" name="user" value="<?php echo $user?>"><br>
		<span style="color:red;"><?php echo $errorField[7];?></span><br>
		
		<label for="password">Password:(empty or your given password)</label><br>
		<input type="password" id="password" name="password" value="<?php echo $pass?>"><br>
		<span style="color:red;"><?php echo $errorField[8];?></span><br>
		
		<label for="dbname">Database Name:</label><br>
		<input type="text" id="dbname" name="dbname" value="<?php echo $dbName?>"><br>
		<span style="color:red;"><?php echo $errorField[9];?></span><br>
		
		
		<input type="submit" value="Submit"> 
	</form>

	</p>
</div>
		
<?php
	require 'footer.php';
?>		