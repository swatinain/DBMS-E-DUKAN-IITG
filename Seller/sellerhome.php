<?php
    require_once 'C:\MAMP\htdocs\DBMS_Lab\Project\conn.php';
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../nav.css">
    <script src="script.js"></script>
</head>
<body>
    <div class="topnav" id="myTopnav">   
        <a href="sellerhome.php" class="active">Home</a>
        <a href="addproduct.php">Add new product</a>
        <a href="myproducts.php">My products</a>
        <a href="contactcc.php">Contact CC</a>
        <a href="sellerprofile.php">Profile</a>
        <a class="right" href="../logout.php">Logout</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
          <i class="fa fa-bars"></i>
        </a>
    </div>

    <br><br>
    <!-- Login for the first time? Update all your details here: <br><br>
        <a style="text=decoration:none;" href="sellerprofile.php" class="btn spacebottom spacetop"> Enter details </a> -->
        <br><br><br>
    <div>
        <h2 class="btn">Terms and conditions:</h2>
        <ol>
            <br>
            <li>When your product is sold, you will get 95% of what you fill in the expected price, while adding a product, in your wallet.
            </li>
            <br>
            <br>
            <li>You have to do the delivery yourself.</li>
            <br>
            <br>
            <li>Delivery must be done within 24 hours of ordering the product.</li>
        </ol>

    </div>
      
</body>
</html>