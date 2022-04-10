<?php
require "db.php";
$sql = "SELECT * FROM basicinfo";
$result = mysqli_query($conn, $sql);					
$row = mysqli_fetch_assoc($result);
$schoolname = $row['schoolname'];
$moto = $row['moto'];
$estdate = $row['estdate'];
$hpname =  $row['hpname'];
$about = $row['about'];
$contact = $row['contact'];
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title> <?php echo $schoolname;?> </title>
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
		<!-- Headr-->
		<div class="header">
			<p> 
				<span style="font-size: 32px; font-weight:bold;"><?php echo $schoolname;?> </span> <br>
				<span style="font-size:12px"> <?php echo $moto; ?></span>
			</p>
		</div>