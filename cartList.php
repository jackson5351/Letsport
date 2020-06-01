<?php 
include("config.php");
session_start();                
?>

<!DOCTYPE html>
<html lang="en">

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
   
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light white scrolling-navbar">
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
                        <a class="nav-link waves-effect" href="home-page.php">Home
            </a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link waves-effect" href="shirts.php">Shirts</a>
                    </li>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link waves-effect" href="shoes.php">Shoes</a>
                    </li>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link waves-effect" href="accessories.php">Accessories</a>
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
      <a class="dropdown-item" href="userPage.php">My Profile</a>
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

<h3>Order Details</h3>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th width="25%">Image</th>
                        <th width="15%">Item Name</th>
                        <th width="10%">Brand</th>
                        <th width="8%">Category</th>
                        <th width="2%">Quantity</th>
                        <th width="10%">Price</th>
                        <th width="15%">Total</th>
                        <th width="15%">Action</th>
                    </tr>
                    <?php
                        $query = "SELECT * from cart natural join product where user_id ='" . $_SESSION['user_id'] . "';";
                        $result = mysqli_query($dtbs,$query);
                        $total = 0;
                        while ($receipt = mysqli_fetch_array($result)) {
                        $cart_id = $receipt["cart_id"];
                        echo "<tr>";
                        echo "<td><img src='image/". $receipt["product_image"] ."' style='width:50%;height:10%;'></td>";
                        echo "<td>" . $receipt["product_name"] . "</td>";
                        echo "<td>" . $receipt["brand"] . "</td>";
                        echo "<td>" . $receipt["category"] . "</td>";
                        echo "<td>" . $receipt["quantity"] . "</td>";
                        echo "<td>RM" . $receipt["product_price"] . "</td>";
                        echo "<td>RM" . $receipt["quantity"] * $receipt["product_price"] . "</td>";
                        echo "<td><a href='deletecart.php?id=$cart_id' style='color:red;'>Remove</td>";
                        echo "</tr>";
                        $total = $total + $receipt["quantity"] * $receipt["product_price"];
                        }
                        if (isset($_SESSION['user'])) {
                           $totaldis = $total*10/100;
                           $totalp = $total - $totaldis;
                        }
                    ?>
                    <tr>
                        <td colspan="6" align="right">Total</td>
                        <td align="right">RM <?php echo number_format($total, 2); ?>
                            <br/>
                            Discount : RM <?php echo number_format($totaldis, 2); ?>
                            <br/>
                            Total Price : RM <?php echo number_format($totalp, 2); ?>
                            <br/>
                        </td>
                        <td><div id="paypal-button-container"></div></td>
                    </tr>
                        




                </table>
                
            </div>



    <!--Footer-->
    <footer class="page-footer text-center font-small mt-4  fadeIn">
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
    <script src="https://www.paypal.com/sdk/js?client-id=AWc3wQ7SiG-Ry4ChY3H2VRjnQewsvDJ6pHTvHWyQm9cEugIxUiL8p81UVsV8UkbLv9Li4iTpXEcpaYn7&currency=MYR"></script>
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
<script>
  paypal.Buttons({
    createOrder: function(data, actions) {
      return actions.order.create({
        purchase_units: [{
          amount: {
            value: <?=$totalp; ?>
          }
        }]
      });
    },
    onApprove: function(data, actions) {
      // Capture the funds from the transaction
      return actions.order.capture().then(function(details) {
          // Show a success message to your buyer
        alert('Transaction completed by ' + details.payer.name.given_name);window.location='paymentSuccess.php';

          
      });
    }
  }).render('#paypal-button-container');
</script>
</html>