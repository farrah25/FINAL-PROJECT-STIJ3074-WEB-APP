<?php

if (isset($_POST["submit"])){
    include_once("../dbconnect.php");
    $name = $_POST["name"];
    $price = $_POST["price"];
    $cartqty = $_POST["quantity"];
    $description = $_POST["description"];
    $sqlregister = "INSERT INTO tbl_product(name, price, quantity, description) 
    VALUES('$name', '$price', '$quantity', '$description')";
  
    try {
    $conn->exec($sqlregister);
    if (file_exists($_FILES["fileToUpload"]["tmp_name"]) || is_uploaded_file ($_FILES["fileToUpload"]["tmp_name"])) {
    uploadImage($name);
    }
    echo "<script>alert('Registration successful')</script>";
    echo "<script>window.location.replace('newproduct.php')</script>";
    } catch (PDOException $e) {
    echo "<script>alert('Registration failed')</script>";
    echo "<script>window.location.replace('newproduct.php')</script>";
    }
}
    
  function uploadImage($name)
    {
    $target_dir = "../res/images";
    $target_file = $target_dir . $name . ".png"; 
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
    }
       
?>
<style>
   /* Full height image header */
   .bgimg-1 {
    background-position: center;
    background-size: cover;
    background-image: url("../res/images/photo.jpg");
    min-height: 100%;
  }
</style>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="../style/style.css">
<script src="../javascript/script.js"></script>
<title>AMIRUL THAI & MALAY RESTAURANT</title>
</head>

<body>
<!-- Navbar (sit on top) -->
<div class="w3-top">
  <div class="w3-bar w3-light-grey w3-card" id="myNavbar">
    <a href="#home" class="w3-bar-item w3-button w3-wide">AMIRUL THAI & MALAY RESTAURANT</a>
 
    <!-- Hide right-floated links on small screens and replace them with a menu icon -->
    <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium"
      onclick="w3_open()">
      <i class="fa fa-bars"></i>
    </a>

    <!-- Right-sided navbar links -->
    <div class="w3-right w3-hide-small">
      <a href="mycart.php" onclick="w3_close()" class="w3-bar-item w3-button">My Carts</a>
      <a href="payment.php" onclick="w3_close()" class="w3-bar-item w3-button">Payment History</a>
      <!-- <a href="newcustomer.php" onclick="w3_close()" class="w3-bar-item w3-button">New Customer</a> -->
     <!-- <a href="newproduct.php" onclick="w3_close()" class="w3-bar-item w3-button">New Product</a> -->
      <a href="index.php" onclick="w3_close()" class="w3-bar-item w3-button">Products</a> 
      <a href="login.php" onclick="w3_close()" class="w3-bar-item w3-button">Logout</a>
    </div>
    </div>
    </div>

<!-- Sidebar on small screens when clicking the menu icon -->
<nav class="w3-sidebar w3-bar-block w3-white w3-card w3-animate-left w3-hide-medium w3-hide-large"
  style="display:none" id="mySidebar">
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button w3-large w3-padding-16">Close ??</a>
    <a href="mycart.php" onclick="w3_close()" class="w3-bar-item w3-button">My Carts</a>
    <a href="payment.php" onclick="w3_close()" class="w3-bar-item w3-button">Payment History</a>
  <!-- <a href="newcustomer.php" onclick="w3_close()" class="w3-bar-item w3-button">New Customer</a>  -->
  <!--<a href="newproduct.php" onclick="w3_close()" class="w3-bar-item w3-button">New Product</a>  -->
  <a href="index.php" onclick="w3_close()" class="w3-bar-item w3-button">Products</a>
  <a href="login.php" onclick="w3_close()" class="w3-bar-item w3-button">Login</a>
  <a href="register.php" onclick="w3_close()" class="w3-bar-item w3-button">Register</a>  
  <a href="login.php" onclick="w3_close()" class="w3-bar-item w3-button">Logout</a>
</nav>


  <!-- Modal for full size images on click-->
  <div id="modal01" class="w3-modal w3-black" onclick="this.style.display='none'">
    <span class="w3-button w3-xxlarge w3-black w3-padding-large w3-display-topright" title="Close Modal Image">??</span>
    <div class="w3-modal-content w3-animate-zoom w3-center w3-transparent w3-padding-64">
      <img id="img01" class="w3-image">
      <p id="caption" class="w3-opacity w3-large"></p>
    </div>
  </div>

  <!--<div class="w3-header w3-container w3-pale-red w3-padding-32 w3-center">  -->
  <header class="bgimg-1 w3-display-container w3-grayscale-min" id="home">
    <div class="w3-display-left w3-tag w3-wide w3-text-white" style="padding:64px">
        <h1 style="font-size:calc(8px + 4vw);">Amirul Thai & Malay Restaurant</h1>
        <p style="font-size:calc(8px + 1vw);;">One dinner that combines Thai and Malay tastes. It is our pleasure to serve you!</p>
    </div> 
  </header> 

 

  <form class="w3-container w3-padding" name="registerForm" action="newproduct.php" method="POST" enctype="multipart/form-data" onsubmit="return confirmDialog()">

  <div class="w3-container w3-padding-64 form-container">
        <div class="w3-card">
            <!-- Insert the title div here -->
        <div class="w3-container w3-pale-red">
        <p>New Product<p>
    </div>
       <p> 
            <div class="w3-container w3-border w3-center w3-padding">
            <img class="w3-image w3-round w3-margin" src="../res/images/product.png" style="width:100%; max-width:330px"><br>
            <input type="file" onchange="previewFile()" name="fileToUpload" id="fileToUpload"><br>
        </div></p>
        <p>
        <i class = "fa fa-edit icon "></i>
            <label>Product Name</label>
            <input class="w3-input w3-border w3-round" name="name" id="idname" type="text" required>
        </p>
        <p>
        <i class = "fa fa-dollar icon "></i>
            <label>Price</label>
            <input class="w3-input w3-border w3-round" name="price" id="idprice" type="text" required>
        </p>
        <p>
        <i class = "fa fa-shopping-cart icon "></i>
            <label>Quantity</label>
            <input class="w3-input w3-border w3-round" name="quantity" id="idquantity" type="text" required>
        </p>
        <p>
        <i class = "fa fa-info icon "></i>
            <label>Description</label>
            <textarea class="w3-input w3-border"  name="description" id="iddescription" rows="4" cols="50" width="100%" placeholder="Please enter your description" required></textarea>
        </p>

        <div class="w3-row">
            <input class="w3-input w3-border w3-block w3-pale-red w3-round" type="submit" name="submit" value="Submit">
        </div>    
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
        <p class="mb-0">?? 2021 copyright all right reserved | Designed by <a class="text-white">Amirul Thai & Malay Restaurant</a></p>
      </div>
  </footer>
  

</body>

</html>