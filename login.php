<?php
	// define variables
	$fieldName = array("username","password");
	$valueField = array("","");
	$errorField= array("","");
	$errorStatus = 0;/*No submit, No error*/
	$dbErrorMsg = ""; /*Step03: Required variable*/
	
	require 'formValidation.php';
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$errorStatus = 1; /*Submitted and No error*/
		validation($_POST["username"],0) ;
		validation($_POST["pwd"],1) ;
	}
	
	if($errorStatus ==1){/*Step03: MySQL and SESSION*/
		session_start();
		include("db.php");
		
		$sql = "SELECT * FROM admin WHERE username = '$valueField[0]' and password = '$valueField[1]'";
		$result = mysqli_query($conn, $sql);
		$count = mysqli_num_rows($result);
		if($count >= 1) {
			$_SESSION['username'] = $valueField[0];
			header("location: admin/index.php");
		}else {
			$dbErrorMsg = "Username or Password is invalid";
		}     
	}
	
	require 'header.php';
	require 'menu.php';
	require 'lsidebar.php';
?>

			<div class="column middle">
				<h3>Admin</h3><hr>
				<p>
					<span style="color:red;"><?php echo $dbErrorMsg;?></span>
					<div class="loginform">
						<form action="login.php" method="POST">
							<label for="username">Username:</label><br>
							<input type="text" id="username" placeholder="Enter Username" name="username"><br>
							<span style="color:red;"><?php echo $errorField[0];?></span><br>
							
							<label for="pwd">Password:</label><br>
							<input type="password" id="pwd" placeholder="Enter Password" name="pwd"><br>
							<span style="color:red;"> <?php echo $errorField[1];?></span><br>
							
							<input type="submit" value="Login">
						</form>
					</div>
					
				</p> 
			</div>

<?php
	require 'rsidebar.php';
	require 'footer.php';
?>			
