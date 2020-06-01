<?php include( 'server.php') ?>
<?php
	// Create database connection
	$dtbs = mysqli_connect("localhost", "root", "", "sport");

	// Initialize message variable
	$msg = "";
$errors = array(); 
	// If upload button is clicked ...
	if (isset($_POST['upload'])) {
		// Get image name
		$product_image = $_FILES['product_image']['name'];
		// Get text
		$category = mysqli_real_escape_string($dtbs, $_POST['category']);
    $brand = mysqli_real_escape_string($dtbs, $_POST['brand']);
		$product_name = mysqli_real_escape_string($dtbs, $_POST['product_name']);
		$product_price = mysqli_real_escape_string($dtbs, $_POST['product_price']);
    if (isset($_POST['product_stock'])) {
      $product_stock = $_POST['product_stock'];
    }
		// image file directory
		$target = "image/".$product_image;

    $idRd = true;
    $id=date("dmy").rand(10,99);
while($idRd){
  $selectID = "SELECT * FROM product WHERE ID='$id'";
  $resultID = mysqli_query($dtbs ,$selectID);
  if(mysqli_num_rows($resultID) > 0){
    $id=date("dmy").rand(10,99);
  }else{
    $idRd = false;
  }
}
  if (empty($product_image) || empty($category) || empty($brand) || empty($product_name)|| empty($product_stock)|| empty($product_price)) { array_push($errors, "<small style='color:red;'>Please fill the blank space!</small>"); }
if (count($errors) == 0) {
		$sql_p = "INSERT INTO product (id, product_name  , product_price, product_image,category,brand,product_stock) VALUES ('$id', '$product_name','$product_price', '$product_image','$category','$brand','$product_stock')";
		// execute query
		mysqli_query($dtbs, $sql_p);

		if(is_uploaded_file($_FILES['product_image']['tmp_name'])){
			if (move_uploaded_file($_FILES['product_image']['tmp_name'], $target)) {
				$msg = "Image uploaded successfully";
			}else{
				$msg = "Failed to upload image";
			}
		}else{
			$msg = "Image Error!";
		}
		
	}
}
	$title = (isset($_POST['searchname']) ? $_POST['searchname'] : null);
	$result = mysqli_query($dtbs, "SELECT * FROM product where id LIKE '%$title%' or category LIKE '%$title%' or product_name LIKE '%$title%' or brand LIKE '%$title%'");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Let'Sport</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style.min.css" rel="stylesheet">
    <style type="text/css">
        html,
        body,
        header,
        .carousel {
          height: 100vh;
        }
    
        @media (max-width: 740px) {
    
          html,
          body,
          header,
          .carousel {
            height: 100vh;
          }
        }
    
        @media (min-width: 800px) and (max-width: 850px) {
    
          html,
          body,
          header,
          .carousel {
            height: 100vh;
          }
        }
    </style>
	<title>Product Page</title>
</head>
<body>
	<div class="show01">
		<form method="POST" action="admin.php" enctype="multipart/form-data">
			<input type="hidden" name="size" value="1000000">
			<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
        <h3>
          <?php 
            echo $_SESSION['success']; 
            unset($_SESSION['success']);
          ?>
        </h3>
      </div>
    <?php endif ?>
    <!-- Navbar -->
    <nav class="navbar  navbar-expand-lg navbar-light white scrolling-navbar">
        <div class="container">

            <!-- Brand -->
            <a class="navbar-brand waves-effect" href="home-page.php">
        <strong class="navbar-brand">Let'Sports</strong>
      </a>

            <!-- Collapse -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

            <!-- Links -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <!-- Left -->
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link waves-effect" href="home-page.php">Home</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link waves-effect" href="shirts.php">Shirts</a>
                    </li>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link waves-effect" href="shoes.php">Shoes</a>
                    </li>
                    </li>
                    <li class="nav-item ">
                    <a class="nav-link waves-effect" href="accessories.php">Accessories</a>
                    </li>
                    <li class="nav-item active">
                    <a class="nav-link waves-effect" href="admin.php">Product</a>
                    <span class="sr-only">(current)</span>
                    </li>
                </ul>
                <!-- Left -->
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">

                    </li>

                </ul>

                <?php if(!isset($_SESSION['user']) && !isset($_SESSION['admin'])) : ?>
                    <!-- Right -->
                <ul class="navbar-nav nav-flex-icons">

            <a  href="Login.php"><button type="button" class="btn btn-info btn-block my-4 waves-effect waves-light">Log In</button></a>
                </ul>
                <?php endif ?>
                <?php if(isset($_SESSION['user'])) : ?>
                <!--Dropdown primary-->
  <div class="dropdown">

    <!--Trigger-->
    <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown"
      aria-haspopup="true" aria-expanded="false">Settings</button>


    <!--Menu-->
    <div class="dropdown-menu dropdown-primary">
      <a class="dropdown-item" href="#">My Profile</a>
      <a class="dropdown-item" href="home-page.php?logout='1'">Log Out</a>
    </div>
  </div>
  <!--/Dropdown primary-->
                <?php endif ?>
<?php if(isset($_SESSION['admin'])) : ?>
                <!--Dropdown primary-->
  <div class="dropdown">

    <!--Trigger-->
    <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown"
      aria-haspopup="true" aria-expanded="false">Settings</button>


    <!--Menu-->
    <div class="dropdown-menu dropdown-primary">
      <a class="dropdown-item" href="admin.php">My Profile</a>
      <a class="dropdown-item" href="home-page.php?logout='1'">Log Out</a>
    </div>
  </div>
  <!--/Dropdown primary-->
                <?php endif ?>
            </div>

        </div>
    </nav>
    <!-- Navbar -->
			<center>
				<h1>Product Page</h1>
				<hr>
				<div class="instb">
					<table>
						
						<tr>
							<div class="md-form input-group mb-3" style="width: 20%;">
  <div class="input-group-prepend">
    <span class="input-group-text md-addon" id="inputGroupMaterial-sizing-default">Product :</span>
  </div>
  <input type="text" name="product_name" minlength="5" maxlength="50" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroupMaterial-sizing-default" autocomplete="off">
</div>
						</tr>
            <tr>
						<div class="md-form input-group mb-3" style="width: 20%;">
  <div class="input-group-prepend">
    <span class="input-group-text md-addon" id="inputGroupMaterial-sizing-default">Price :</span>
  </div>
  <input input type="number" name="product_price" id="text" step='0.01' minlength="1" maxlength="10" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroupMaterial-sizing-default">
</div>
						</tr>
            <tr>
            <div class="md-form input-group mb-3" style="width: 20%;">
  <div class="input-group-prepend">
    <span class="input-group-text md-addon" id="inputGroupMaterial-sizing-default">Stock :</span>
  </div>
  <input input type="number" name="product_stock" id="text" step='1' minlength="1" maxlength="10" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroupMaterial-sizing-default">
</div>
            </tr>
            <tr>
              <div class="md-form input-group mb-3" style="width: 20%;">
  <div class="input-group-prepend">
    <span class="input-group-text md-addon" id="inputGroupMaterial-sizing-default">Brand :</span>
  </div>
  <input type="text" name="brand" minlength="1" maxlength="50" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroupMaterial-sizing-default">
</div>
            </tr>
            <tr>
              <div class="md-form input-group mb-3" style="width: 20%;">
  <div class="input-group-prepend">
    <span class="input-group-text md-addon" id="inputGroupMaterial-sizing-default">Category :</span>
  </div>
  <select class="custom-select custom-select-sm" name="category">
  <option value="Shirts">Shirts</option>
  <option value="Shoes">Shoes</option>
  <option value="Accessories">Accessories</option>
</select>
</div>
              
            </tr>
						<tr>
              <div class="md-form input-group mb-3" style="width: 20%;">
  <div class="input-group-prepend">
    <span class="input-group-text md-addon" id="inputGroupMaterial-sizing-default">Picture :</span>
    <input  type="file" name="product_image">
  </div>
  
</div>
						</tr>
            <center><?php include( 'errors.php'); ?></center>
						<tr>
							<td colspan="2"><button type="submit" class="btn btn-info btn-block my-4 waves-effect waves-light" name="upload">Upload</button></td>
						</tr>
					</table>
				</div>
				<br>
				<div style="float: right; margin-right: 5%;" >
					<form method="post" >
            <!-- Search form -->

						<input type="text" name="searchname" >&emsp;<input type="submit" name="submit" value="Search" class="btn btn-info btn-sm my-4 waves-effect waves-light-">
					</form>
				</div>
				<br>
				<table class="table">
                      <thead>
                      <tr>
                      <th scope="col">#</th>
                      <th scope="col">Product Name</th>
                      <th scope="col">Price</th>
                      <th scope="col" width="20%">Picture</th>
                      <th scope="col">Brand</th>
                      <th scope="col">Stock</th>
                      <th scope="col">Category</th>
                      <th scope="col">Edit</th>
                      <th scope="col">Delete</th>
                      </tr>
                      </thead>
                      <tbody>
						<?php
							while ($row = mysqli_fetch_array($result)) {
								$id = $row['id'];
								echo "<tr>";
								echo"<th scope='row'>".$row['id']."</th>";
								echo"<td>" .$row['product_name']."</td>";
								echo"<td>RM ". $row['product_price']. "</td>";
								echo "<td><img src='image/".$row['product_image']."' style='max-width:90%;max-height:30%;' ></td>";
                echo "<td>". $row['brand']. "</td>";
                echo "<td>".$row['product_stock']."</td>";
                echo"<td>". $row['category']. "</td>";
								echo"<td> <a href ='edit.php?ID=$id'>Edit</a></td>";
								echo"<td> <a href='delete.php?ID=$id' style='color:red;'>Delete</a></td>";
								echo "</tr>";
							}
						?>
            </tbody></table>
					</table>
				</div>
			</center>
		</form>
	</div>

  
    
	<!--Footer-->
    <footer class="page-footer text-center font-small mt-4 ">
        <hr>
        
        <!--Copyright-->
        <div class="footer-copyright py-3">
            © 2019 Copyright:
            <a href="home-page.php"> Let'Sports </a>
        </div>
        <!--/.Copyright-->
    </footer>
    <!--/.Footer-->
    <!-- SCRIPTS -->
    <!-- JQuery -->
    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <!-- Initializations -->
    <script type="text/javascript">
        // Animations initialization
        new WOW().init();
    </script>
</body>
</html>