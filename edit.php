<?php
	require("config.php");
	$id =$_REQUEST['ID'];
	$result = mysqli_query($dtbs,"SELECT * FROM product WHERE ID = '$id'");
	$test = mysqli_fetch_array($result);
	if (!$result) {
		die("Error: Data not found..");
	}
	$Picture=$test['product_image'] ;

		
	if(isset($_POST['save'])) {
		$picture_save = $_FILES['image_change']['name'];
		mysqli_query($dtbs,"UPDATE product SET product_image ='$picture_save' WHERE ID = '$id'")
		or die(mysqli_error());
		echo "Saved!";
		header("Location: admin.php");
	}
	mysqli_close($dtbs);
?>

<!-- Change product name & product price-->
<?php
	require("config.php");
	$id =$_REQUEST['ID'];
	$result = mysqli_query($dtbs,"SELECT * FROM product WHERE ID = '$id'");
	$test = mysqli_fetch_array($result);
	if (!$result) {
		die("Error: Data not found..");
	}
	$Name=$test['product_name'] ;
	$Price= $test['product_price'] ;
	$Change=$test['product_image'] ;
    
	if(isset($_POST['saveas'])) {
		$nameice_save = $_POST['name'];
		$price_save = $_POST['price'];
		$picture_change = $_POST['product_image'];
		mysqli_query($dtbs,"UPDATE product SET product_name ='$nameice_save', product_price ='$price_save',
		product_image ='$picture_change' WHERE ID = '$id'")
		or die(mysqli_error());
		echo "Saved!";
		header("Location: admin.php");
	}
	mysqli_close($dtbs);
?>
<!-- Upload Image to images file -->
<?php
	// Create database connection
	$dtbs = mysqli_connect("localhost", "root", "", "sport");

	// Initialize message variable
	$msg = "";

	// If upload button is clicked ...
	if (isset($_POST['save'])) {
		// Get image name
		$product_image = $_FILES['image_change']['name'];
		$target = "images/".basename($product_image);
		// execute query
		mysqli_query($dtbs, $sql_p);

		if(is_uploaded_file($_FILES['image_change']['tmp_name'])){
			if (move_uploaded_file($_FILES['image_change']['tmp_name'], $target)) {
				$msg = "Image uploaded successfully";
			} else {
				$msg = "Failed to upload image";
			}
		}else{
			$msg = "Image Error!!";
		}
		
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<link rel="stylesheet" type="text/css" href="edit.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Edit Document</title>
	<link rel="icon" href="image/iconedit.png">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<center>
	<h1>Edit</h1>
	<hr>
</center>
<body class="editbd">
	<form method="post" enctype="multipart/form-data">
		<div class="edit01">
			<center>
			<fieldset>
				<legend>Change Name and Price</legend>
				<table>
					<tr>
						<td>Product Name:</td>
						<td><input type="text" name="name" maxlength="30" value="<?php echo $Name ?>"/></td>
					</tr>
					<tr>
						<td>Product Price:</td>
						<td><input type="text" name="price" maxlength="10" value="<?php echo $Price ?>"/></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td><input type="submit" name="saveas" value="Save" id="save" /></td>
					</tr>
				</table>	
			</fieldset>
			</center>
		</div>

		<div class="edit02">
			<center>
			<fieldset>
				<legend>Change Image</legend>
				<input type="file" name="image_change" value="<?php echo $Picture ?>" /><br><br>
				<input type="text" name="product_image" value="<?php echo $Change ?> " />
				<input type="submit" name="save" value="Change Image" id="save" />
			</fieldset>
		</center>
		</div>
	</form>
</body>
</html>