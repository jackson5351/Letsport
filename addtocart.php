<?php
session_start();
include("config.php");

	$id = $_GET["id"];
if (isset($_SESSION["user_id"])) {
	if ($id > 0) {
		if (isset($_POST['quantity'])) {
			$quantity = $_POST['quantity'];
			$user = $_SESSION['user_id'];
			$quantity_data = 0;
			$query = "SELECT * from cart where id = '$id' AND user_id = '$user'";
			$validate = false;
			$result = mysqli_query($dtbs,$query);
			if (mysqli_num_rows($result) != 0) {
				$validate = true;
			}else{
				$validate = false;
			}

			while ($results = mysqli_fetch_array($result)) {
				$quantity_data = $results['quantity'];
			}


			if ($validate == false) {
					$query2 = "INSERT into cart(id,user_id,quantity) values ('$id','$user','$quantity');";
					if (!mysqli_query($dtbs,$query2)) {
						die('Error : ' . mysqli_error($dtbs));
					}
				}
			if ($validate == true) {
				$quantity = $quantity + $quantity_data;
				$query3 = "UPDATE cart set quantity = '$quantity' where id = '$id' AND user_id = '$user';";
				if (!mysqli_query($dtbs,$query3)) {
				  	die('Error : ' . mysqli_error($dtbs));
				  }  
				mysqli_close($dtbs);

			}
		}
		header("Location: cartList.php");
		
	}
}else if (isset($_SESSION["admin"])) {
	echo "<script> alert('Please Login User First');
        window.location = 'home-page.php'</script>";
}
else{
	echo "<script> alert('Please Login User First');
        window.location = 'login.php'</script>";
}
?>