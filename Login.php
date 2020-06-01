<?php include( 'server.php') ?>

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
      <a class="dropdown-item" href="userPage.php>My Profile</a>
      <a class="dropdown-item" href="home-page.php?logout='1'">Log Out</a>
    </div>
  </div>
  <!--/Dropdown primary-->
                <?php endif ?>
                 

            </div>

        </div>
    </nav>
    <!-- Navbar -->

<!-- Default form login -->
<?php if (isset($_SESSION['reg'])) : ?>
      <div class="error success" >
        <h3>
          <?php 
            echo $_SESSION['reg']; 
            unset($_SESSION['reg']);
          ?>
        </h3>
      </div>
    <?php endif ?>
<form class="text-center border border-light p-5" style="width: 40% ;height: 72%; margin:0 auto;margin-bottom: 57px;" method="post" action="Login.php">

    <p class="h4 mb-4" style="padding: 7%;">Sign in</p>

    <!-- Email -->
    <input type="email" id="defaultLoginFormEmail" class="form-control mb-4" placeholder="E-mail" name="email">

    <!-- Password -->
    <input type="password" id="defaultLoginFormPassword" class="form-control mb-4" placeholder="Password" name="password">

   <center><?php include( 'errors.php'); ?></center>
    <!-- Sign in button -->
    <button class="btn btn-info btn-block my-4" type="submit" name="login_user">Sign in</button>

    <!-- Register -->
    <p>Not a member?
        <a href="register.php">Register</a>
    </p>


</form>
<!-- Default form login -->

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