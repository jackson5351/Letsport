<?php
	include("config.php");
	$id =$_REQUEST['ID'];
	// sending query
	mysqli_query($dtbs, "DELETE FROM product WHERE ID = '$id'")
	or die(mysqli_error());
	header("Location: admin.php");
?>