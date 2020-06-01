<?php
// Create database connection
$dtbs = mysqli_connect("localhost", "root", "", "sport");
if (isset($_GET['logout'])) {
session_destroy();
unset($_SESSION['user']);
header("location: home-page.php");
}
?>
<?php include( 'server.php') ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Let'Sport
    </title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style.min.css" rel="stylesheet">
  </head>
  <body>
    <!-- Navbar -->
    <nav class="navbar  navbar-expand-lg navbar-light white scrolling-navbar">
      <div class="container">
        <!-- Brand -->
        <a class="navbar-brand waves-effect" href="home-page.php">
          <strong class="navbar-brand">Let'Sports
          </strong>
        </a>
        <!-- Collapse -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon">
          </span>
        </button>
        <!-- Links -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left -->
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link waves-effect" href="home-page.php">Home
              </a>
            </li>
            <li class="nav-item ">
              <a class="nav-link waves-effect" href="shirts.php">Shirts
              </a>
            </li>
            </li>
          <li class="nav-item">
            <a class="nav-link waves-effect" href="shoes.php">Shoes
            </a>
          </li>
          </li>
        <li class="nav-item active">
          <span class="sr-only">(current)
          </span>
          <a class="nav-link waves-effect" href="accessories.php">Accessories
          </a>
        </li>
        </ul>
      <?php if(!isset($_SESSION['user'])&& !isset($_SESSION['admin'])) : ?>
      <!-- Right -->
      <ul class="navbar-nav nav-flex-icons">
        <a  href="Login.php">
          <button type="button" class="btn btn-info btn-block my-4 waves-effect waves-light">Log In
          </button>
        </a>
      </ul>
      <?php endif ?>
      <?php if(isset($_SESSION['user'])) : ?>
      <ul style="margin-right: 3%;margin-top: 2%;">
        <a href="cartList.php">
          <i class="fas fa-shopping-cart fa-lg">
          </i>
        </a>
      </ul>
      <!--Dropdown primary-->
      <div class="dropdown">
        <!--Trigger-->
        <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">Settings
        </button>
        <!--Menu-->
        <div class="dropdown-menu dropdown-primary">
          <a class="dropdown-item" href="userPage.php">My Profile
          </a>
          <a class="dropdown-item" href="home-page.php?logout='1'">Log Out
          </a>
        </div>
      </div>
      <!--/Dropdown primary-->
      <?php endif ?>
      <?php if(isset($_SESSION['admin'])) : ?>
      <!--Dropdown primary-->
      <div class="dropdown">
        <!--Trigger-->
        <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">Settings
        </button>
        <!--Menu-->
        <div class="dropdown-menu dropdown-primary">
          <a class="dropdown-item" href="admin.php">My Profile
          </a>
          <a class="dropdown-item" href="home-page.php?logout='1'">Log Out
          </a>
        </div>
      </div>
      <!--/Dropdown primary-->
      <?php endif ?>
      </div>
    </div>
  </nav>
<!-- Navbar -->
<section class="text-center my-5">
  <!-- Section heading -->
  <h2 class="h1-responsive font-weight-bold text-center my-5">Accessories
  </h2>
  <!-- Grid row -->
  <div class="row" style="margin: 1%">
    <?php
$result = mysqli_query($dtbs, "SELECT * FROM product where category='accessories'");
while ($row = mysqli_fetch_array($result))
{
  $stock = $row['product_stock'];
          if ($stock > 0) {
$id = $row['id'];
echo "<div class='col-lg-3 col-md-6 mb-lg-0 mb-4'>";
echo "<form method='post' action='addtocart.php?id=$id'> ";//
echo "<div class='card card-cascade narrower card-ecommerce'>";
echo "<div class='view view-cascade overlay'>";
echo "<img src='image/".$row['product_image']."' class='card-img-top'
alt='sample photo' >
<a>
<div class='mask rgba-white-slight'></div>
</a>
</div>";
echo "<div class='card-body card-body-cascade text-center'>";
echo "<a class='grey-text'>
<h5>".$row['brand']."</h5>
</a>";
echo "<h4 class='card-title'>
<strong>
<a href=''>" .$row['product_name']."</a>
</strong>
</h4>";
echo "<div class='card-footer px-1'>";
echo "<span class='float-left font-weight-bold'>
<strong>RM ". $row['product_price']. "</strong>
</span>";
echo "<input type='text' name='quantity' value='1' min='1' max=$stock class='form-control' >";
echo "<span class='float-right'>";            
echo "<input type='submit'  class='btn btn-success' value='Add to Cart' />";
echo " </span>";
echo "</div>";
echo "</div>";
echo "</div>";
echo "</form>";
echo "</div>";
}
}
?>
    </section>
  <!--Footer-->
  <footer class="page-footer text-center font-small mt-4  fadeIn">
    <hr>
    <!--Copyright-->
    <div class="footer-copyright py-3">
      © 2019 Copyright:
      <a href="home-page.php"> Let'Sports 
      </a>
    </div>
    <!--/.Copyright-->
  </footer>
  <!--/.Footer-->
  <!-- SCRIPTS -->
  <!-- JQuery -->
  <script type="text/javascript" src="js/jquery-3.3.1.min.js">
  </script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/popper.min.js">
  </script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/bootstrap.min.js">
  </script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/mdb.min.js">
  </script>
  <!-- Initializations -->
  <script type="text/javascript">
    // Animations initialization
    new WOW().init();
  </script>
  </body>
</html>
