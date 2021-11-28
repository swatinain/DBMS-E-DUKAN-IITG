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
    <title>CC Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../nav.css">
    <script src="script.js"></script>
    <style>
        body{
            font-size:large;
        }
    </style>
</head>
<body>
    <div class="topnav" id="myTopnav">   
    <a href="cchome.php" class="active">Home</a>
        <a href="transactions.php">Transactions</a>
        <a href="buyers.php">All buyers</a>
        <a href="sellers.php">All sellers</a>
        <a href="cc.php">All CC</a>
        <a href="products.php">All products</a>
        <a href="ccprofile.php">Profile</a>
        <a class="right" href="../logout.php">Logout</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
          <i class="fa fa-bars"></i>
        </a>
    </div>
    <br>
    <br>
    <br>
    <div>
    <center>

    <br><br><br><br><br>
<br><br><br><br><br>
    <h1 style="color:rgb(64, 130, 109);"> E-DUKAN</h1>
    <br><br><br><br><br>
    <br><br><br><br><br>


    </center>
    </div>
      
</body>
</html>