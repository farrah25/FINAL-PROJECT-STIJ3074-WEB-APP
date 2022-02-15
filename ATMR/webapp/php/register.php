<?php

if (isset($_POST['submit'])) {
    include_once("../dbconnect.php");
    $phone = $_POST["user_phone"];
    $name =$_POST["user_name"];
    $email =$_POST["user_email"];
    $password = sha1($_POST["user_password"]);

    $sqlregister = "INSERT INTO `tbl_users`(`user_phone`, `user_name`, `user_email`, `user_password`) VALUES ('$phone','$name', '$email', '$password')";
    try {
        $conn->exec($sqlregister);
        echo "<script>alert('Registration successful')</script>";
        echo "<script>window.location.replace('login.php')</script>";
    } catch (PDOException $e) {
        echo "<script>alert('Registration failed')</script>";
        //echo "<script>window.location.replace('register.php')</script>";
    }
} 
?>

<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style/style.css">
    <script src="javascript/script.js"></script>  
    <title>Singup</title>
</head>
  
  <body onload="loadCookies()"> 
    <div class="w3-header w3-container w3-pale-red w3-padding-32 w3-center">
        <h1 style="font-size:calc(8px + 4vw);">AMIRUL THAI & MALAY RESTAURANT</h1>
        <p style="font-size:calc(8px + 1vw);;">One dinner that combines Thai and Malay tastes. It is our pleasure to serve you!</p>
</div>

<div class ="w3-container w3-padding-64 form-container">
    <div class="w3-card-4 w3-round" >
        <div class="w3-container w3-pale-red">
        <h2 style="font-weight: 500; font-size:xx-large;">Sign Up</h2>
        </div>

        <form name="loginForm" class="w3-container" action="register.php" method="post">
                <p>
                        <i class="input-container fa fa-user icon"></i>
                        <label class="w3-text-black"><b>Name</b></label>
                        <input class="w3-input w3-border w3-round" name="user_name" type="text" id="idname" required>
                     </p>
                    <p>
                        <i class=" input-container fa fa-envelope icon"></i>    
                        <label class="w3-text-black"><b>Email</b></label>
                        <input class="w3-input w3-border w3-round" name="user_email" type="email" id="idemail" required>
                     </p>
                     <p>
                        <i class=" input-container fa fa-phone icon"></i>    
                        <label class="w3-text-black"><b>Contact Number</b></label>
                        <input class="w3-input w3-border w3-round" name="user_phone" type="text" id="idphone" required>
                     </p>
                    <p>
                        <i class=" input-container fa fa-key icon"></i>    
                        <label class="w3-text-black"><b>Password</b></label>
                        <input class="w3-input w3-border w3-round" name="user_password" type="password" id="idpass" required>
                    </p>
                   
                    <p>
                        <button class="w3-btn w3-round w3-pale-red w3-block" style="font-weight:bold;" name="submit">Sign Up</button>
                    </p>
                    <p>
                        Already have an account? <a href="login.php" style="font-weight:bold;" >Login</a><br>
                    </p>
                </form>
            </div>
        </div>
 <!-- Footer -->
 <footer class="w3-center w3-black w3-padding-64">
    <a href="#home" class="w3-button w3-light-grey"><i class="fa fa-arrow-up w3-margin-right"></i>To the top</a>
    <div class="w3-xlarge w3-section">
      <i class="fa fa-facebook-official w3-hover-opacity"></i>
      <i class="fa fa-instagram w3-hover-opacity"></i>
      <i class="fa fa-snapchat w3-hover-opacity"></i>
      <i class="fa fa-pinterest-p w3-hover-opacity"></i>
      <i class="fa fa-twitter w3-hover-opacity"></i>
      <i class="fa fa-linkedin w3-hover-opacity"></i>
    </div>
    <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" title="W3.CSS" target="_blank"
        class="w3-hover-text-green">w3.css</a></p>
        <div class="col-md-6">
        <p class="mb-0">© 2021 copyright all right reserved | Designed by <a class="text-white">Amirul Thai & Malay Restaurant</a></p>
      </div>
  </footer>
  </body>
</html>