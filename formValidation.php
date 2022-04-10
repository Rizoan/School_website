<?php
	function validation($data,$indicator) {
		global $errorField, $valueField,$fieldName;
		global $errorStatus;
		
		if (empty($data)) {
			$errorField[$indicator] = $fieldName[$indicator]." is required";
			$errorStatus = 2;/*Submitted and error occurred*/ 
		} else {
			$data = trim($data);/* removes whitespace = {space,newline etc} both sides of a string*/
			$data = stripslashes($data);/*Remove the backslash*/
			$data = htmlspecialchars($data);/*converts HTML entities to some predefined characters*/
	  		$valueField[$indicator] = $data;
		}
	}
?>