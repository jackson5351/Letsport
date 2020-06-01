<?php
session_start();

$errors = array();
include("config.php");
$query = "SELECT * from user where id = '" . $_SESSION['user_id'] . "';";

$result = mysqli_query($dtbs,$query);
$firstName = "";
$lastName = "";
$email = "";

while ($results = mysqli_fetch_array($result)) {
    $firstName = $results["firstname"];
    $lastName = $results["lastname"];
    $email = $results["email"];
}
if (isset($_POST['up_user'])){
$password = mysqli_real_escape_string($dtbs,$_POST['password']);
$passwordrepeat = mysqli_real_escape_string($dtbs,$_POST['passwordrepeat']);
    if (empty($password)) {
        array_push($errors, "<small style='color:red;''>Password is required</small>");
    }
    if (empty($passwordrepeat)) {
        array_push($errors, "<small style='color:red;''>Confirm Password is required</small>");
    }
    if ($passwordrepeat != $password) {
        array_push($errors, "<small style='color:red;''>The two passwords do not match</small>");

    }
     if(preg_match("/^.*(?=.{8,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/", $password) === 0){
array_push($errors, "<small style='color:red;''>Password must be at least 8 characters and must contain at least one lower case letter, one upper case letter and one digit</small>");
    }
if (count($errors) == 0) {
    $password = md5($password);//encrypt the password before saving in the database
    $alert = "<script type=\"text/javascript\">".
        "alert('Edit password Successful');".
        "</script>";
        $query = "UPDATE user set password = '$password' where id = '" . $_SESSION['user_id'] . "';";
        mysqli_query($dtbs,$query);
        $_SESSION['success'] = $alert;
        header('location: home-page.php');
}
}
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
                <ul style="margin-right: 3%;margin-top: 2%;"><a href="cartList.php"><i class="fas fa-shopping-cart fa-lg"></i></a></ul>
               <?php if(!isset($_SESSION['user'])) : ?>
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
                 

            </div>

        </div>
    </nav>
    <!-- Navbar -->

<form class="text-center border border-light p-5" style="width: 40% ;height: 72%; margin:0 auto;margin-bottom: 57px; "  method="post" action="userPage.php">

    <p class="h4 mb-4" ">Edit Profile</p>

    <div class="form-row mb-4">
        <div class="col">
            <!-- First name -->
            <input type="text" readonly="readonly" id="defaultRegisterFormFirstName" class="form-control"  value="<?php echo $firstName; ?>" name="firstName">
        </div>
        <div class="col">
            <!-- Last name -->
            <input type="text" readonly="readonly" id="defaultRegisterFormLastName" class="form-control" placeholder="Last name" value="<?php echo $lastName; ?>" name="lastName">
        </div>
    </div>

    <!-- E-mail -->
    <input type="email" readonly="readonly" id="defaultRegisterFormEmail" class="form-control mb-4" placeholder="E-mail" value="<?php echo $email; ?>" name="email">

    <!-- Password -->
    <input type="password" id="defaultRegisterFormPassword" class="form-control" placeholder="Password" aria-describedby="defaultRegisterFormPasswordHelpBlock" name="password">
    
    <input type="password" id="defaultRegisterFormPassword" class="form-control" placeholder="Confirm Password" aria-describedby="defaultRegisterFormPasswordHelpBlock" name="passwordrepeat">
    <center><?php include('errors.php'); ?></center>
    <!-- Sign up button -->
    <button class="btn btn-info my-4 btn-block" type="submit" name="up_user">Submit</button>
</form>

    <!--Footer-->
    <footer class="page-footer text-center font-small mt-4 fadeIn">
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