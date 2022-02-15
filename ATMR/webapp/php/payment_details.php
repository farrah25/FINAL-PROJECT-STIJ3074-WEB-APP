<?php
include_once ("../dbconnect.php");
session_start();
if (isset($_SESSION['sessionid']))
{
    $email = $_SESSION['user_email'];
    $user_name = $_SESSION['user_name'];
    $user_phone = $_SESSION['user_phone'];
}else{
    echo "<script>alert('Please login or register')</script>";
    echo "<script> window.location.replace('login.php')</script>";
}

$receiptid = $_GET['order_receiptid'];
$sqlquery = "SELECT * FROM tbl_orders INNER JOIN tbl_product ON tbl_orders.order_id = tbl_product.id WHERE tbl_orders.order_receiptid = '$receiptid'";
$stmt = $conn->prepare($sqlquery);
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$rows = $stmt->fetchAll();

function subString($str)
{
    if (strlen($str) > 15)
    {
        return $substr = substr($str, 0, 15) . '...';
    }
    else
    {
        return $str;
    }
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
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button w3-large w3-padding-16">Close ×</a>
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
    <span class="w3-button w3-xxlarge w3-black w3-padding-large w3-display-topright" title="Close Modal Image">×</span>
    <div class="w3-modal-content w3-animate-zoom w3-center w3-transparent w3-padding-64">
      <img id="img01" class="w3-image">
      <p id="caption" class="w3-opacity w3-large"></p>
    </div>
  </div>

  <!--<div class="w3-header w3-container w3-pale-red w3-padding-32 w3-center">  -->
  <header class="bgimg-1 w3-display-container w3-grayscale-min" id="home">
    <div class="w3-display-left w3-tag w3-wide w3-text-white" style="padding:50px">
        <h1 style="font-size:calc(8px + 4vw);">Amirul Thai & Malay Restaurant</h1>
        <p style="font-size:calc(8px + 1vw);;">One dinner that combines Thai and Malay tastes. It is our pleasure to serve you!</p>
    </div> 
  </header> 
    
    <div class="w3-main w3-content w3-padding" style="max-width:1200px;margin-top:100px">
      
      <div class="w3-grid-template">
          
          <?php 
            $totalpaid = 0.0;
           foreach ($rows as $details)
            {
                $id = $details['id'];
                $name = $details['name'];
                $price = $details['price'];
                $order_qty = $details['order_qty'];
                $order_paid = $details['order_paid'];
                $order_status = $details['order_status'];
                $totalpaid = ($order_paid * $order_qty) + $totalpaid;
                $name = $details['name'];
                $order_date = date_format(date_create($details['order_date']), 'd/m/y h:i A');
               echo "<div class='w3-center w3-padding-small'><div class = 'w3-card w3-round-large'>
                    <div class='w3-padding-small'><a href='details.php?id=$id'><img class='w3-container w3-image' 
                    src=../images/books/$name.jpg onerror=this.onerror=null;this.src='../images/books/product.jpg'></a></div>
                    <b>$name</b><br>RM $order_paid<br> $order_qty unit<br></div></div>";
             }
             
             $totalpaid = number_format($totalpaid, 2, '.', '');
            echo "</div><br><hr><div class='w3-container w3-left'><h4>Your Order</h4><p>Order ID: $receiptid<br>Name: $user_name <br>Phone: $user_phone<br>Total Paid: RM $totalpaid<br>Status: $order_status<br>Date Order: $order_date<p></div>";
            ?>
    </div>

 

