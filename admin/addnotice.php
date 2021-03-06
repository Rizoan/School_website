<?php
	session_start();
	 if(!isset($_SESSION['username'])){
		   header("Location: ../login.php");
		   die(); //Deny access 
	  } 
	  
	// define variables 
	$fieldName = array("Notice Title","Description", "Lasy Date");
	$valueField = array("","","");
	$errorField= array("","","");
	$errorStatus = 0;/*No submit, No error*/
	
	$target_dir = "files/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	
	
	
	$dbOrFileErrorMsg = "";

	require '../formValidation.php';
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$errorStatus = 1; /*Submitted and No error*/
		validation($_POST["noticeTitle"],0) ;		
		validation($_POST["description"],1) ;
		validation($_POST["lastDate"],2) ;
		// Check if file already exists
		if ($target_file !="files/" && file_exists($target_file)) {
			$dbOrFileErrorMsg =  "Sorry, file already exists.";
			$errorStatus = 2;
		}
		// Check file size
		if ($_FILES["fileToUpload"]["size"] > 500000) {
			$dbOrFileErrorMsg =  "Sorry, your file is too large.";
			$errorStatus = 2;
		}
		
		// Allow certain file formats
		if($imageFileType != "" && $imageFileType != "jpg" && $imageFileType != "pdf") {
			$dbOrFileErrorMsg =  "Sorry, only JPG, & pdf files are allowed.";
			$errorStatus = 2;
		}
		
		/*if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
		} else {
			$dbOrFileErrorMsg =  "Sorry, there was an error uploading your file.";
			$errorStatus = 2;
		}*/
		if ($target_file = "files/")
			$target_file = "";
	}

	if($errorStatus ==1){
		include("db.php");
		 
		$sql = "INSERT INTO notice(title, description, lastdate, filepath) VALUES('$valueField[0]','$valueField[1]','$valueField[2]','$target_file')";
		//echo $sql;
		if (mysqli_query($conn, $sql)) {
			$dbOrFileErrorMsg =  "New record created successfully<br>";
		} else {
			$dbOrFileErrorMsg =  "Error: " . mysqli_error($conn);
		}     
	}	  
	require 'header.php';
	require 'menu.php';
?> 		
<div class="row">
	<h3> Add A Notice</h3>
	<p> 
	<span style="color:red;"><?php echo $dbOrFileErrorMsg; ?></span>
	<form action="addnotice.php" method="post" enctype="multipart/form-data">
		<label for="nt">Notice Title:</label><br>
		<input type="text" id="nt" name="noticeTitle"><br>
		<span style="color:red;"><?php echo $errorField[0];?></span><br>
	 
	    <label for="nd">Description:</label><br>
		<textarea  id= "nd" name="description" rows="10" cols="30"></textarea><br>
		<span style="color:red;"><?php echo $errorField[1];?></span><br>
 
		<label for="ld">last Date:</label>
		<input type="date" id="ld" name="lastDate"><br>
		<span style="color:red;"><?php echo $errorField[2];?></span><br>
		
		<label for="fileToUpload">Add File (optional):</label>
		<input type="file" name="fileToUpload" id="fileToUpload">
		
		<input type="submit" value="Add Notice"> 
	</form>

	</p>
</div>
		
<?php
	require 'footer.php';
?>		