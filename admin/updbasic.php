<?php
	session_start();
	if(!isset($_SESSION['username'])){
		header("Location: ../login.php");
		die(); //Deny access 
	} 
	  
	// define variables 
	$fieldName = array("School Name","Moto", "Date of Establisment", "Name of head/principal","About", "Contact", "Server Name", "User Name","Password","Database Name");
	$valueField = array("","","","","","","","","","");
	$errorField= array("","","","","","","","","","");
	$errorStatus = 0;/*No submit, No error*/
	$dbErrorMsg = "";
	
	require '../formValidation.php';
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$errorStatus = 1; /*Submitted and No error*/
		validation($_POST["schoolname"],0) ;		
		validation($_POST["moto"],1) ;
		validation($_POST["estdate"],2) ;
		validation($_POST["hpname"],3) ;
		validation($_POST["about"],4);
		validation($_POST["contact"],5);
		validation($_POST["server"],6) ;
		validation($_POST["user"],7) ;
		
		/*Can be Empty, validation($_POST["password"],6) ;*/
		$data = trim($_POST["password"]);/* removes whitespace = {space,newline etc} both sides of a string*/
		$data = stripslashes($data);/*Remove the backslash*/
		$data = htmlspecialchars($data);/*converts HTML entities to some predefined characters*/
		$valueField[8] = $data;
		validation($_POST["dbname"],9);	
		
		$id = $_POST["id"];
	}

	if($errorStatus ==1){
		include("db.php");
		 
		$sql = "UPDATE basicinfo SET schoolname='$valueField[0]', moto='$valueField[1]', estdate='$valueField[2]', hpname='$valueField[3]', about='$valueField[4]', contact='$valueField[5]', server = '$valueField[6]', user= '$valueField[7]', pass = '$valueField[8]', dbName='$valueField[9]' WHERE id = '$id'";
			//echo $sql;
		if (mysqli_query($conn, $sql)) {
				$dbErrorMsg=  "Updated successfully<br>";
		} else {
				$dbErrorMsg =  "Error: " . mysqli_error($conn);
		} 
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
		
		
		<input type="submit" value="Update"> 
	</form>

	</p>
</div>
		
<?php
	require 'footer.php';
?>		
