<?php 

@include 'connection.php';
session_start();


if(isset($_POST['submit'])) {
    
     $email = mysqli_real_escape_string($conn, $_POST['email']);
     $password = md5($_POST['password']);
     

     $select = "SELECT * FROM login_info WHERE email = '$email' && password = '$password'";
     $result = mysqli_query($conn, $select);

     if(mysqli_num_rows($result) > 0) {
          $row = mysqli_fetch_array($result);
          

          if($row['user_type'] == 'admin') {

               $_SESSION['admin_name'] = $row['name'];
               header('location:admin_page.php');

          } elseif($row['user_type'] == 'user') {

               $_SESSION['user_name'] = $row['name'];
               header('location:user_page.php');
          }     
     } else {
          $error[] = "incorrect email or password";
     }
     
};

?>





<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title> login form </title>

     <!-- css link here -->
     <link rel="stylesheet" href="/Login_&_Register_Form/style.css">
</head>
<body>
     <div class="form_container">
          <form action="user_page.php" method="POST">
               <h3> Login Now </h3>
               <!-- error_message area here -->
               <?php
                    if (isset($_POST['error'])) {
                         foreach ($error as $error_message) {
                         echo "<span class='error_message'>{$error_message}</span>";
                         }
                    }                        
               ?>
               <input type="email" name="email" placeholder="Enter Your email" required>
               <input type="password" name="password" placeholder="Enter Your password" required>

               <input type="submit" name="submit" value="Register Now" class="register_btn">
               <p> don't have an account? <a href="register_form.php">Register Now</a> </p>
          </form>
     </div>
</body>
</html>