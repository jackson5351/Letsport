<?php
session_start();

// initializing variables
$firstName = "";
$lastName = "";
$email    = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'sport');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $firstName = mysqli_real_escape_string($db, $_POST['firstName']);
  $lastName = mysqli_real_escape_string($db, $_POST['lastName']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
  $passwordrepeat = mysqli_real_escape_string($db, $_POST['passwordrepeat']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
   if (empty($firstName) || empty($lastName) || empty($email)|| empty($password) || empty($passwordrepeat)) { array_push($errors, "<small style='color:red;'>Please fill the blank space!</small>"); }
  if ($password != $passwordrepeat) {
	array_push($errors, "<small style='color:red;''>The two passwords do not match</small>");}


  if(preg_match("/^.*(?=.{8,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/", $password) === 0){
array_push($errors, "<small style='color:red;''>Password must be at least 8 characters and must contain at least one lower case letter, one upper case letter and one digit</small>");
}

  

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM user WHERE firstName='$firstName' OR lastName='$lastName' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['firstname'] === $firstName) {
      array_push($errors, "<small style='color:red;''>First Name already exists</small>");
    }
    if ($user['lastname'] === $lastName) {
      array_push($errors, "<small style='color:red;''>Last Name already exists</small>");
    }

    if ($user['email'] === $email) {
      array_push($errors, "<small style='color:red;''>Email already exists</small>");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password);//encrypt the password before saving in the database
    $alert = "<script type=\"text/javascript\">".
        "alert('Register Successful');".
        "</script>";
  	$query = "INSERT INTO user (firstname,lastname, email, password,id,userRole) 
  			  VALUES('$firstName','$lastName', '$email', '$password','$email','user')";
  	mysqli_query($db, $query);
  	$_SESSION['email'] = $email;
  	$_SESSION['reg'] = $alert;
  	header('location: Login.php');
  }
}
// LOGIN USER
if (isset($_POST['login_user'])) {
  
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
  
  if (empty($email)) {
    array_push($errors, "<small style='color:red;''>Email is required</small>");
    echo "<script>$('#myModal').modal('toggle');</script>";
  }
  if (empty($password)) {
    array_push($errors, "<small style='color:red;''>Password is required</small>");
  }

  
  if (count($errors) == 0) {
    $password = md5($password);
    $query = "SELECT * FROM user WHERE email='$email' AND password='$password'";
    $results = mysqli_query($db, $query);
    if (mysqli_num_rows($results) == 1) {
      $logged_in_user = mysqli_fetch_assoc($results);
      if($logged_in_user['userRole'] == 'admin'){
        $_SESSION['admin'] = $logged_in_user;
        header('location: admin.php');
      }else{
        $_SESSION['user'] = $logged_in_user;
        $_SESSION['user_id'] = $logged_in_user["id"];
        header('location: home-page.php');
      }
    }else{
      array_push($errors, "<small style='color:red;''>Wrong email/password combination</small>");
    }
      
  }
}


?>