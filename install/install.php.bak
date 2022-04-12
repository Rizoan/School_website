<?php
	// define variables 
	$fieldName = array("School Name","Moto", "Date of Establisment", "Name of head/principal","About", "Contact", "Server Name", "User Name","Password","Database Name");
	$valueField = array("","","","","","","","","","");
	$errorField= array("","","","","","","","","","");
	$errorStatus = 0;/*No submit, No error*/

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
		
		
	}
	if($errorStatus ==1){
		require 'header.php';
		?><div class="row"><?php
		
		$server = $valueField[6];
		$user = $valueField[7];
		$pass = $valueField[8];
		$dbName=$valueField[9];
		
		echo "<b> Server Name: $server<br>";
		echo "User Name: $user<br>";
		echo "Password: $pass<br>";
		echo "Database Name: $dbName<br></b>";
		
		$conn = mysqli_connect($server,$user,$pass);
		// Check connection
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
		// Create database
		$sql = "CREATE DATABASE IF NOT EXISTS $dbName";
		if (mysqli_query($conn, $sql)) {
		  echo "Database created successfully";
		} else {
		  echo "Error creating database: " . mysqli_error($conn);
		}
		mysqli_close($conn);
		
		$conn = mysqli_connect($server,$user,$pass,$dbName);
		// Check connection
		if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
		}
		
		$schoolname = $valueField[0];		
		$moto = $valueField[1] ;
		$estdate = $valueField[2];
		$hpname = $valueField[3];
		$about = $valueField[4];
		$contact = $valueField[5];
		// sql to create table
		$sql = "CREATE TABLE IF NOT EXISTS basicinfo (
		id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		schoolname VARCHAR(30) NOT NULL,
		moto VARCHAR(30) NOT NULL,
		estdate VARCHAR(30) NOT NULL,
		hpname VARCHAR(30) NOT NULL,
		about VARCHAR(150) NOT NULL,
		contact VARCHAR(150) NOT NULL,
		server VARCHAR(30) NOT NULL,
		user VARCHAR(30) NOT NULL,
		pass VARCHAR(30) NOT NULL,
		dbName VARCHAR(30) NOT NULL
		)";

		if (mysqli_query($conn, $sql)) {
		  echo "<br>Table <b>basicinfo</b> created successfully";
		} else {
		  echo "Error creating table: " . mysqli_error($conn);
		}
        
		$sql = "INSERT INTO basicinfo(schoolname,moto,estdate,hpname,about,contact,server,user,pass,dbName)
		VALUES ('$schoolname','$moto', '$estdate','$hpname','$about','$contact','$server','$user','$pass','$dbName')";

		if (mysqli_query($conn, $sql)) {
		  echo "<br>Successfully add basic Information <br>";
		} else {
		  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		
		/*serverFile Write*/
		$serverFile = fopen("serverFile.txt","w");
		$txt = $server."\n";
		fwrite($serverFile,$txt);
		$txt = $user."\n";
		fwrite($serverFile,$txt);
		$txt = $pass."\n";
		fwrite($serverFile,$txt);
		$txt = $dbName."\n";
		fwrite($serverFile,$txt);
		fclose($serverFile);
		
		// sql to create table
		$sql = "CREATE TABLE IF NOT EXISTS admin (
		id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		username VARCHAR(30) NOT NULL,
		password VARCHAR(30) NOT NULL	
		)";

		if (mysqli_query($conn, $sql)) {
		  echo "<br>Table <b>admin</b> created successfully";
		} else {
		  echo "Error creating table: " . mysqli_error($conn);
		}

		$sql = "INSERT INTO admin (username,password)
		VALUES ('admin', 'admin')";

		if (mysqli_query($conn, $sql)) {
		  echo "<br>Username: admin and Password: admin";
		} else {
		  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		
		
		// sql to create table
		$sql = "CREATE TABLE IF NOT EXISTS teachers (
		id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		name VARCHAR(50) NOT NULL,
		designation VARCHAR(50) NOT NULL,
		joiningdate VARCHAR(50) NOT NULL,
		email VARCHAR(50) NOT NULL,
		country VARCHAR(50) NOT NULL,
		other VARCHAR(50) NOT NULL
		)";

		if (mysqli_query($conn, $sql)) {
		  echo "<br>Table <b>teachers</b> created successfully";
		} else {
		  echo "Error creating table: " . mysqli_error($conn);
		}
	    mysqli_close($conn);
	    /*Self delete function is unlike*/
	    /*unlink(__FILE__);*/
	    Echo "<br> Now Delete install folder from main directory";
        ?></div><?php   	    
	}
	if($errorStatus !=1){
		require 'header.php';
?> 		
<div class="row">			
	
	<h3> Setup Information</h3>
	<p> 
	<span style="color:red;"><?php echo $dbErrorMsg; ?></span>
	<form action="install.php" method="post">
		<label for="name">School Name:</label><br>
		<input type="text" id="name" name="schoolname"><br>
		<span style="color:red;"><?php echo $errorField[0];?></span><br>
	 
		<label for="moto">Moto of your school:</label><br>
		<input type="text" id="moto" name="moto"><br>
		<span style="color:red;"><?php echo $errorField[1];?></span><br>
	 

		<label for="estdate">Date of Establishment:</label>
		<input type="date" id="estdate" name="estdate"><br>
		<span style="color:red;"><?php echo $errorField[2];?></span><br>
		
		<label for="hpname">Name of Head/principal:</label><br>
		<input type="text" id="hpname" name="hpname"><br>
		<span style="color:red;"><?php echo $errorField[3];?></span><br>
	    
		<label for="about">About your School:</label><br>
		<textarea rows = "5" cols = "50" id="about" name="about"> </textarea><br>
		<span style="color:red;"><?php echo $errorField[4];?></span><br>
		
		<label for="contact">Contact Information:</label><br>
		<textarea rows = "5" cols = "50" id="contact" name="contact"> </textarea><br>
		<span style="color:red;"><?php echo $errorField[5];?></span><br>
		
		<label for="server">Server: (i.e. localhost or other)</label><br>
		<input type="text" id="server" name="server"><br>
		<span style="color:red;"><?php echo $errorField[6];?></span><br>
		
		<label for="user">Server User (i.e. root):</label><br>
		<input type="text" id="user" name="user"><br>
		<span style="color:red;"><?php echo $errorField[7];?></span><br>
		
		<label for="password">Password:(empty or your given password)</label><br>
		<input type="password" id="password" name="password"><br>
		<span style="color:red;"><?php echo $errorField[8];?></span><br>
		
		<label for="dbname">Database Name:</label><br>
		<input type="text" id="dbname" name="dbname"><br>
		<span style="color:red;"><?php echo $errorField[9];?></span><br>
		
		
		<input type="submit" value="Submit"> 
	</form>

	</p>
</div>
<?php
	}
	require 'footer.php';
?>