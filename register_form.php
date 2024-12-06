<?php 

@include 'connection.php';

if(isset($_POST['submit'])) {
     $name = mysqli_real_escape_string($conn, $_POST['name']);
     $email = mysqli_real_escape_string($conn, $_POST['email']);

     $password = md5($_POST['password']);
     $cpassword = md5($_POST['cpassword']);
     $user_type = md5($_POST['user_type']);


     $select = "SELECT * FROM login_info WHERE email = '$email' && password = '$password'";
     $result = mysqli_query($conn, $select);

     if(mysqli_num_rows($result) > 0) {
          $error[] = 'user already exists!';
     } else {
          if($password != $cpassword) {
               $error[] = 'password not matches!';
          } else {
               $insert = "INSERT INTO login_info (name, email, password, user_type) VALUES('$name', '$email', '$password', 'user_type')";
               mysqli_query($conn, $insert);
               header('location: login_form.php');
          }
     }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title> Register form </title>

     <!-- css link here -->
     <link rel="stylesheet" href="/Login_&_Register_Form/style.css">
</head>
<body>
     <div class="form_container">
          <form action="" method="post">
               <h3> Register Now </h3>

               <!-- error_message area here -->
               <?php
                    if (isset($_POST['error'])) {
                         foreach ($error as $error_message) {
                         echo "<span class='error_message'>{$error_message}</span>";
                         }
                    }                        
               ?>

               <input type="text" name="name" placeholder="Enter Your Name" required>
               <input type="email" name="email" placeholder="Enter Your email" required>
               <input type="password" name="password" placeholder="Enter Your password" required>
               <input type="password" name="cpassword" placeholder="Conform Your password" required>

               <select name="user_type">
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
               </select>

               <input type="submit" name="submit" value="Register Now" class="register_btn">
               <p> Already have an account? <a href="login_form.php">Login Now</a> </p>
          </form>
     </div>
</body>
</html>