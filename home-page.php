 <?php 
$dtbs = mysqli_connect("localhost", "root", "", "product");
session_start();
 
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['user']);
    header("location: home-page.php");
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
</head>

<body>


    
</div>
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
                    <li class="nav-item active">
                        <a class="nav-link waves-effect" href="home-page.php">Home
              <span class="sr-only">(current)</span>
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
                    <ul style="margin-right: 3%;margin-top: 2%;"><a href="cartList.php"><i class="fas fa-shopping-cart fa-lg"></i></a></ul>
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

    <!--Carousel Wrapper-->
    <div id="carousel-example-1z" class="carousel slide carousel-fade" data-ride="carousel">
        <!--Indicators-->
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-1z" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-1z" data-slide-to="1"></li>
            <li data-target="#carousel-example-1z" data-slide-to="2"></li>
        </ol>
        <!--/.Indicators-->
        <!--Slides-->
        <div class="carousel-inner" role="listbox" >
            <!--First slide-->
            <div class="carousel-item active">
                <img class="d-block w-100" src="https://i1.adis.ws/i/jpl/desktop_top_and_bottom_banner_007-4516ab8e3e8320100c954165d8933dfb?qlt=100" alt="First slide">
            </div>
            <!--/First slide-->
            <!--Second slide-->
            <div class="carousel-item">
                <img class="d-block w-100" src="https://i1.adis.ws/i/jpl/1160x485-752d6861cd07b7c6b2a1f95c6d80b37c?qlt=99" alt="Second slide">
            </div>
            <!--/Second slide-->
            <!--Third slide-->
            <div class="carousel-item">
                <img class="d-block w-100" src="https://i1.adis.ws/i/jpl/01-desktop-banner-1e7e9b1121527fe16eae34fcc9d27d49?qlt=99" alt="Third slide">
            </div>
            <!--/Third slide-->
        </div>
        <!--/.Slides-->
        <!--Controls-->
        <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
        <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
        <!--/.Controls-->
    </div>
    <!--/.Carousel Wrapper-->

    

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
    <!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5ca5ac441de11b6e3b06d0a1/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
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