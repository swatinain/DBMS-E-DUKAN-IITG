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
    <title>Admin Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../nav.css">
    <script src="../script.js"></script>
    <style>
        body{
            font-size:large;
        }
    </style>
</head>
<body>
<div class="topnav" id="myTopnav">   
        <a href="adminhome.php" class="active">Home</a>
        <a href="sellers.php" >View Sellers</a>
        <a href="buyers.php">View Buyers</a>
        <a href="cc.php">View CC</a>
        <a href="transactions.php">View Transaction</a>
        <a href="products.php">View Products</a>
        <a href="adminprofile.php">Profile</a>
        <a class="right" href="../logout.php">Logout</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
          <i class="fa fa-bars"></i>
        </a>
    </div>
    <center>

<br><br><br><br><br>
<br><br><br><br><br>
    <h1 style="color:rgb(64, 130, 109);"> E-DUKAN</h1>
    <br><br><br><br><br>
    <br><br><br><br><br>

    </center>

</body>
</html>