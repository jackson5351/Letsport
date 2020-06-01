<?php
	// Connect to MySQL database
	$dtbs = mysqli_connect('localhost','root','','sport');

	// Check connection
	if(!$dtbs){
	    die('ERROR: Could not connect. ' . mysqli_error());
	}
?>