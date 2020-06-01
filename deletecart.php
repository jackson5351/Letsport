<?php
include('config.php');
if (isset($_GET["id"])) {
	$id = $_GET["id"];
	$sql_p = "DELETE from cart where cart_id = '$id';";
		// execute query
		mysqli_query($dtbs, $sql_p);
	header("Location: cartList.php");
}
?>