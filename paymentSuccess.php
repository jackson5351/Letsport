<?php
 include("config.php");
  session_start();   
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['user_id']);
    header("location: homepage.php");
  }
?>
<?php 

$id = $_SESSION['user_id'];

$sql2 = "SELECT * FROM user WHERE id='$id'";
$result = mysqli_query($dtbs, $sql2);
$customer = mysqli_fetch_assoc($result);
$c_id = $customer['id'];

$sql3 = "SELECT * FROM cart natural join product WHERE user_id = '$id'";
$result2 = mysqli_query($dtbs,$sql3);
$productName = "";
$quantity = 0;
$stock = 0;

while ($results = mysqli_fetch_array($result2)) {
  $productName = $results['product_name'];
  $stock = $results['product_stock'];
  $quantity = $results['quantity'];

$newstock = 0;
$newstock = $stock - $quantity;

echo "$newstock, $productName, $stock, $quantity";
$sql_2 = "UPDATE product set product_stock = $newstock where product_name = '$productName'";
  mysqli_query($dtbs,$sql_2);
}

$sql_p ="DELETE from cart where user_id = '$id';";
    // execute query
     mysqli_query($dtbs, $sql_p);
     header("location:cartList.php");

    ?>